<?php

class database
{
    public static $connection;

    public static function setconnection()
    {
        if (!isset(database::$connection)) {
            database::$connection = new mysqli("localhost", "root", "Che123//", "eshop");
        }
    }

    public static function iud($q)
    {
        database::setconnection();

        database::$connection->query($q);
    }


    public static function search($q)
    {
        database::setconnection();

        $resultset = database::$connection->query($q);
        return $resultset;
    }
}