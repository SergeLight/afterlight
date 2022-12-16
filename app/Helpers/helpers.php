<?php

if (! function_exists('staticsUrl')) {
    function staticsUrl($key) {
        return App\Classes\StaticsHandler::getStaticsUrl($key);
    }
}
