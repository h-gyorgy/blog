<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bejegyzések';

?>

<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>
    <?php if(!Yii::$app->user->isGuest): ?>
        
      <?= Html::a('+ Új bejegyzés', ['create'], ['class' => 'btn btn-success']) ?>
        
    <?php endif; ?>

    <div class="order-form">

      <?php $form = ActiveForm::begin(); ?>

      <div class="form-group order-btn">
        <?= Html::submitButton('Rendez', ['class' => 'btn btn-primary order']) ?>
      </div>

      <?= $form->field($orderForm, 'orderby')->dropdownList(
        [
          'created_at' => 'Legfrissebb elöl',
          'comment_count' => 'Hozzászólások száma',
          'seen' => 'Megtekintések száma'
        ],
        ["options" => [$orderForm->selected => ['selected' => true]]])->label(false)?>

      <?php ActiveForm::end(); ?>

    </div>

    <div class="clearfix"></div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php foreach($articles as $article){

      echo $this->render('_article_item', [
        'article' => $article
      ]);
    }?>

</div>









