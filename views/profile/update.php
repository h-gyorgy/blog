<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\SignupForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use app\models\City;

$this->title = 'Profil szerkesztése';

?>
<div class="site-profile">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Töltsd ki a következő mezőket:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'profile-form',
        'options' => ['autocomplete' => 'off'],
        'fieldConfig' => [
            'template' => "{label}<br><div class=\"col-12\">{input}</div><br><div class=\"col-12\">{error}</div>",
            'labelOptions' => ['class' => 'control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'email', ['enableAjaxValidation' => true])->textInput(['autofocus' => true, 'value'=>''])->input('email', ['placeholder' => $model->oldEmail]) ?>


        <?= $form->field($model, 'username', 
            ['enableAjaxValidation' => true, 
            
            ])->textInput(['inputOptions' => ['autocomplete' => 'off']])->input('username', ['placeholder' => $model->oldUsername]) ?>

        <?= $form->field($model, 'password')->passwordInput([]) ?>

        <?= $form->field($model, 'password_repeat')->passwordInput() ?>

        <?= $form->field($model, 'date_of_birth', ['enableAjaxValidation' => true]) ?>  


        <?= $form->field($model, 'city', ['enableAjaxValidation' => true])->widget(AutoComplete::classname(), [
            'attribute' => 'name',
            'clientOptions' => [
                'minLength' => 3,
                'source' => City::getData(),
                'autoFill' => true
            ],
            'options' => ['class' => 'form-control']
        ]) ?>


        <?= $form->field($model, 'about_me')->textarea(['rows' => '4']) ?>

        
        <div class="form-group">
            <div class="col-12">
                <?= Html::submitButton('Változások mentése', ['class' => 'btn btn-primary', 'name' => 'update-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

    
</div>
