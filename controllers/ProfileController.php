<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use yii\widgets\ActiveForm;
use app\models\SignupForm;
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
        
            $articles = Article::find()->where(['created_by' => $user->id])->orderBy('created_at DESC')->all();

            return $this->render('view', [
                'user' => $user,
                'articles' => $articles
                ]
            );
        } 
        throw new NotFoundHttpException("A profil nem található!");
    }

    public function actionArticles($id){
        $user = User::findIdentity($id);
        return $this->render('articles', ['user' => $user]);
    }

    public function actionUpdate($id){

        if($id != Yii::$app->user->id){
            throw new ForbiddenHttpException("Az oldal megtekintéséhez nem rendelkezel jogosultsággal!");
        }

        $model = new UpdateProfile();
        $user = User::findIdentity($id);

        $model->oldUsername = $user->username;
        $model->oldEmail = $user->email;
        $model->date_of_birth = $user->profile->date_of_birth;
        $model->city = $user->profile->city;
        $model->about_me = $user->profile->about_me;

        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if($model->load(Yii::$app->request->post()) && $model->updateProfile($id))
        {
            return $this->redirect('@web/profile/' . $user->id);
        }

        return $this->render('update', ['model' => $model]);
    }

    public function actionAdmin($id){

        if($id != Yii::$app->user->identity->id){
            throw new ForbiddenHttpException("Az oldal megtekintéséhez nem rendelkezel jogosultsággal!");
        }

        $myArticles = Article::getMyArticles($id);

        return $this->render('admin', ['myArticles' => $myArticles]
        );
    }
}