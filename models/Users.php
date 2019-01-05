<?php
/**
 * Created by PhpStorm.
 * User: edsil
 * Date: 05.01.2019
 * Time: 20:20
 */

namespace app\models;


use yii\db\ActiveRecord;

class Users extends ActiveRecord
{
    public static function tableName(){
        return "user";
    }
}