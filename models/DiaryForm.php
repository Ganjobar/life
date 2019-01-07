<?php
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 1/7/2019
 * Time: 6:58 AM
 */

namespace app\models;


use yii\base\Model;

class DiaryForm extends Model
{
    public $checkOne = false;
    public $checkTwo = false;
    public $checkThree = false;
    public $checkFour = false;
    public $checkFive = false;

    public function rules()
    {
        return [
            [['checkOne', 'checkTwo', 'checkThree', 'checkFour', 'checkFive'], 'boolean']
        ];
    }
}