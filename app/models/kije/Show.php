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
}
