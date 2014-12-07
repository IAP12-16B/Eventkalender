<?php

namespace kije;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class kije\Event
 *
 * @property int $ID
 * @property string $name
 * @property string $besetzung
 * @property string $beschreibung
 * @property Carbon $dauer
 * @property string $bild
 * @property string $bildbeschreibung
 * @property int $fk_Genre_ID
 * @property Genre $genre
 * @property Collection $links
 * @property Collection $shows
 * @property Collection $pricegroups
 * @method static \Illuminate\Database\Query\Builder|\kije\Event whereID($value) 
 * @method static \Illuminate\Database\Query\Builder|\kije\Event whereName($value) 
 * @method static \Illuminate\Database\Query\Builder|\kije\Event whereBesetzung($value) 
 * @method static \Illuminate\Database\Query\Builder|\kije\Event whereBeschreibung($value) 
 * @method static \Illuminate\Database\Query\Builder|\kije\Event whereDauer($value) 
 * @method static \Illuminate\Database\Query\Builder|\kije\Event whereBild($value) 
 * @method static \Illuminate\Database\Query\Builder|\kije\Event whereBildbeschreibung($value) 
 * @method static \Illuminate\Database\Query\Builder|\kije\Event whereFkGenreID($value) 
 */
class Event extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Veranstaltung';

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
        'name',
        'besetzung',
        'beschreibung',
        'dauer',
        'bild',
        'bildbeschreibung',
        'fk_Genre_ID'
    );


    public function genre()
    {
        return $this->belongsTo('kije\Genre', 'fk_Genre_ID');
    }

    public function links()
    {
        return $this->hasMany('kije\Link', 'fk_Veranstaltung_ID');
    }

    public function shows()
    {
        return $this->hasMany('kije\Show', 'fk_Veranstaltung_ID');
    }

    public function pricegroups()
    {
        return $this->belongsToMany(
            'kije\Pricegroup',
            'Veranstaltung_hat_Preisgruppe',
            'fk_Veranstaltung_ID',
            'fk_Preisgruppe_ID'
        );
    }

    public function getDates()
    {
        return array('dauer');
    }
}
