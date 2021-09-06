<?php
/* @var $model object */
/* @var $age int */
$this->title = $model->name;

?>
<section class="content-view">
    <div class="user__card-wrapper">
        <div class="user__card">
            <img src="<?php echo $model->avatar; ?>" width="120" height="120" alt="Аватар пользователя">
            <div class="content-view__headline">
                <h1><?php echo $model->name; ?></h1>
                <p><?php echo $model->city->title; ?>, <?php echo $age.Yii::$app->utils->int2txt($age, ' лет', ' год', ' года'); ?></p>
                <div class="profile-mini__name five-stars__rate">
                    <?php echo \frontend\widgets\RateWidget::widget(['rating' => $model->rate]) ?>
                </div>
                <b class="done-task">
                    <?php echo \frontend\widgets\UserProfileWidget::widget([
                        'quantity' => count($model->tasksAsWorker),
                        'template' => 'user_profile_orders',
                    ]) ?>
                </b>
              <b class="done-review">
                  <?php echo \frontend\widgets\UserProfileWidget::widget([
                          'quantity' => count($model->reviewsAsWorker),
                          'template' => 'user_profile_reviews',
                  ]) ?>
                 </b>
            </div>
            <div class="content-view__headline user__card-bookmark user__card-bookmark--current">
                <span>Был на сайте <?php echo Yii::$app->formatter->format($model->register_at, 'relativeTime'); ?></span>
                <a href="#"><b></b></a>
            </div>
        </div>
        <div class="content-view__description">
            <p><?php echo $model->about; ?></p>
        </div>
        <div class="user__card-general-information">
            <div class="user__card-info">
                <h3 class="content-view__h3">Специализации</h3>
                <div class="link-specialization">
                  <?php foreach ($model->userCategories as $userCategory) {  ?>
                    <a href="browse.html" class="link-regular"><?php echo $userCategory->category->title; ?></a>
                  <?php } ?>
                </div>
                <h3 class="content-view__h3">Контакты</h3>
                <div class="user__card-link">
                    <?php if($model->show_contacts) {?>
                    <?php echo ($model->phone != null)?'<a class="user__card-link--tel link-regular" href="#">'.$model->phone.'</a>':''; ?>
                    <?php echo ($model->email != null)?'<a class="user__card-link--email link-regular" href="mailto:'.$model->email.'">'.$model->email.'</a>':''; ?>
                    <?php echo ($model->skype != null)?'<a class="user__card-link--tel link-regular" href="#">'.$model->skype.'</a>':''; ?>
                  <?php } ?>
                </div>
            </div>
            <div class="user__card-photo">
                <h3 class="content-view__h3">Фото работ</h3>
                <a href="#"><img src="./img/rome-photo.jpg" width="85" height="86" alt="Фото работы"></a>
                <a href="#"><img src="./img/smartphone-photo.png" width="85" height="86" alt="Фото работы"></a>
                <a href="#"><img src="./img/dotonbori-photo.png" width="85" height="86" alt="Фото работы"></a>
            </div>
        </div>
    </div>
    <div class="content-view__feedback">
        <h2>Отзывы<span>(<?php echo count($model->reviewsAsWorker); ?>)</span></h2>
        <div class="content-view__feedback-wrapper reviews-wrapper">
          <?php foreach ($model->reviewsAsWorker as $item) { ?>
            <div class="feedback-card__reviews">
              <p class="link-task link">Задание <a href="/task/view/<?php echo $item->task_id; ?>" class="link-regular">«<?php echo $item->task->title; ?>»</a></p>
              <div class="card__review">
                <a href="#"><img src="<?php echo $item->customer->avatar; ?>" width="55" height="54"></a>
                <div class="feedback-card__reviews-content">
                  <p class="link-name link"><a href="/user/view/<?php echo $item->customer->id; ?>" class="link-regular"><?php echo $item->customer->name; ?></a></p>
                  <p class="review-text"><?php echo $item->body; ?></p>
                </div>
                <div class="card__review-rate">
                  <p class="<?php echo \frontend\models\Review::RATE_COLOR[$item->rate]; ?>-rate big-rate"><?php echo $item->rate; ?><span></span></p>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
    </div>
</section>
<section class="connect-desk">
    <div class="connect-desk__chat">

    </div>
</section>
