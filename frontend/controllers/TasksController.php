<?php

namespace frontend\controllers;

use frontend\models\Category;
use frontend\models\form\TaskFilterForm;
use Yii;
use yii\helpers\ArrayHelper;

class TasksController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $categories = ArrayHelper::map(Category::find()->all(), 'id', 'title');
        $filter = new TaskFilterForm();

        if (Yii::$app->request->get('category')) {
            $filter->setCategory((int)Yii::$app->request->get('category'));
        }

        if (Yii::$app->request->isPost) {
            $filter->load(Yii::$app->request->post());
        }

        $tasks = $filter->getTasks();


        return $this->render('index', [
            'tasks' => $tasks,
            'filter' => $filter,
            'categories' => $categories
        ]);
    }

}
