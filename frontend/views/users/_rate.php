<?php
/* @var $rate */
?>
<?php
for ($i=1;$i<6;$i++)
{
    echo ($i <= floor($rate))?'<span></span>':'<span class="star-disabled"></span>';
}
?>
<b><?php echo round($rate,2); ?></b>
