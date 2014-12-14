<?php


namespace kije;

use Carbon\Carbon;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Class kije\Show
 *
 * @property int $ID
 * @property string $datum
 * @property string $zeit
 * @property int $fk_Veranstaltung_ID
 * @property Event $event
 * @method static \Illuminate\Database\Query\Builder|\kije\Show whereID($value)
 * @method static \Illuminate\Database\Query\Builder|\kije\Show whereDatum($value)
 * @method static \Illuminate\Database\Query\Builder|\kije\Show whereZeit($value)
 * @method static \Illuminate\Database\Query\Builder|\kije\Show whereFkVeranstaltungID($value)
 * @method static \kije\Show isArchive($archive)
 * @method static \kije\Show chronologically()
 */
class Show extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected static $tablename = 'Vorstellung';

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

        $q = \DB::table(self::getTableName())
                ->leftJoin(
                    Event::getTableName(),
                    Event::getColumnName('ID', false),
                    '=',
                    self::getColumnName('fk_Veranstaltung_ID', false)
                );

        $q->select(self::getColumnName('ID', false))
          ->where(self::getColumnName('datum', false), '=', $this->datum);

        $sub_query = \DB::table(self::getTableName());

        $sub_query->whereRaw(
            '(
                ? BETWEEN
                ' . self::getColumnName('zeit') . ' AND
                ADDTIME(' . self::getColumnName('zeit') . ', ' . Event::getColumnName('dauer') . ')
            )',
            array($this->zeit)
        );



        if (!empty($event)) {
            $sub_query->whereRaw(
                '(
                    ADDTIME(?, ?) BETWEEN
                    ' . self::getColumnName('zeit') . ' AND
                    ADDTIME(' . self::getColumnName('zeit') . ', ' . Event::getColumnName('dauer') . ')
                )',
                array($this->zeit, $event->dauer),
                'or'
            );
        }


        $q->addNestedWhereQuery($sub_query)->limit(1);

        return $q->exists();
    }


    public function scopeIsArchive($query, $archive = false) {
        return $query->where('datum', ($archive ? '<' : '>'), date('Y-m-d'));
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeChronologically( $query) {
        return $query->orderBy('datum')->orderBy('zeit');
    }
}
