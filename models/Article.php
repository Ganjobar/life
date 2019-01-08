<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property int $idArticle
 * @property string $AText
 * @property string $APic
 * @property string $AName
 * @property string $ACreateDate
 * @property int $idCat
 *
 * @property Category $cat
 * @property Articletags[] $articletags
 * @property Comment[] $comments
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['ACreateDate', 'unique', 'targetClass' => '\app\models\Article', 'message' => 'This date has already been taken.'],
            [['idCat'], 'required'],
            [['idCat'], 'integer'],
            [['AText', 'APic', 'AName'], 'string', 'max' => 2500],
            [['idCat'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['idCat' => 'idcategory']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idArticle' => 'Id Article',
            'AText' => 'Atext',
            'APic' => 'Apic',
            'AName' => 'Aname',
            'ACreateDate' => 'Acreate Date',
            'idCat' => 'Id Cat',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(Category::className(), ['idcategory' => 'idCat']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticletags()
    {
        return $this->hasMany(Articletags::className(), ['idArticle' => 'idArticle']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['Article_ID' => 'idArticle']);
    }
}
