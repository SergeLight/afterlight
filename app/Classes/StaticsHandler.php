<?php

namespace App\Classes;

class StaticsHandler
{

    public static function getStaticsUrl($assetName)
    {
        $env = env('APP_ENV');

        // FOR QUICK DEV ONLY, leave on false to test with webpack and be sure (JS ONLY, Sass still needs to be build)
//        $useRawJS = (str_ends_with($assetName, 'js'));
        $useRawJS = false;

        if ($env == 'production'){

            $string = file_get_contents("../resources/build-manifest/build-manifest.json");
            $json = json_decode($string);
            if (property_exists($json, $assetName)){
                $assetName = $json->$assetName;
                return '/prod/'.$assetName;
            }
        }
        elseif ($env == 'local' && !$useRawJS)
            return '/dev/'.$assetName;
        elseif ($env == 'local' && $useRawJS)
            return '/dev-raw-js/'.$assetName;

        return '';
    }
}
