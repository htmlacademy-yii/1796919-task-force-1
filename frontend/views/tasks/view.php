<?php
/* @var $model object */
$this->title = $model->title;
?>
    <section class="content-view">
        <div class="content-view__card">
            <div class="content-view__card-wrapper">
                <div class="content-view__header">
                    <div class="content-view__headline">
                        <h1><?php echo $model->title; ?></h1>
                        <span>Размещено в категории
                                    <a href="browse.html" class="link-regular"><?php echo $model->category->title; ?></a>
                                    <?php echo Yii::$app->formatter->format($model->created_at, 'relativeTime'); ?></span>
                    </div>
                    <b class="new-task__price new-task__price--<?php echo $model->category->slug; ?> content-view-price"><?php echo $model->price; ?><b> ₽</b></b>
                    <div class="new-task__icon new-task__icon--<?php echo $model->category->slug; ?> content-view-icon"></div>
                </div>
                <div class="content-view__description">
                    <h3 class="content-view__h3">Общее описание</h3>
                    <p><?php echo $model->description; ?></p>
                </div>
                <div class="content-view__attach">
                    <h3 class="content-view__h3">Вложения</h3>
                    <?php foreach ($model->files as $file) { ?>
                      <a href="#"><?php echo basename($file); ?></a>
                    <?php } ?>
                </div>
                <div class="content-view__location">
                    <h3 class="content-view__h3">Расположение</h3>
                    <div class="content-view__location-wrapper">
                        <div class="content-view__map">
                            <a href="#"><img src="./img/map.jpg" width="361" height="292"
                                             alt="Москва, Новый арбат, 23 к. 1"></a>
                        </div>
                        <div class="content-view__address">
                            <span class="address__town">Москва</span><br>
                            <span>Новый арбат, 23 к. 1</span>
                            <p>Вход под арку, код домофона 1122</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-view__action-buttons">
                <button class=" button button__big-color response-button open-modal"
                        type="button" data-for="response-form">Откликнуться
                </button>
                <button class="button button__big-color refusal-button open-modal"
                        type="button" data-for="refuse-form">Отказаться
                </button>
                <button class="button button__big-color request-button open-modal"
                        type="button" data-for="complete-form">Завершить
                </button>
            </div>
        </div>
        <div class="content-view__feedback">
            <h2>Отклики <span>(2)</span></h2>
            <div class="content-view__feedback-wrapper">
                <?php foreach ($model->responses as $respons) { ?>
                  <div class="content-view__feedback-card">
                    <div class="feedback-card__top">
                      <a href="user.html"><img src="<?php echo $respons->worker->avatar;?>" width="55" height="55"></a>
                      <div class="feedback-card__top--name">
                        <p><a href="/user/view/<?php echo $respons->worker->id;?>" class="link-regular"><?php echo $respons->worker->name;?></a></p>
                          <?= $this->render('/users/_rate', [
                              'rate' => $respons->worker->rate
                          ]) ?>
                      </div>
                      <span class="new-task__time"><?php echo Yii::$app->formatter->format($respons->created_at, 'relativeTime'); ?></span>
                    </div>
                    <div class="feedback-card__content">
                      <p>
                          <?php echo $respons->comment;?>
                      </p>
                      <span><?php echo $respons->price; ?> ₽</span>
                    </div>
                    <div class="feedback-card__actions">
                      <a class="button__small-color response-button button"
                         type="button">Подтвердить</a>
                      <a class="button__small-color refusal-button button"
                         type="button">Отказать</a>
                    </div>
                  </div>
                <?php } ?>

            </div>
        </div>
    </section>
    <section class="connect-desk">
        <div class="connect-desk__profile-mini">
            <div class="profile-mini__wrapper">
                <h3>Заказчик</h3>
                <div class="profile-mini__top">
                    <img src="<?php echo $model->customer->avatar; ?>" width="62" height="62" alt="<?php echo $model->customer->name; ?>">
                    <div class="profile-mini__name five-stars__rate">
                        <p><?php echo $model->customer->name; ?></p>
                        <?= $this->render('/users/_rate', [
                            'rate' => $model->customer->rate
                        ]) ?>
                    </div>
                </div>
                <p class="info-customer"><span><?php
                        echo \Yii::$app->i18n->messageFormatter->format(
                            '{n, plural, one{ # задание} few{# задания} many{# заданий} other{# заданий}}',
                            ['n' => count($model->customer->tasksAsCustomer)],
                            \Yii::$app->language
                        )
                        ?></span><span class="last-"><?php echo Yii::$app->formatter->format($model->customer->register_at, 'relativeTime'); ?> на сайте</span></p>
                <a href="/user/view/<?php echo $model->customer->id;?>" class="link-regular">Смотреть профиль</a>
            </div>
        </div>
        <div id="chat-container">
            <!--                    добавьте сюда атрибут task с указанием в нем id текущего задания-->
            <chat class="connect-desk__chat"></chat>
        </div>
    </section>
