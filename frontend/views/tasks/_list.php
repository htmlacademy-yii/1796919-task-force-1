<?php
/* @var $model object */
?>
<div class="new-task__card">
    <div class="new-task__title">
        <a href="/task/view/<?php echo $model->id; ?>" class="link-regular"><h2><?php echo $model->title; ?></h2></a>
        <a class="new-task__type link-regular" href="#"><p><?php echo $model->category->title; ?></p></a>
    </div>
    <div class="new-task__icon new-task__icon--<?php echo $model->category->slug; ?>"></div>
    <p class="new-task_description"><?php echo $model->description; ?></p>
    <b class="new-task__price new-task__price--<?php echo $model->category->slug; ?>"><?php echo $model->price; ?><b> ₽</b></b>
    <p class="new-task__place"><?php echo @$model->city->title; ?></p>
    <span class="new-task__time"><?php echo Yii::$app->formatter->format($model->created_at, 'relativeTime'); ?></span>
</div>