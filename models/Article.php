<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Html;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $body
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $seen
 * @property int $is_public
 * @property int $is_commentable
 *
 * @property User $createdBy
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

    public function init() {
        parent::init ();
        $this->is_public = 1;
        $this->is_commentable = 1;
    }

    public function behaviors(){
        return [
            TimestampBehavior::class,
            [
                'class' => BlameableBehavior::class,
                'updatedByAttribute' => false
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'body','is_public', 'is_commentable'], 'required'],
            [['body'], 'string', 'max' => 5000],
            [['created_by','is_public', 'is_commentable' ], 'integer'],
            
            [['title'], 'string', 'max' => 60],
            [['description'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Cím',
            'description' => 'Rövid leírás',
            'body' => 'Tartalom',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'seen' => 'Seen',
            'is_public' => 'Publikus',
            'is_commentable' => 'Kommentelhető',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getComments(){
        return $this->hasMany(Comment::className(), ['article_id' => 'id']);
    }

    public function getEncodedBody(){
        return Html::encode($this->body);
    }

    public static function getMyArticles($id){
        $myArticles = Article::find()->where(['created_by' => $id])->orderBy('created_at DESC')->all();
        return $myArticles;
    }
}
