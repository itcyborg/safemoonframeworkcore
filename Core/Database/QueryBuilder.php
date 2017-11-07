<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 10/28/2017
 * Time: 6:30 PM
 */

class QueryBuilder extends Connection
{

    /* select records
     * todo select all records
     * todo select one record
     * todo find records
     * todo find first record
     * todo find last record
     * todo count records
     */

    public static function All($table)
    {
        try {
            $connection = Connection::make();
            $sql = sprintf(
                'select * from %s',
                $table
            );
            $sql = $connection->prepare($sql);
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function Select($id, $table)
    {
        try {
            ##code here
            $connection = Connection::make();
            $statement = sprintf(
                'select * from %s where id=%s',
                $table,
                $id
            );
            $statement = $connection->prepare($statement);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_CLASS);
        } catch (Exception $e) {
            ##handle exceptions here
            return $e->getMessage();
        }
    }

    public static function Find($table, $id)
    {
        $statement=sprintf('select * from %s where id="%s"',$table,$id);
        try {
            $connection=Connection::make();
            ##code here
            $statement = $connection->prepare($statement);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            ##handle exceptions here
            return $e->getMessage();
        }
    }

    public static function FindColumn($table,$parameters)
    {
        try {
            ##code here
            $sql=null;
            foreach ($parameters as $parameter=>$value) {
                if($sql==null)
                {
                    $sql=$parameter."='".$value."'";
                }else{
                    $sql.=$parameter."='".$value."'";
                }
            }
            $connection=Connection::make();
            $statement = sprintf(
                'select * from %s where %s',
                $table,
                $sql
            );
            $statement=$connection->prepare($statement);
            $statement->execute();
            return ['count'=>$statement->rowCount(),'result'=>$statement->fetchAll(PDO::FETCH_CLASS)];
        } catch (Exception $e) {
            ##handle exceptions here
            return $e->getMessage();
        }
    }

    public static function First($table)
    {
        try {
            $statement = sprintf(
                'select * from %s',
                $table
            );
            return $statement;
        } catch (Exception $e) {

        }
    }

    public static function Last($table)
    {
        try {
            $statement = sprintf(
                'select * from %s',
                $table
            );
            return $statement;
        } catch (Exception $e) {

        }

    }

    public static function id()
    {

    }

    /*
     * update record
     * todo update record using id
     * todo update records using time created
     * todo update record using column name
     */

    public static function update()
    {

    }

    public static function updateColumn()
    {

    }


    /*
     * delete record
     * todo delete record using id
     */

    public static function delete($table, $id)
    {
        try {
            ##code here
            $connection = Connection::make();
            $statement = sprintf('delete from %s where id=%s',
                $table, $id
            );
            $statement = $connection->prepare($statement);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_CLASS);
        } catch (Exception $e) {
            ##handle exceptions here
            return $e->getMessage();
        }
    }


    /*
     *
     * todo insert record
     */

    public static function save($table,array $parameters)
    {
        if (is_null($parameters)) {
            throw new Exception("No data provided");
        }
        $sql = sprintf(
            'insert into %s (%s) value (%s)',
            $table,
            implode(',', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );
        //insert into (name) values (:name)

        try {
            $connection = Connection::make();
            $statement = $connection->prepare($sql);
            return $statement->execute($parameters);
        } catch (PDOException $e) {
            dd($e->getMessage());
        }
    }


    public function count($table)
    {
        try {
            $statement = sprintf(
                'select * from %s',
                $table
            );
            return $statement;
        } catch (Exception $e) {
            return $e->getMessage();
        }

    }

    public static function idFromEmail($table,$email)
    {
        $sql = sprintf(
            'select * from %s where email="%s"',
            $table,
            $email

        );
        //insert into (name) values (:name)

        try {
            $connection = Connection::make();
            $statement = $connection->prepare($sql);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_OBJ)->id;
        } catch (PDOException $e) {
            dd($e->getMessage());
        }
    }

}
