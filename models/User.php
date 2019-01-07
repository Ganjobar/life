<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $idUser
 * @property int $UType
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $auth_key
 * @property string $access_toke
 *
 * @property Comment[] $comments
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
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
