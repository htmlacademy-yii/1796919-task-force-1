<?php
/* @var $this yii\web\View */
/* @var $tasks array */
/* @var $filter object */
/* @var $categories array */
?>
<section class="new-task">
  <div class="new-task__wrapper">
    <h1>Новые задания</h1>
      <?php foreach ($tasks as $task) { ?>
        <div class="new-task__card">
          <div class="new-task__title">
            <a href="view.html" class="link-regular"><h2><?php echo $task->title; ?></h2></a>
            <a class="new-task__type link-regular" href="#"><p><?php echo $task->category->title; ?></p></a>
          </div>
          <div class="new-task__icon new-task__icon--<?php echo $task->category->slug; ?>"></div>
          <p class="new-task_description"><?php echo $task->description; ?></p>
          <b class="new-task__price new-task__price--<?php echo $task->category->slug; ?>"><?php echo $task->price; ?><b> ₽</b></b>
          <p class="new-task__place"><?php echo @$task->city->title; ?></p>
          <span class="new-task__time"><?php echo Yii::$app->formatter->format($task->created_at, 'relativeTime'); ?></span>
        </div>
      <?php }  ?>
  </div>
  <div class="new-task__pagination">
    <ul class="new-task__pagination-list">
      <li class="pagination__item"><a href="#"></a></li>
      <li class="pagination__item pagination__item--current">
        <a>1</a></li>
      <li class="pagination__item"><a href="#">2</a></li>
      <li class="pagination__item"><a href="#">3</a></li>
      <li class="pagination__item"><a href="#"></a></li>
    </ul>
  </div>
</section>
<?= $this->render('_aside', [
    'filter' => $filter,
    'categories' => $categories
]) ?>


