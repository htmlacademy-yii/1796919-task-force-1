<?php
/* @var $filesList array */

foreach ($filesList as $file) { ?>
    <a href="<?php echo $file['url']; ?>"><?php echo $file['anchor']; ?></a>
<?php } ?>