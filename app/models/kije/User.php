<?php

namespace kije;


use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\UserTrait;

/**
 * Class kije\User
 *
 * @property string $benutzername
 * @property string $passwort
 * @property string $remember_token
 * @property integer $id
 * @method static \Illuminate\Database\Query\Builder|\kije\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\kije\User whereBenutzername($value)
 * @method static \Illuminate\Database\Query\Builder|\kije\User wherePasswort($value)
 * @method static \Illuminate\Database\Query\Builder|\kije\User whereRememberToken($value)
 */
class User extends \Eloquent implements UserInterface, RemindableInterface
{

    use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Benutzer';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('passwort', 'remember_token');

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = array('*');

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->passwort;
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed

    public function getAuthIdentifier()
    {
        return 'benutzername'; // todo maybe change
    } */

    public function setPassword($password) {
        $this->passwort =  \Hash::make($password);
    }
}
