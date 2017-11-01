<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 10/30/2017
 * Time: 9:54 AM
 */

class SMS
{
    /**
     * @param $recipient
     * @param $message
     * @return array|string
     */
    public static function send($recipient, $message)
    {
        $r = [];
        try {
            ##code here
            $results = AT::gateway()->sendMessage((string)$recipient, $message);
            foreach ($results as $result) {
                $r[] = $result;
            }
            return $r;
        } catch (AfricasTalkingGatewayException $e) {
            ##handle exceptions here
            return $e->getMessage();
        }
    }

    /**
     * @param array $recipients
     */
    public static function sendBulk(array $recipients, $message)
    {
        $recipients = implode(',', $recipients);
        $r = [];
        try {
            ##code here
            $results = AT::gateway()->sendMessage((string)$recipients, $message);
            foreach ($results as $result) {
                $r[] = $result;
            }
            return $r;
        } catch (AfricasTalkingGatewayException $e) {
            ##handle exceptions here
            return $e->getMessage();
        }
    }

    /**
     * @param int $lastReceivedId
     * @return array
     */
    public static function getMessages($lastReceivedId = 0)
    {
        try {
            $r = [];
            ##code here
            do {
                $results = AT::gateway()->fetchMessages($lastReceivedId);
                foreach ($results as $result) {
                    $lastReceivedId = $result->id;
                    $r[] = $result;
                }
            } while (count($results) > 0);
            return $r;
        } catch (AfricasTalkingGatewayException $e) {
            ##handle exceptions here
            $e->getMessage();
        }
    }
}