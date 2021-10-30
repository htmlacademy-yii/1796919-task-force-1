<?php

namespace frontend\controllers;

use frontend\models\Category;
use frontend\models\File;
use frontend\models\form\CreateTaskForm;
use frontend\models\form\TaskFilterForm;
use frontend\models\Task;
use frontend\models\TaskSearch;
use frontend\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class TasksController extends InitController
{
    public $enableCsrfValidation = false;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index','view'],
                        'allow' => true,
                        'roles' => ['@']
                    ],
                    [
                        'actions' => ['create','upload'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->role == 'customer';
                        }
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    return $this->redirect('/');
                },
            ]
        ];
    }
    public function actionIndex()
    {
        $categories = ArrayHelper::map(Category::find()->all(), 'id', 'title');
        $searchModel = new TaskSearch();
        $searchModel->load(Yii::$app->request->post());
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('index', [
            'filter' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories' => $categories,
        ]);
    }

    public function actionView(int $id)
    {
        if(!$model = Task::findOne($id))
        {
            throw new NotFoundHttpException('Не найдена задача с ID:'.$id);
        }
        
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $model = new CreateTaskForm();
        $categories = ArrayHelper::map(Category::find()->all(), 'id', 'title');

        if(Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());

            $customer_id = Yii::$app->user->id;

            if ($model->validate() && $task = $model->createTask($customer_id)) {
                Yii::$app->session->remove('unique_string');
                $this->redirect(['view', 'id' => $task->id]);
            }
        }
        Yii::$app->session->set('unique_string', Yii::$app->security->generateRandomString(32));
        return $this->render('create', [
            'categories' => $categories,
            'model' => $model,
        ]);
    }

    public function actionUpload() : array
    {
        $this->enableCsrfValidation = false;
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->request->isAjax) {
            $files = UploadedFile::getInstancesByName('files');
            $result_array = File::saveFiles($files, Yii::$app->session->get('unique_string'));
            return $result_array;
        }

        return [];
    }
}
