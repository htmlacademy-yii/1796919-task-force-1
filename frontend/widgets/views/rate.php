<?php
/* @var $rating */
?>
<?php
for ($i=1;$i<6;$i++)
{
    echo ($i <= floor($rating))?'<span></span>':'<span class="star-disabled"></span>';
}
?>
<b><?php echo round($rating,2); ?></b>