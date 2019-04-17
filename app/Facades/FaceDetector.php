<?php
namespace App\Helpers\Facades;

use Illuminate\Support\Facades\Facade;
class FaceDetector extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Helpers\FaceDetector::class;
    }
}