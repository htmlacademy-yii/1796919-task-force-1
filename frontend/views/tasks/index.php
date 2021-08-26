<?php
/* @var $this yii\web\View */
/* @var $filter object */
/* @var $categories array */
/* @var $dataProvider */
/* @var $searchModel */

use yii\widgets\ListView;

?>
<section class="new-task">
  <div class="new-task__wrapper">
    <h1>Новые задания</h1>
      <?php
      echo ListView::widget([
          'dataProvider' => $dataProvider,
          'itemView' => '_list',
      ]);
      ?>
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


