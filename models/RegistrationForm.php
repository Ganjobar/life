<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class RegistrationForm extends ActiveRecord {

    public $confirmPassword;

    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['username', 'email', 'password', 'confirmPassword'], 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\Users', 'message' => 'This username has already been taken.'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\app\models\Users', 'message' => 'This email has already been taken.'],
            ['password', 'string', 'length' => [8, 45]],
            ['confirmPassword', 'validateConfirmPassword'],
        ];
    }
    public function validateConfirmPassword($attribute)
    {
        if($this->confirmPassword != $this->password ){
            $this->addError($attribute, 'Confirm password must be the same.');
        }
    }
    public function register(){
        if(!$this->hasErrors() && $this->validate()){
            Yii::$app->session->setFlash('success', 'Registration is complete');
            return true;
        }else{
            Yii::$app->session->setFlash('error', 'Data is incorrect');
            return false;
        }
    }
}