<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $idCategory
 * @property string $CName
 * @property string $CDescription
 * @property string $CPic
 *
 * @property Article[] $articles
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['CName'], 'required'],
            [['CName', 'CDescription', 'CPic'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idCategory' => 'Id Category',
            'CName' => 'Cname',
            'CDescription' => 'Cdescription',
            'CPic' => 'Cpic',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['idCat' => 'idcategory']);
    }
}
