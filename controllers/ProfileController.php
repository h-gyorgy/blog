<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;
use app\models\User;
use app\models\UpdateProfile;
use app\models\City;
use yii\web\NotFoundHttpException;
use app\models\Article;
use yii\web\ForbiddenHttpException;


class ProfileController extends Controller
{


    public function actionView($id){
        
        if($user = User::findIdentity($id)){ 

            return $this->render('view', ['user' => $user]);
        } 
        throw new NotFoundHttpException("A profil nem található!");
    }


    public function actionArticles($id){
        if($user = User::findIdentity($id)){ 

            return $this->render('articles', ['user' => $user]);
        } 
        throw new NotFoundHttpException("A profil nem található!");
    }


    public function actionUpdate($id){

        if($id != Yii::$app->user->id){
            throw new ForbiddenHttpException("Az oldal megtekintéséhez nem rendelkezel jogosultsággal!");
        }

        $model = new UpdateProfile();
        $model->loadData($id);

        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if($model->load(Yii::$app->request->post()) && $model->updateProfile($id))
        {
            return $this->redirect('@web/profile/' . $id);
        }

        return $this->render('update', ['model' => $model]);
    }


    public function actionAdmin($id){

        if(Yii::$app->user->isGuest || $id != Yii::$app->user->identity->id){
            throw new ForbiddenHttpException("Az oldal megtekintéséhez nem rendelkezel jogosultsággal!");
        }

        $myArticles = Article::getMyArticles($id);

        return $this->render('admin', ['myArticles' => $myArticles]);
    }
}