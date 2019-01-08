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
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['UType'], 'integer'],
            [['username', 'password'], 'required'],
            [['username'], 'string', 'max' => 25],
            [['password', 'email'], 'string', 'max' => 45],
            [['auth_key', 'access_toke'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idUser' => 'Id User',
            'UType' => 'Utype',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'auth_key' => 'Auth Key',
            'access_toke' => 'Access Toke',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['idUser' => 'idUser']);
    }
}