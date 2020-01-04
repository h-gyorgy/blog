<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

?>


<h1><?= Html::a($user->username, '@web/profile/' . $user->id) ?> bejegyzései</h1>

<?php foreach(array_reverse($user->articles) as $article){

    if((!Yii::$app->user->isGuest && $article->created_by == Yii::$app->user->identity->id) || $article->is_public == 1){
        
            echo $this->render('_article_item', ['article' => $article]);
    }
}

?>



