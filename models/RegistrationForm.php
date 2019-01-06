<?php
namespace app\models;

use Yii;
use yii\base\Model;

class RegistrationForm extends Model{
    public $username;
    public $password;
    public $email;
    public $confirmPassword;

    public $_userType = '0';

    public function rules()
    {
        return [
            //[['username', 'email', 'password', 'confirmPassword'], 'required'],
            ['username', 'validateUsername'],
            ['email', 'email'],
            ['password', 'string', 'length' => [8, 45]],
            ['confirmPassword', 'validateConfirmPassword'],
        ];
    }
    public function validateUsername($error)
    {
        if($error){
            $this->addError($this->username, $error);
        }
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