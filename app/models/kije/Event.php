<?php

namespace kije;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use stdClass;

/**
 * Class kije\Event
 *
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
 * @method static \Illuminate\Database\Query\Builder|\kije\Event whereID($value)
 * @method static \Illuminate\Database\Query\Builder|\kije\Event whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\kije\Event whereBesetzung($value)
 * @method static \Illuminate\Database\Query\Builder|\kije\Event whereBeschreibung($value)
 * @method static \Illuminate\Database\Query\Builder|\kije\Event whereDauer($value)
 * @method static \Illuminate\Database\Query\Builder|\kije\Event whereBild($value)
 * @method static \Illuminate\Database\Query\Builder|\kije\Event whereBildbeschreibung($value)
 * @method static \Illuminate\Database\Query\Builder|\kije\Event whereFkGenreID($value)
 */
class Event extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected static $tablename = 'Veranstaltung';


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


    /**
     * @param bool $archive
     * @param null $genre_id
     * @return Collection|\Illuminate\Database\Eloquent\Model|static
     */
    public static function filter($archive = false, $genre_id = null)
    {
        $q = \DB::table(self::getTableName())
                ->leftJoin(
                    Show::getTableName(),
                    Show::getColumnName('fk_Veranstaltung_ID', false),
                    '=',
                    self::getColumnName('ID', false)
                );

        $q->where(Show::getColumnName('datum', false), ($archive ? '<' : '>'),  date('Y-m-d'));

        if (!empty($genre_id)) {
            if ($genre_id instanceof Genre) {
                $genre_id = $genre_id->ID;
            }

            $q->where(self::getColumnName('fk_Genre_ID', false), '=', $genre_id);
        }


        return self::findMany(
            array_map(
                function (stdClass $k) {
                    return $k->ID;
                },
                $q->get(
                    array(
                        self::getColumnName('ID', false)
                    )
                )
            )
        );
    }
}
