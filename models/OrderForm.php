<?php

namespace app\models;

use Yii;
use yii\base\Model;


class OrderForm extends Model
{
    public $orderby;
    public $selected = '';

    public function rules(){
        return[
            ['orderby', 'required'],
            ['orderby', 'string']
        ];
    }
    
    public function attributeLabels(){
        return[
            'orderby' => 'Rendezés'
        ];
    }

    public static function validateOrder($orderby){
        switch($orderby){
            case 'created_at': $orderby = 'created_at'; break;
            case 'seen': $orderby = 'seen'; break;
            case 'comment_count': $orderby = 'comment_count'; break;
            default: $orderby = 'created_at';
        }
        return $orderby;
    }
}
