<?php

use humhub\assets\Select2BootstrapAsset;
use humhub\modules\space\widgets\Image as SpaceImage;

$user = $this->context->contentContainer;

// test begin
use humhub\modules\user\widgets\ProfileHeader;
use humhub\modules\xcoin\widgets\ProjectPortfolio;
use humhub\modules\xcoin\widgets\MarketPlacePortfolio;
use humhub\modules\user\widgets\ProfileMenu;
use humhub\modules\xcoin\assets\Assets;
use humhub\modules\xcoin\models\Challenge;
use humhub\widgets\FooterMenu;
use yii\bootstrap\Progress;
use \humhub\modules\xcoin\models\Funding;
use \yii\helpers\Html;
use \yii\helpers\Url;
use humhub\modules\xcoin\models\Product;
use humhub\modules\activity\widgets\ActivityStreamViewer;
use humhub\modules\xcoin\widgets\MyRecentActivities;
use humhub\modules\post\widgets\Form;
use humhub\modules\stream\widgets\StreamViewer;
Assets::register($this);
use humhub\modules\xcoin\widgets\UserExperience;

Select2BootstrapAsset::register($this);
/** @var $selectedChallenge Challenge | null */
/** @var $fundings Funding[] */
/** @var $assetsList array */
/** @var $challengesList array */
/** @var $countriesList array */
/** @var $challengesCarousel array */
use humhub\modules\user\widgets\ProfileHeaderCounterSet;
use humhub\libs\Iso3166Codes;
use humhub\modules\user\widgets\Image;

Assets::register($this);
Select2BootstrapAsset::register($this);

/** @var $selectedMarketplace Marketplace | null */
/** @var $products Product[] */
/** @var $assetsList array */
/** @var $marketplacesList array */
/** @var $countriesList array */
/** @var $marketplacesCarousel array */
/** @var $model ProductFilter */

?>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
    crossorigin="anonymous" />
<!-- <link rel="stylesheet" href="/var/www/test/humhub/themes/Coinsence/css/userInfo.css" /> -->
<link rel="stylesheet" type="text/css" href="themes/Coinsence/slick/slick.css" />
<link rel="stylesheet" type="text/css" href="themes/Coinsence/slick/slick-theme.css" />
<script src="themes/Coinsence/js/jquery-3.5.1.min.js"></script>

<div class="container profile-layout-container userProfileContainer">
    <div class="row">
        <div class="col-md-12">
            <?=ProfileHeader::widget([
                'user' => $user
                ]);?>
        </div>
    </div>
    <div class="row">



        <div class="col-lg-9 profileLeftContainer">
        <?php if($user->profile->skill) :?>
            <div class="whatIOffer">
                <?php if (!Yii::$app->user->isGuest) {
                    echo Html::a(
                        '<i class="fas fa-pencil-alt editPencil"></i>',
                        [
                            '/xcoin/offer/edit','container' => $user
                            
                        ],
                        [
                            'data-target' => '#globalModal',
                            'class' => 'edit-btn'
                          
                        ]
                    );
                }?>
                <h2>What I offer to the community</h2>
                <p>
                    <?= Html::encode($user->profile->skill); ?>
                </p>
            </div>
            <?php endif; ?>
            <?php if($user->profile->community) :?>
            <div class="whatINeed">
                <?php if (!Yii::$app->user->isGuest) {
                    echo '<i class="fas fa-pencil-alt editPencil"></i>';
                }?>
                <h2>What I need from the community</h2>
                <p>
                    <?= Html::encode($user->profile->community); ?>

                </p>
            </div>
            <?php endif; ?>
        <?= UserExperience::widget(['user' => $user, 'htmlOptions' => ['style' => 'margin-bottom:100px,position: relative']]) ?>
            <?=ProjectPortfolio::widget(['user' => $user]);?>
            <?=MarketPlacePortfolio::widget(['user' => $user]);?>
            <div class="userCoins tabletView">
                <div class="coinsHeader">
                    <h2><span>Coins</span><i class="far fa-question-circle"></i></h2>
                    <a href="" class="accountDetail">Account Details</a>
                </div>
                <div class="coinsBody">

                    <div class="coin">
                        <img src="/themes/Coinsence/img/coinsenceToken.jpg" class="coinImage" alt="" />
                        <span class="amountCoin">500</span>
                    </div>
                    <div class="coin">
                        <img src="/themes/Coinsence/img/coinsenceToken.jpg" class="coinImage" alt="" />
                        <span class="amountCoin">500</span>
                    </div>
                    <div class="coin">
                        <img src="/themes/Coinsence/img/coinsenceToken.jpg" class="coinImage" alt="" />
                        <span class="amountCoin">500</span>
                    </div>
                    <div class="coin">
                        <img src="/themes/Coinsence/img/coinsenceToken.jpg" class="coinImage" alt="" />
                        <span class="amountCoin">500</span>
                    </div>
                </div>
            </div>
            <?php
                if (!Yii::$app->user->isGuest) {
                    echo Form::widget(['contentContainer' => Yii::$app->user->getIdentity()]);
                }
                echo '<div class="recentPosts">
                <h2>Recent posts</h2>';
                echo StreamViewer::widget([
                    'streamAction' => '//directory/directory/stream',
                    'messageStreamEmpty' => (!Yii::$app->user->isGuest) ?
                            Yii::t('DirectoryModule.base', '<b>Nobody wrote something yet.</b><br>Make the beginning and post something...') :
                            Yii::t('DirectoryModule.base', '<b>There are no profile posts yet!</b>'),
                    'messageStreamEmptyCss' => (!Yii::$app->user->isGuest) ?
                            'placeholder-empty-stream' :
                            '',
                ]);
                echo '</div>';
            ?>
            <?= MyRecentActivities::widget([
               'widgets' => [
                [
                    ActivityStreamViewer::class,
                    ['streamAction' => '/dashboard/dashboard/activity-stream'],
                    ['sortOrder' => 150]
                ]
            ]
            ]);
            ?>
            <?/*php 
echo \humhub\widgets\LoaderWidget::widget();
*/?>

           
           
            

        </div>
        <?php if ($this->hasSidebar()): ?>
        <div class="col-lg-3 layout-sidebar-container">
            <?=$this->getSidebar()?>
            <?=FooterMenu::widget(['location' => FooterMenu::LOCATION_SIDEBAR]);?>
        </div>
        <?php endif;?>
    </div>

    <!-- <div class="row profile-content">
        <div class="col-md-2 layout-nav-container">
            <?/*= ProfileMenu::widget(['user' => $user]); */?>
        </div>
        <div class="col-md-<?/*=($this->hasSidebar()) ? '7' : '10'*/?> layout-content-container">
            <?/*=$content;*/?>
            <?/*php if (!$this->hasSidebar()): */?>
            <?/*= FooterMenu::widget(['location' => FooterMenu::LOCATION_FULL_PAGE]); */?>
            <?/*php endif;*/?>
        </div>
    </div> -->
</div>