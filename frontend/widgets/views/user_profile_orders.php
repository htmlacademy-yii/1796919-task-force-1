<?php
/* @var $quantity */

if($quantity == 0) { ?>
    нет заказов
<?php } else { ?>
    Выполнил <?php echo $quantity.Yii::$app->utils->int2txt($quantity, ' заказов', ' заказ', ' заказа'); ?>
<?php }