<?php

use yii\helpers\Html;
use yii\helpers\Url;

print Html::a('<img src="themes/Coinsence/img/connect.svg" alt="">'.Yii::t("UserModule.widgets_views_profileEditButton", "Edit account"), Url::toRoute('/user/account/edit'), ['class' => 'btn btn-default editProfile']);
