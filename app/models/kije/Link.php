<?php

namespace kije;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class kije\Link
 *
 * @property int $ID
 * @property string $name
 * @property string $link
 * @property int $fk_Veranstaltung_ID
 * @property Event $event
 * @method static \Illuminate\Database\Query\Builder|\kije\Link whereID($value)
 * @method static \Illuminate\Database\Query\Builder|\kije\Link whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\kije\Link whereLink($value)
 * @method static \Illuminate\Database\Query\Builder|\kije\Link whereFkVeranstaltungID($value)
 */
class Link extends Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Link';

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
        'link',
        'fk_Veranstaltung_ID'
    );

    public function event()
    {
        return $this->belongsTo('kije\Event', 'fk_Veranstaltung_ID');
    }
}