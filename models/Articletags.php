<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "articletags".
 *
 * @property int $idArticleTags
 * @property int $ArtTags
 * @property int $idArticle
 *
 * @property Article $article
 * @property Tag $artTags
 */
class Articletags extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articletags';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ArtTags', 'idArticle'], 'integer'],
            [['idArticle'], 'exist', 'skipOnError' => true, 'targetClass' => Article::className(), 'targetAttribute' => ['idArticle' => 'idArticle']],
            [['ArtTags'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['ArtTags' => 'idtag']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idArticleTags' => 'Id Article Tags',
            'ArtTags' => 'Art Tags',
            'idArticle' => 'Id Article',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['idArticle' => 'idArticle']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArtTags()
    {
        return $this->hasOne(Tag::className(), ['idtag' => 'ArtTags']);
    }
}
