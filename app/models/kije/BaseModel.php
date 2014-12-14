<?php


namespace kije;


abstract class BaseModel extends \Eloquent
{
    protected  static $tablename;

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

    public function __construct(array $attributes = array())
    {
        $this->table = static::$tablename;
        parent::__construct($attributes);
    }


    public function getDates()
    {
        return array();
    }

    public static function getColumnName($col, $wrapped = true, $prefix = null) {
        $prefix = empty($prefix) ? static::getTableName() : $prefix;

        return ($wrapped ? \DB::getQueryGrammar()->wrap($prefix.'.'.$col) : $prefix.'.'.$col);
    }

    public static function getTableName() {
        return static::$tablename;
    }
}
