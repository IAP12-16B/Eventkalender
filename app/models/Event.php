<?php

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class Event
 * @property int $ID
 * @property string $name
 * @property string $besetzung
 * @property string $beschreibung
 * @property string $dauer
 * @property string $bild
 * @property string $bildbeschreibung
 * @property int $fk_Genre_ID
 * @property Genre $genre
 * @property Collection $links
 * @property Collection $shows
 * @property Collection $pricegroups
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
        return $this->belongsTo('Genre', 'fk_Genre_ID');
    }

    public function links()
    {
        return $this->hasMany('Link', 'fk_Veranstaltung_ID');
    }

    public function shows()
    {
        return $this->hasMany('Show', 'fk_Veranstaltung_ID');
    }

    public function pricegroups()
    {
        return $this->belongsToMany(
            'Pricegroup',
            'Veranstaltung_hat_Preisgruppe',
            'fk_Veranstaltung_ID',
            'fk_Preisgruppe_ID'
        );
    }
}
