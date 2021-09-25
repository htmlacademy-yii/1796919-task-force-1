<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */
/* @var $cities array */


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация аккаунта';
?>
<div class="main-container page-container">
  <section class="registration__user">
    <h1>Регистрация аккаунта</h1>
    <div class="registration-wrapper">
        <?php $form = ActiveForm::begin(['id' => 'form-signup',
            'options' => [
                'class' => 'registration__user-form form-create'
            ],
            'fieldConfig' => [
                'options' => [
                    'class' => 'field-container field-container--registration',
                ],
                'errorOptions' => ['class' => 'registration__text-error', 'tag' => 'span']
            ]
            ]); ?>
            <?= $form->field($model, 'email', [
                'labelOptions' => ['class' => '']
            ])->textInput(['class' => 'input textarea', 'placeholder'=>'']) ?>

            <?= $form->field($model, 'name', [
                'labelOptions' => ['class' => '']
            ])->textInput(['class' => 'input textarea', 'placeholder'=>'']) ?>

            <?= $form->field($model, 'city', [
                'labelOptions' => ['class' => '']
            ])->dropDownList($cities,['class' => 'multiple-select input town-select registration-town']); ?>

            <?= $form->field($model, 'password', [
                'labelOptions' => ['class' => '']
            ])->passwordInput(['class' => 'input textarea', 'placeholder'=>'']) ?>

            <?= \yii\helpers\Html::button('Создать аккаунт', [
                'type' => 'submit',
                'class' => 'button button__registration'
            ]) ?>
        <?php ActiveForm::end(); ?>
    </div>
  </section>

</div>

