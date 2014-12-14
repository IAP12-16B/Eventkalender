<?php


namespace kije;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class kije\Show
 *
 * @property int $ID
 * @property Carbon $datum
 * @property Carbon $zeit
 * @property int $fk_Veranstaltung_ID
 * @property Event $event
 * @method static \Illuminate\Database\Query\Builder|\kije\Show whereID($value)
 * @method static \Illuminate\Database\Query\Builder|\kije\Show whereDatum($value)
 * @method static \Illuminate\Database\Query\Builder|\kije\Show whereZeit($value)
 * @method static \Illuminate\Database\Query\Builder|\kije\Show whereFkVeranstaltungID($value)
 */
class Show extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Vorstellung';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array(
        'datum',
        'zeit',
        'fk_Veranstaltung_ID'
    );

    public function getDates()
    {
        return array('datum', 'zeit');
    }

    public function event()
    {
        return $this->belongsTo('kije\Event', 'fk_Veranstaltung_ID');
    }

    /**
     * @param \kije\Event $event Event (only used, if this Show is not already linked to an event)
     * @return bool
     */
    public function hasCollision($event = null)
    {
        $event = ($this->event ? $this->event : $event);
        $q = self::query()
                 ->getQuery()
                 ->select($this->table . '.ID')
                 ->leftJoin('Veranstaltung', 'Veranstaltung.ID', '=', $this->table . '.fk_Veranstaltung_ID')
                 ->where($this->table . '.datum', '=', $this->datum->toDateString());

        $raw_where_sql = '(
                        (? BETWEEN
                            `' . $this->table . '`.`zeit` AND
                            ADDTIME(`' . $this->table . '`.`zeit`, `Veranstaltung`.`dauer`))
                    ';
        $where_data = array($this->zeit->toTimeString());


        if (!empty($event)) {
            $raw_where_sql .= ' OR (ADDTIME(?, ?) BETWEEN
                        `' . $this->table . '`.`zeit` AND
                        ADDTIME(`' . $this->table . '`.`zeit`, `Veranstaltung`.`dauer`))';
            $where_data = array_merge($where_data, array($this->zeit->toTimeString(), $event->dauer->toTimeString()));
        }

        $raw_where_sql .= ')';


        $q->whereRaw($raw_where_sql, $where_data)->limit(1);

        return $q->exists();
    }

}
