<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property int $idComment
 * @property string $ComText
 * @property string $ComDate
 * @property string $TargetName
 * @property int $idUser
 * @property int $Article_ID
 *
 * @property User $user
 * @property Article $article
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ComText'], 'string'],
            [['ComDate'], 'safe'],
            [['idUser', 'Article_ID'], 'integer'],
            [['TargetName'], 'string', 'max' => 45],
            [['idUser'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idUser' => 'iduser']],
            [['Article_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Article::className(), 'targetAttribute' => ['Article_ID' => 'idArticle']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idComment' => 'Id Comment',
            'ComText' => 'Com Text',
            'ComDate' => 'Com Date',
            'TargetName' => 'Target Name',
            'idUser' => 'Id User',
            'Article_ID' => 'Article  ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['iduser' => 'idUser']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['idArticle' => 'Article_ID']);
    }
}
