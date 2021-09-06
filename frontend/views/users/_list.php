<?php
/* @var $model object */
?>
<div class="content-view__feedback-card user__search-wrapper">
    <div class="feedback-card__top">
        <div class="user__search-icon">
            <a href="/user/view/<?php echo $model->id; ?>"><img src="<?php echo $model->avatar; ?>" width="65" height="65"></a>
            <span><?php echo count($model->tasksAsWorker); ?> заданий</span>
            <span><?php echo count($model->reviewsAsWorker); ?> отзывов</span>
        </div>
        <div class="feedback-card__top--name user__search-card">
            <p class="link-name"><a href="/user/view/<?php echo $model->id; ?>" class="link-regular"><?php echo $model->name; ?></a></p>
            <?php echo \frontend\widgets\RateWidget::widget(['rating' => $model->rate]) ?>
            <p class="user__search-content"><?php echo $model->about; ?></p>
        </div>
        <span class="new-task__time">Был на сайте <?php echo Yii::$app->formatter->format($model->activity, 'relativeTime'); ?></span>
    </div>
    <div class="link-specialization user__search-link--bottom">
        <?php foreach ($model->userCategories as $userCategory) { ?>
            <a href="<?php echo $userCategory->category->slug; ?>" class="link-regular"><?php echo $userCategory->category->title; ?></a>
        <?php } ?>
    </div>
</div>