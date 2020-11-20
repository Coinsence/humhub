<?php

use humhub\modules\user\controllers\ImageController;
use humhub\modules\user\widgets\ProfileHeaderCounterSet;
use yii\helpers\Html;
use yii\helpers\Url;
use humhub\modules\friendship\widgets\FriendshipButton;

if ($allowModifyProfileBanner || $allowModifyProfileImage) {
    $this->registerJsFile('@web-static/resources/user/profileHeaderImageUpload.js');
    $this->registerJs("var profileImageUploaderUserGuid='" . $user->guid . "';", \yii\web\View::POS_BEGIN);
    $this->registerJs("var profileImageUploaderCurrentUserGuid='" . Yii::$app->user->getIdentity()->guid . "';", \yii\web\View::POS_BEGIN);
    $this->registerJs("var profileImageUploaderUrl='" . Url::to(['/user/image/upload', 'userGuid' => $user->guid, 'type' => ImageController::TYPE_PROFILE_IMAGE]) . "';", \yii\web\View::POS_BEGIN);
    $this->registerJs("var profileHeaderUploaderUrl='" . Url::to(['/user/image/upload', 'userGuid' => $user->guid, 'type' => ImageController::TYPE_PROFILE_BANNER_IMAGE]) . "';", \yii\web\View::POS_BEGIN);
}
?>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
    crossorigin="anonymous" />
