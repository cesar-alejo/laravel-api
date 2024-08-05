<?php

use Detection\MobileDetect;

function isMobile()
{
    $detect = new MobileDetect();

    try {

        return $detect->isMobile();
    } catch (\Detection\Exception\MobileDetectException $th) {

        return "Error detectando dispositivo";
    }
}
