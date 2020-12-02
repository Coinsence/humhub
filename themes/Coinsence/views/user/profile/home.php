<?php

use humhub\modules\friendship\widgets\FriendsPanel;
use humhub\modules\post\widgets\Form;
use humhub\modules\user\widgets\ProfileSidebar;
use humhub\modules\user\widgets\StreamViewer;
use humhub\modules\user\widgets\UserFollower;
use humhub\modules\user\widgets\UserSpaces;
use humhub\modules\user\widgets\UserTags;
use humhub\modules\user\widgets\UserWall;
use humhub\modules\xcoin\widgets\UserCoin;
use humhub\modules\like\widgets\LikeLink;
use humhub\modules\user\widgets\UserListBox;
use humhub\modules\xcoin\widgets\UserLike;

?>


<?= Form::widget(['contentContainer' => $user]); ?>
<?= StreamViewer::widget(['contentContainer' => $user]); ?>


<?php $this->beginBlock('sidebar'); ?>
<?=
ProfileSidebar::widget([
    'user' => $user,
    'widgets' => [
        [UserCoin::class, ['user' => $user], ['sortOrder' => 10]],
        [UserSpaces::class, ['user' => $user], ['sortOrder' => 20]],
        [FriendsPanel::class, ['user' => $user], ['sortOrder' => 30]],
        [UserFollower::class, ['user' => $user], ['sortOrder' => 40]],

    ]
]);
?>
<?php $this->endBlock(); ?>
