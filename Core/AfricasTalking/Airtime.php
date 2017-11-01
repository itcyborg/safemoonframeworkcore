<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 10/30/2017
 * Time: 10:16 AM
 */

class Airtime
{
    public static function send(array $recipients)
    {
        $r = [];
        try {
            ##code here
            $recipientsStringFormat = json_encode($recipients);
            $results = AT::gateway()->sendAirtime($recipientsStringFormat);
            foreach ($results as $result) {
                $r[] = $result;
            }
            return $r;
        } catch (Exception $e) {
            ##handle exceptions here
            return $e->getMessage();
        }
    }
}