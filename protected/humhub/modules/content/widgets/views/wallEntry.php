<?php

use Codeception\Command\Console;
use humhub\libs\Html;
use humhub\modules\content\widgets\WallEntryAddons;
use humhub\modules\content\widgets\WallEntryControls;
use humhub\modules\content\widgets\WallEntryLabels;
use humhub\modules\space\models\Space;
use humhub\modules\space\widgets\Image as SpaceImage;
use humhub\modules\user\widgets\Image as UserImage;
use humhub\widgets\TimeAgo;
use yii\helpers\Url;
use Imgix\UrlBuilder;

/* @var $object \humhub\modules\content\models\Content */
/* @var $container \humhub\modules\content\components\ContentContainerActiveRecord */
/* @var $renderControls boolean */
/* @var $wallEntryWidget string */
/* @var $user \humhub\modules\user\models\User */
/* @var $showContentContainer \humhub\modules\user\models\User */
?>

<div class="panel panel-default wall_<?= $object->getUniqueId(); ?>">
<div class="panel-body">

<div class="media">
<!-- since v1.2 -->
<div class="stream-entry-loader"></div>

<!-- start: show wall entry options -->
<?php if ($renderControls) : ?>
<ul class="nav nav-pills preferences">
<li class="dropdown ">
<a class="dropdown-toggle" data-toggle="dropdown" href="#"
aria-label="<?= Yii::t('base', 'Toggle stream entry menu'); ?>" aria-haspopup="true">
<i class="fa fa-angle-down"></i>
</a>

<ul class="dropdown-menu pull-right">
<?= WallEntryControls::widget(['object' => $object, 'wallEntryWidget' => $wallEntryWidget]); ?>
</ul>
</li>
</ul>
<?php endif; ?>
<!-- end: show wall entry options -->





<div class="media-body">
<?php
$nombre_de_lignes = 1;


  echo '<img src="/themes/Coinsence/img/test/logo.png" style="width:100%" ><br/>';
  echo '  <img src="/themes/Coinsence/img/test/i.jpeg"> <br/>';
  echo '  <img src="/themes/Coinsence/img/test/i4.jpeg"><br/>';
  echo '  <img src="/themes/Coinsence/img/test/i4.jpeg"><br/>';
  echo ' <img src="/themes/Coinsence/img/test/i1.jpeg"><br/>';
  echo '<img src="/themes/Coinsence/img/test/i3.jpg"><br/>';
  echo '  <img src="/themes/Coinsence/img/test/i5.jpg" ><br/>';
  echo '  <img src="/themes/Coinsence/img/test/i6.jpeg"><br/>';
  echo ' <img src="/themes/Coinsence/img/test/i7.jpeg"><br/>';
  echo '  <img src="/themes/Coinsence/img/test/i8.jpeg"><br/>';
  echo '  <img src="/themes/Coinsence/img/test/i9.jpg" ><br/>';
  echo '  <img src="/themes/Coinsence/img/test/gif1.gif" ><br/>';
  echo ' <img src="/themes/Coinsence/img/test/i10.png" >';

    $nombre_de_lignes++; 

?>

</div>
<hr/>



<!-- wall-entry-addons class required since 1.2 -->


</div>
</div>
</div>
