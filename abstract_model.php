<?php

class AbstractModel
{
    const TYPE_BOOL = PDO::PARAM_BOOL;
    const TYPE_INT  = PDO::PARAM_INT;
    const TYPE_STR  = PDO::PARAM_STR;
    const TYPE_DEC  = 5;

    public static function create_named_params_sql()
    {
        $named_params = "";
        foreach (static::$table_schema as $params => $type) {
            $named_params .= "$params " . " = :" . "$params, ";
        }
        return trim($named_params, " ,");
    }

    public function prepare_val(&$stmt)
    {
        foreach (static::$table_schema as $params => $type) {
            if ($type == 5) {
                $filter_dec = filter_var($this->$params, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $stmt->bindValue(":{$params}", $filter_dec);
            } else {
                $stmt->bindValue(":{$params}", $this->$params, $type);
            }
        }
    }



    // in this method we use $this keyword because it return the value of the variable($params)
    // EX: params ==> name...$this->$params ==> mostafa...and we need the value to use it in bindValue
    // bindValue takes($parameter, $itsValue, itsType)
    public function create()
    {
        global $db_connection;
        $sql = "INSERT INTO " . static::$table_name . " SET " . self::create_named_params_sql();
        $stmt = $db_connection->prepare($sql);
        $this->prepare_val($stmt);
        $stmt->execute();
    }

    public function save()
    {
        return $this->{static::$primary_key} === null ? $this->create() : $this->update();
    }

    public function update()
    {
        global $db_connection;
        $sql = "UPDATE " . static::$table_name . " SET " . self::create_named_params_sql() . " WHERE " . static::$primary_key . " = " . $this->{static::$primary_key};
        $stmt = $db_connection->prepare($sql);
        $this->prepare_val($stmt);
        return $stmt->execute();
    }

    public function delete()
    {
        global $db_connection;

        $sql = "DELETE FROM " . static::$table_name . " WHERE " . static::$primary_key . " = " . $this->{static::$primary_key};
        $stmt = $db_connection->prepare($sql);
        return  $stmt->execute();
    }


    public static function get_all()
    {
        global $db_connection;

        $sql = "SELECT * FROM " . static::$table_name;
        $stmt = $db_connection->prepare($sql);
        return  $stmt->execute() === true ? $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$table_schema)) : false;
    }

    public static function get_by_key($pk)
    {
        global $db_connection;

        $sql = "SELECT * FROM " . static::$table_name . " WHERE " . static::$primary_key . " = " . "$pk";
        $stmt = $db_connection->prepare($sql);
        if ($stmt->execute()) {
            $obj = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$table_schema));
            return $obj = array_shift($obj);
        }
        return false;
    }
}
