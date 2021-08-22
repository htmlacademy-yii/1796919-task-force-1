<?php

namespace frontend\controllers;

use frontend\models\Category;
use frontend\models\UsersSearch;
use yii\helpers\ArrayHelper;
use Yii;

class UsersController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $categories = ArrayHelper::map(Category::find()->all(), 'id', 'title');
        $searchModel = new UsersSearch();
        $searchModel->load(Yii::$app->request->post());
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('index', [
            'filter' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories' => $categories,
        ]);
    }

}
