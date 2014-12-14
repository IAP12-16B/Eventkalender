<?php


namespace kije;

use Carbon\Carbon;
use Doctrine\DBAL\Query\QueryBuilder;

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

    public function getDates()
    {
        return array('datum');
    }

    public function getZeitAttribute($value)
    {
        return Carbon::createFromFormat('H:i:s', $value);
    }

    public function setZeitAttribute(Carbon $value)
    {
        $this->attributes['dauer'] = $value->toTimeString();
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

        $q = \DB::table(self::getTableName())
                ->leftJoin(
                    Event::getTableName(),
                    Event::getColumnName('ID'), '=',
                    self::getColumnName('fk_Veranstaltung_ID')
                );

        $q->select(self::getColumnName('ID', true))
          ->where(self::getColumnName('datum', false), '=', $this->datum->toDateString());

        $sub_query = \DB::table(self::getTableName());

        $sub_query->whereRaw(
            '(
                ? BETWEEN
                ' . self::getColumnName('zeit') . ' AND
                ADDTIME(' . self::getColumnName('zeit') . ', ' . Event::getColumnName('dauer') . ')
            )',
            array($this->zeit->toTimeString())
        );



        if (!empty($event)) {
            $sub_query->whereRaw(
                '(
                    ADDTIME(?, ?) BETWEEN
                    ' . self::getColumnName('zeit') . ' AND
                    ADDTIME(' . self::getColumnName('zeit') . ', ' . Event::getColumnName('dauer') . ')
                )',
                array($this->zeit->toTimeString(), $event->dauer->toTimeString()),
                'or'
            );
        }

        $q->addNestedWhereQuery($sub_query)->limit(1);

        return $q->exists();
    }


    public function scopeIsArchive($query, $archive) {
        return $query->where('datum', ($archive ? '>' : '<'), 'NOW()')
                 ->where('zeit', ($archive ? '>' : '<'), 'NOW()');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeChronologically( $query) {
        return $query->orderBy('datum')->orderBy('zeit');
    }
}
