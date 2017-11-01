<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 10/30/2017
 * Time: 10:10 AM
 */

class Call
{
    public static function make()
    {
        $r = [];
        try {
            ##code here
            $results = AT::gateway()->call(AT::voiceNumber(), '+254706928631');
            foreach ($results as $result) {
                $r[] = $result;
            }
        } catch (AfricasTalkingGatewayException $e) {
            ##handle exceptions here
            return $e->getMessage();
        }
    }

    public static function say($text)
    {
        // Compose the response
        $response = '<?xml version="1.0" encoding="UTF-8"?>';
        $response .= '<Response>';
        $response .= '<Say>' . $text . '</Say>';
        $response .= '</Response>';

        // Print the response onto the page so that our gateway can read it
        header('Content-type: text/plain');
        return $response;
    }
}