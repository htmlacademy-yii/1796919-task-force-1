<?php
/* @var $this yii\web\View */
/* @var $users array */
/* @var $categories array */
/* @var $dataProvider */
/* @var $filter */

use yii\widgets\ListView;
?>
<section class="user__search">
    <?php
    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_list',
    ]);
    ?>
</section>
<?= $this->render('_aside', [
    'filter' => $filter,
    'categories' => $categories
]) ?>