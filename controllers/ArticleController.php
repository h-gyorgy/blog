<?php

namespace app\controllers;

use Yii;
use app\models\Article;
use app\models\OrderForm;
use app\models\Comment;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => AccessControl::class,
                'only' => ['create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['update', 'create', 'delete'],
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]

            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex($orderby = '')
    {
        $orderForm = new OrderForm();
        
        
        if($orderForm->load(Yii::$app->request->post()))
        {
            $orderby = $orderForm->orderby;
            return $this->redirect(['index', 'orderby' => $orderby]);
        }

        $orderForm->selected = $orderby;

        $orderby = OrderForm::validateOrder($orderby);


        $query = Article::find()->where(['is_public' => 1])->orderBy($orderby . ' DESC');
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 10]);
        $articles = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        
        //$articles = Article::find()->where(['is_public' => 1])->orderBy($orderby . ' DESC')->all();
       
        return $this->render('index', [
            'articles' => $articles,
            'orderForm' => $orderForm,
            'orderby' => $orderby,
            'pages' => $pages,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $article = $this->findModel($id);
        $comment = new Comment();


        if ($comment->load(Yii::$app->request->post()) && $comment->save()) {
            
            if($comment->article->createdBy->id != Yii::$app->user->id){
                $comment->article->seen--;
            } 
            $comment->article->comment_count++;
            $comment->article->save(); 
            return $this->redirect(['view', 'id' => $comment->article->id]);
        }

        if($article->createdBy->id != Yii::$app->user->id){
             $article->seen++;
             $article->save(); 
        }
        return $this->render('view', [
            'article' => $article,
            'comment' => $comment
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if($model->created_by !== Yii::$app->user->id){
            throw new ForbiddenHttpException("Nincs jososultásgod a bejegyzés szerkesztéséhez!");
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if($model->created_by !== Yii::$app->user->id){
            throw new ForbiddenHttpException("Nincs jogosultságod törölni ezt a bejegyzést!");
        }

        $model->delete();
        foreach($model->comments as $comment){
            $comment->delete();
        }

        return $this->redirect(['profile/'. $model->createdBy->id . '/admin']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
