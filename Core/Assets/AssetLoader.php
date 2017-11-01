<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 10/31/2017
 * Time: 10:12 AM
 */

class AssetLoader
{
    public static function load($asset)
    {
        $root = App::root();
        $assetDir = "Public/";
        if (is_readable($root . $assetDir . $asset)) {
            return (string)$assetDir . $asset;
        }
        throw new Exception('Asset not found');
    }
}