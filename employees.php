<?php
require_once "abstract_model.php";
class Employees extends AbstractModel
{
    public $id;
    public $name;
    public $email;
    public $age;
    public $salary;
    public $address;

    protected static $table_name = "employees";
    protected static $primary_key = "id";

    protected static $table_schema = [
        "name"      => self::TYPE_STR,
        "email"     => self::TYPE_STR,
        "age"       => self::TYPE_INT,
        "salary"    => self::TYPE_DEC,
        "address"   => self::TYPE_STR,
    ];

    public function __construct($name, $email, $age, $salary, $address)
    {
        $this->name     = $name;
        $this->email    = $email;
        $this->age      = $age;
        $this->salary   = $salary;
        $this->address  = $address;
    }

    public function __get($prop)
    {
        return $this->$prop;
    }

    public function set_name($name)
    {
        $this->name = $name;
    }

    public static function get_table_name()
    {
        return self::$table_name;
    }
}
