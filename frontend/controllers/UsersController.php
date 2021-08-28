<?php

namespace frontend\controllers;

use frontend\models\Category;
use frontend\models\User;
use frontend\models\UsersSearch;
use yii\helpers\ArrayHelper;
use Yii;
use yii\web\NotFoundHttpException;

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

    public function actionView(int $id)
    {
        if(!$model = User::find()->where(['id' => $id, 'show_profile' => 1])->one())
        {
            throw new NotFoundHttpException('Не найден профиль с ID:'.$id);
        }

        $born = new \DateTime($model->birthday);
        $age = $born->diff(new \DateTime)->format('%y');

        return $this->render('view', [
            'model' => $model,
            'age' => $age
        ]);
    }
}
