<?php

use yii\captcha\Captcha;
use \yii\helpers\Url;
use yii\widgets\ActiveForm;
use \humhub\compat\CHtml;
use humhub\modules\user\widgets\AuthChoice;

$this->pageTitle = Yii::t('UserModule.views_auth_register', 'Register');
?>


<a class="brand" href="/dashboard"><img src="http://coinsence.localhost/uploads/logo_image/logo.png?cacheId=0"></a>

<div class="content">

    <div class="bg"></div>

    <div class="register-content" id="register-form">

        <h1><?= Yii::t('UserModule.views_auth_register', 'Welcome to coinsence!'); ?></h1>
        <h5><?= Yii::t('UserModule.views_auth_register', 'Join us and experience a new way to collaborate on initiatives that benefits society'); ?></h5>

        <?php $form = ActiveForm::begin(['id' => 'invite-form', 'options' => [ 'class' => 'col-md-10' ]]); ?>
        <?= $form->field($invite, 'email')->input('email', ['id' => 'register-email', 'placeholder' => $invite->getAttributeLabel('email'), 'aria-label' => $invite->getAttributeLabel('email')])->label(false); ?>
        <?php if ($invite->showCaptureInRegisterForm()) : ?>
            <div id="registration-form-captcha" style="display: none;">
                <div><?= Yii::t('UserModule.views_auth_register', 'Please enter the letters from the image.'); ?></div>

                <?= $form->field($invite, 'captcha')->widget(Captcha::class, [
                    'captchaAction' => 'auth/captcha',
                ])->label(false);?>
            </div>
        <?php endif; ?>

        <div class="links row">
            <div class="col-md-12">
                <?= CHtml::submitButton(Yii::t('UserModule.views_auth_register', 'Register'), ['class' => 'btn btn-primary', 'data-ui-loader' => '']); ?>
            </div>
            <div class="col-md-12">
                <small>
                    <?= Yii::t('UserModule.views_auth_register', 'Already have an account?') ?> <a href="<?= Url::toRoute('/user/auth/login'); ?>" data-pjax-prevent><?= Yii::t('UserModule.views_auth_register', 'Login') ?></a>
                </small>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
