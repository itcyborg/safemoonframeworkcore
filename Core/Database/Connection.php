<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 10/28/2017
 * Time: 6:31 PM
 */

class Connection extends PDO
{
    protected static $config;
    protected static $host;
    protected static $port;
    protected static $database;
    protected static $username;
    protected static $password;
    protected static $options = [];


    public static function make()
    {
        self::config();
        try {
            return new PDO(
                "mysql:
                host=" . self::$host . ";
                dbname=" . self::$database, // database name
                self::$username, // database username
                self::$password//, //database password
            //self::$options //additional options
            );
        } catch (SafeExceptions $e) {
            return $e->getMessage();
        }

    }

    //get db configuration
    private static function config()
    {
        //get all the db connection from the config file
        self::$config = Config::database();

        //get the specific options

        self::$host = self::$config['host'];
        self::$port = self::$config['port'];
        self::$database = self::$config['name'];
        self::$username = self::$config['username'];
        self::$password = self::$config['password'];
        self::$options = self::$config['options'];
    }
}