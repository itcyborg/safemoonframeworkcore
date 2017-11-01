<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 10/27/2017
 * Time: 12:25 AM
 */

class Views
{
    public static function view($view, $data = null)
    {
        $viewDir = self::dirRoot();
        if (is_readable($viewDir . $view . ".php")) {
            return require $viewDir . $view . ".php";
        } else {
            throw new Exception("View Not Found");
        }
    }

    private static function dirRoot()
    {
        $root = App::root();
        return $root . "/App/Views/";
    }

    public static function partial($partialName)
    {
        $viewDir = self::dirRoot();
        if (is_readable($viewDir . $partialName . ".php")) {
            require $viewDir . $partialName . ".php";
            return;
        }
        throw new Exception("Partial not found");
    }

    public static function section($sectionName)
    {
    }
}