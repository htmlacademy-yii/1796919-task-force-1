<?php

namespace frontend\controllers;

use frontend\models\Category;
use frontend\models\form\TaskFilterForm;
use frontend\models\Task;
use frontend\models\TaskSearch;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

class TasksController extends \yii\web\Controller
{
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

}