<link rel="stylesheet" href="themes/Coinsence/css/userInfo.css" />
<link rel="stylesheet" type="text/css" href="themes/Coinsence/slick/slick.css" />
<link rel="stylesheet" type="text/css" href="themes/Coinsence/slick/slick-theme.css" />
<div class="panel panel-default panel-profile">

    <div class="userInfo">

        <div class="image-upload-container" style="width: 100%; height: 100%; overflow:hidden;">
            <!-- profile image output  $user->getProfileBannerImage()->getUrl(); ?>-->
            <img class=" cover" id="user-banner-image"
                alt="<?= Yii::t('base', 'Profile image of {displayName}', ['displayName' => Html::encode($user->displayName)]); ?>"
                src="<?= $user->getProfileBannerImage()->getUrl(); ?>" width="100%"
                style="width: 100%; max-height: 226px;">

            <!-- "/themes/Coinsence/img/cover.jpg" -->
            <!-- check if the current user is the profile owner and can change the images -->
            <?php if ($allowModifyProfileBanner) : ?>
            <form class="fileupload" id="bannerfileupload" action="" method="POST" enctype="multipart/form-data"
                style="position: absolute; top: 0; left: 0; opacity: 0; width: 100%; height: 100%;">
                <input type="file" name="images[]" aria-hidden="true">
                <div>
                    <i class="fas fa-camera"></i>
                    <h2>Add a cover image</h2>
                    <p>Optimal dimensions: 1220 x 226 </p>
                </div>
            </form>

            <?php
                // set standard padding for banner progressbar
                $padding = '90px 350px';

                // if the default banner image is displaying
                if (!$user->getProfileBannerImage()->hasImage()) {
                    // change padding to the lower image height
                    $padding = '50px 350px';
                }
                ?>

            <div class="image-upload-loader" id="banner-image-upload-loader" style="padding: <?php echo $padding ?>;">
                <div class="progress image-upload-progess-bar" id="banner-image-upload-bar">
                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="00" aria-valuemin="0"
                        aria-valuemax="100" style="width: 0%;">
                    </div>
                </div>
            </div>

            <?php endif; ?>


            <!-- check if the current user is the profile owner and can change the images -->
            <?php if ($allowModifyProfileBanner): ?>
            <div class="image-upload-buttons" id="banner-image-upload-buttons">
                <a href="#" onclick="javascript:$('#bannerfileupload input').click();" class="btn btn-info btn-sm"
                    aria-label="<?= Yii::t('UserModule.base', 'Upload profile banner'); ?>">
                    <i class="fas fa-cloud-upload-alt"></i>
                </a>
                <a id="banner-image-upload-edit-button"
                    style="<?= (!$user->getProfileBannerImage()->hasImage()) ? 'display: none;' : '' ?>"
                    href="<?= Url::to(['/user/image/crop', 'userGuid' => $user->guid, 'type' => ImageController::TYPE_PROFILE_BANNER_IMAGE]); ?>"
                    class="btn btn-info btn-sm" data-target="#globalModal" data-backdrop="static"
                    aria-label="<?= Yii::t('UserModule.base', 'Crop profile background'); ?>">
                    <i class="fa fa-edit"></i>
                </a>
                <?php
                    echo \humhub\widgets\ModalConfirm::widget([
                        'uniqueID' => 'modal_bannerimagedelete',
                        'linkOutput' => 'a',
                        'ariaLabel' => Yii::t('UserModule.widgets_views_deleteBanner', 'Delete profile banner'),
                        'title' => Yii::t('UserModule.widgets_views_deleteBanner', '<strong>Confirm</strong> image deleting'),
                        'message' => Yii::t('UserModule.widgets_views_deleteBanner', 'Do you really want to delete your title image?'),
                        'buttonTrue' => Yii::t('UserModule.widgets_views_deleteBanner', 'Delete'),
                        'buttonFalse' => Yii::t('UserModule.widgets_views_deleteBanner', 'Cancel'),
                        'linkContent' => '<i class="fa fa-times"></i>',
                        'cssClass' => 'btn btn-danger btn-sm',
                        'style' => $user->getProfileBannerImage()->hasImage() ? '' : 'display: none;',
                        'linkHref' => Url::to(['/user/image/delete', 'userGuid' => $user->guid, 'type' => ImageController::TYPE_PROFILE_BANNER_IMAGE]),
                        'confirmJS' => 'function(jsonResp) { resetProfileImage(jsonResp); }'
                    ]);
                    ?>
            </div>
            <?php endif; ?>
        </div>
        <div>
            <div class="topInfo row">
                <div class="badges col-md-4">
                    <?php foreach ($user->getTags() as $tag): ?>
                    <span> <?php echo Html::a(Html::encode($tag)); ?></span>
                    <?php endforeach; ?>

                </div>
                <div class="profilePicture col-md-4">

                    <?php if ($user->profileImage->hasImage()) : ?>
                    <a data-ui-gallery="profileHeader" href="<?= $user->profileImage->getUrl('_org'); ?>">
                        <img class="img-rounded profile-user-photo" id="user-profile-image"
                            src="<?php echo $user->getProfileImage()->getUrl(); ?>" data-src="holder.js/216x216"
                            alt="216x216" />
                    </a>
                    <?php else : ?>
                    <img class="img-rounded profile-user-photo" id="user-profile-image"
                        src="<?php echo $user->getProfileImage()->getUrl(); ?>" data-src="holder.js/216x216"
                        alt="216x216" />
                    <?php endif; ?>

                    <!-- check if the current user is the profile owner and can change the images -->
                    <?php if ($allowModifyProfileImage) : ?>
                    <form class="fileupload" id="profilefileupload" action="" method="POST"
                        enctype="multipart/form-data" style="position: absolute; top: 0; left: 0; opacity: 0;">
                        <input type="file" aria-hidden="true" name="images[]">
                    </form>

                    <div class="image-upload-loader" id="profile-image-upload-loader">
                        <div class="progress image-upload-progess-bar" id="profile-image-upload-bar">
                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="00"
                                aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                            </div>
                        </div>
                    </div>

                    <div class="image-upload-buttons" id="profile-image-upload-buttons">
                        <a href="#" onclick="javascript:$('#profilefileupload input').click();"
                            class="btn btn-info btn-sm"
                            aria-label="<?= Yii::t('UserModule.base', 'Upload profile image'); ?>">
                            <i class="fas fa-cloud-upload-alt"></i>

                        </a>
                        <a id="profile-image-upload-edit-button" style="<?php
                        if (!$user->getProfileImage()->hasImage()) {
                            echo 'display: none;';
                        }
                        ?>" href="<?php echo Url::to(['/user/image/crop', 'userGuid' => $user->guid, 'type' => ImageController::TYPE_PROFILE_IMAGE]); ?>"
                            class="btn btn-info btn-sm" data-target="#globalModal" data-backdrop="static"
                            aria-label="<?= Yii::t('UserModule.base', 'Crop profile image'); ?>">
                            <i class="fa fa-edit"></i></a>
                        <?php
                        echo \humhub\widgets\ModalConfirm::widget([
                            'uniqueID' => 'modal_profileimagedelete',
                            'linkOutput' => 'a',
                            'ariaLabel' => Yii::t('UserModule.base', 'Delete profile image'),
                            'title' => Yii::t('UserModule.widgets_views_deleteImage', '<strong>Confirm</strong> image deleting'),
                            'message' => Yii::t('UserModule.widgets_views_deleteImage', 'Do you really want to delete your profile image?'),
                            'buttonTrue' => Yii::t('UserModule.widgets_views_deleteImage', 'Delete'),
                            'buttonFalse' => Yii::t('UserModule.widgets_views_deleteImage', 'Cancel'),
                            'linkContent' => '<i class="fa fa-times"></i>',
                            'cssClass' => 'btn btn-danger btn-sm',
                            'style' => $user->getProfileImage()->hasImage() ? '' : 'display: none;',
                            'linkHref' => Url::to(["/user/image/delete", 'type' => ImageController::TYPE_PROFILE_IMAGE, 'userGuid' => $user->guid]),
                            'confirmJS' => 'function(jsonResp) { resetProfileImage(jsonResp); }'
                        ]);
                        ?>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="socialLinks col-md-4">
                    <?php if(($user->profile->url_facebook)==''):?>
                    <h1></h1>
                    <?php else: ?>
                    <a href="<?php echo $user->profile->url_facebook ?>">
                        <i class="fab fa-facebook-square"></i>
                    </a>
                    <?php endif;?>
                    <?php if(($user->profile->url_googleplus)==''):?>
                    <h1></h1>
                    <?php else: ?>
                    <a href="<?php echo $user->profile->url_googleplus?>">
                        <i class="fab fa-google-plus-square"></i>
                    </a>
                    <?php endif;?>
                    <?php if(($user->profile->url_twitter)==''):?>
                    <h1></h1>
                    <?php else: ?>
                    <a href="<?php echo $user->profile->url_twitter?>">
                        <i class="fab fa-twitter-square"></i>
                    </a>
                    <?php endif;?>
                    <?php if(($user->profile->url_linkedin)==''):?>
                    <h1></h1>
                    <?php else: ?>
                    <a href="<?php echo $user->profile->url_linkedin?>">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <?php endif;?>
                </div>
                <div class="contact mobileView">

                    <?=
    humhub\modules\user\widgets\ProfileHeaderControls::widget([
        'user' => $user,
        'widgets' => [
            [\humhub\modules\user\widgets\UserFollowButton::class, ['user' => $user], []],
            [\humhub\modules\friendship\widgets\FriendshipButton::class, ['user' => $user], []],
            [\humhub\modules\user\widgets\ProfileEditButton::class, ['user' => $user], []],
        ]
    ]);
   
    ?>

                </div>
            </div>
        </div>
        <div class="detailInfo">
            <h2 class="name"><?= Html::encode($user->displayName); ?></h2>
            <h4 class="title"><?= Html::encode($user->profile->title); ?></h4>
            <p class="address"><?= Html::encode($user->profile->city); ?>, <?= Html::encode($user->profile->country); ?>
            </p>
        </div>
        <div class="badges col-md-4 mobileView">
            <?php foreach ($user->getTags() as $tag): ?>
            <span> <?php echo Html::a(Html::encode($tag)); ?></span>
            <?php endforeach; ?>

        </div>
        <div class="bio">
            <p>
                <?= Html::encode($user->profile->about); ?>
            </p>
        </div>
        <div class="socialLinks col-md-4 mobileView">
            <?php if(($user->profile->url_facebook)==''):?>
            <h1></h1>
            <?php else: ?>
            <a href="<?php echo $user->profile->url_facebook ?>">
                <i class="fab fa-facebook-square"></i>
            </a>
            <?php endif;?>
            <?php if(($user->profile->url_googleplus)==''):?>
            <h1></h1>
            <?php else: ?>
            <a href="<?php echo $user->profile->url_googleplus?>">
                <i class="fab fa-google-plus-square"></i>
            </a>
            <?php endif;?>
            <?php if(($user->profile->url_twitter)==''):?>
            <h1></h1>
            <?php else: ?>
            <a href="<?php echo $user->profile->url_twitter?>">
                <i class="fab fa-twitter-square"></i>
            </a>
            <?php endif;?>
            <?php if(($user->profile->url_linkedin)==''):?>
            <h1></h1>
            <?php else: ?>
            <a href="<?php echo $user->profile->url_linkedin?>">
                <i class="fab fa-linkedin"></i>
            </a>
            <?php endif;?>
        </div>
        <div class="social">
            <div class="contact" style="order: 2;">

                <?=
    humhub\modules\user\widgets\ProfileHeaderControls::widget([
        'user' => $user,
        'widgets' => [
            [\humhub\modules\user\widgets\UserFollowButton::class, ['user' => $user], []],
            [\humhub\modules\friendship\widgets\FriendshipButton::class, ['user' => $user], []],
            [\humhub\modules\user\widgets\ProfileEditButton::class, ['user' => $user], []],
        ]
    ]);
   
    ?>

            </div>
            <?= ProfileHeaderCounterSet::widget(['user' => $user],[]); ?>
        </div>
    </div>


</div>


<!-- start: Error modal -->
<div class="modal" id="uploadErrorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-extra-small animated pulse">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">
                    <?php echo Yii::t('UserModule.widgets_views_profileHeader', '<strong>Something</strong> went wrong'); ?>
                </h4>
            </div>
            <div class="modal-body text-center">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"
                    data-dismiss="modal"><?php echo Yii::t('UserModule.widgets_views_profileHeader', 'Ok'); ?></button>
            </div>
        </div>
    </div>
</div>
