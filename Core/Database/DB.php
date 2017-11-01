<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 10/26/2017
 * Time: 2:50 PM
 */

class DB extends QueryBuilder
{
    public static function save($table, array $data)
    {
        return QueryBuilder::save($table, $data);
    }
}