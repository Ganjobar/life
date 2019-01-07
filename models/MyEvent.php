<?php
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 1/7/2019
 * Time: 9:27 AM
 */

namespace app\models;


class MyEvent extends \yii2fullcalendar\models\Event
{
    public $category;
    public $picture;
    public $description;
}