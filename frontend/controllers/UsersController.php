<?php

namespace frontend\controllers;

use frontend\models\Category;
use frontend\models\City;
use frontend\models\SignupForm;
use frontend\models\User;
use frontend\models\UsersSearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use Yii;
use yii\web\NotFoundHttpException;

class UsersController extends InitController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?']
                    ],
                    [
                        //'actions' => ['*'],
                        'allow' => true,
                        'roles' => ['@']
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

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $cities = City::find()->select('title')->indexBy('id')->column();
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {

            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
            'cities' => $cities,
        ]);
    }

    public function actionLogout()
    {
        if (!Yii::$app->user->isGuest) {
            Yii::$app->user->logout();
            return $this->goHome();
        }
    }
}
