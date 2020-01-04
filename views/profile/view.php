<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $user->username
?>

<div class="article-index">
    
    

    <h1><?= Html::encode($this->title) ?></h1>

    <hr>

    <?php if($user->profile->date_of_birth != null) :?>  
        <p>Születési dátum: <strong><?= $user->profile->date_of_birth ?></strong></p>
    <?php endif; ?>

    <?php if($user->profile->city != null) :?>  
        <p>Lakóhely: <strong><?= $user->profile->city ?></strong></p>
    <?php endif; ?>

    <?php if($user->profile->about_me != null) :?>  
        <p>Bemutatkozás: <strong><?= $user->profile->about_me ?></strong></p>
    <?php endif; ?>

    
    <p>
        <?= Html::a('Bejegyzések száma: ' . '<b>' . count($user->articles) . '</b>', '@web/profile/' . $user->id . '/articles') ?>
    </p>
    

    <hr>

    <?php if($user->id === Yii::$app->user->id) :?>  
        <a href="<?php echo \yii\helpers\Url::to(['profile/' . $user->id . '/update' ]) ?>"> 
                <button class="btn btn-primary">Profil szerkesztése</button>
        </a>
    <?php endif; ?>
   
       
       

   