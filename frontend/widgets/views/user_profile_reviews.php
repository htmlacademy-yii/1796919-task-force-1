<?php
/* @var $quantity */

if($quantity == 0) { ?>
  нет отзывов
<?php } else { ?>
  Получил <?php echo $quantity.Yii::$app->utils->int2txt($quantity, ' отзывов', ' отзыв', ' отзыва'); ?>
<?php }