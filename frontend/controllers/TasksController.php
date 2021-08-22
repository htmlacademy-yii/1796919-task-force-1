<?php

namespace frontend\controllers;

use frontend\models\Category;
use frontend\models\form\TaskFilterForm;
use frontend\models\TaskSearch;
use Yii;
use yii\helpers\ArrayHelper;

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

}
