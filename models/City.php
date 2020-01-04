<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property int $id
 * @property string $city
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city'], 'required'],
            [['city'], 'string', 'max' => 100],
            [['city'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city' => 'City',
        ];
    }

    public static function getData(){
        $data = City::find()
        ->select(['name as value', 'name as  label','id as id'])
        ->asArray()
        ->all();

        return $data;
    }
}
