<?php
$this->pageTitle = Yii::t('UserModule.views_auth_register_success', 'Registration successful');

use humhub\compat\CHtml;
use yii\captcha\Captcha;
use yii\helpers\Url;
use yii\widgets\ActiveForm; ?>

<a class="brand" href="/dashboard"><img src="http://coinsence.localhost/uploads/logo_image/logo.png?cacheId=0"></a>

<div class="content">

    <div class="bg"></div>

    <div class="register-content" id="register-form">

        <h1><?= Yii::t('UserModule.views_auth_register_success', 'Check your email!'); ?></h1>
        <h5><?= Yii::t('UserModule.views_auth_register_success', 'We just emailed you a verification link. Be sure to click on it soon to get started.'); ?></h5>

        <div class="links row">
            <div class="col-md-12">
                <a href="<?php echo \yii\helpers\Url::to(["/"]) ?>" data-pjax-prevent data-ui-loader class="btn btn-primary"><?php echo Yii::t('UserModule.views_auth_register_success', 'back to home') ?></a>
            </div>
        </div>

    </div>

</div>



