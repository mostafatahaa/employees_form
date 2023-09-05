<?php

class User
{
    private $name;
    private $email;
    private $age;
    private $salary;
    private $address;

    public function __construct($name, $email, $age, $salary, $address)
    {
        $this->email = $email;
        $this->age = $age;
        $this->salary = $salary;
        $this->address = $address;
    }

    // we use magic method __get() to assecc private and protected properties
    public function __get($prop)
    {
        return $this->$prop;
    }
}
