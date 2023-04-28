<?php

define("DB_SERVER", "localhost");
define("DB_LOGIN", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "flavor_fusion");

class DB {
    public static function connect_to_db() 
    {
        $connection = mysqli_connect(DB_SERVER, DB_LOGIN, DB_PASSWORD, DB_NAME);
        mysqli_set_charset($connection, "utf8");
        return $connection;
    }

    public static function disconnect_from_db($connection)
    {
        mysqli_close($connection);
    }

    public static function do_sql($sql_expression, $sql_params = array()) {
        $connection = self::connect_to_db();
        $param_types = "";
        foreach ($sql_params as $param)
        {
            $param_types.= gettype($param)[0];
        }
        $stmt = mysqli_prepare($connection, $sql_expression);
        mysqli_stmt_bind_param($stmt, $param_types, ...$sql_params);
        $result = mysqli_stmt_execute($stmt);
        self::disconnect_from_db($connection);
        return $result;
    }

    public static function do_sql_select($sql_expression, $sql_params = array()) {
        $connection = self::connect_to_db();
        $param_types = "";
        foreach ($sql_params as $param)
        {
            $param_types.= gettype($param)[0];
        }
        $stmt = mysqli_prepare($connection, $sql_expression);
        if(count($sql_params)>0)
            mysqli_stmt_bind_param($stmt, $param_types, ...$sql_params);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        self::disconnect_from_db($connection);
        return $res;
    }

    public static function convert_result_to_array($result)
    {
        $rows = array();
        
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
}