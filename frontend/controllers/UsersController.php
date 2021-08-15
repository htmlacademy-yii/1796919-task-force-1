<?php

namespace frontend\controllers;

use frontend\models\Category;
use frontend\models\form\UserFilterForm;
use yii\helpers\ArrayHelper;
use Yii;

class UsersController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $filter = new UserFilterForm();
        $categories = ArrayHelper::map(Category::find()->all(), 'id', 'title');

        if(Yii::$app->request->isPost) {
            $filter->load(Yii::$app->request->post());
        }
        $users = $filter->getUsers();

        return $this->render('index', [
            'users' => $users,
            'filter' => $filter,
            'categories' => $categories
        ]);
    }

}
