<?php
/* @var $this \yii\web\View */
/* @var $content string */

\humhub\assets\AppAsset::register($this);

use humhub\modules\content\components\ContentContainerController;
use humhub\modules\space\models\Space; ?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <title><?= strip_tags($this->pageTitle); ?></title>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <?php $this->head() ?>
        <?= $this->render('head'); ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <!-- start: first top navigation bar -->
        <div id="topbar-first" class="topbar">
            <div class="container">

                <div class="space-menu">
                    <li class="dropdown">
                        <a href="#" id="top-dropdown-menu" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-align-justify"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <?php if (Yii::$app->controller instanceof ContentContainerController && Yii::$app->controller->contentContainer instanceof Space) : ?>
                                <?= \humhub\modules\space\widgets\Menu::widget() ?>
                            <?php endif; ?>
                        </ul>
                    </li>
                </div>

                <div class="spaces">
                    <!-- load space chooser widget -->
                    <?= \humhub\modules\space\widgets\Chooser::widget(); ?>
                </div>

                <div class="topbar-coins pull-right">
                    <?= \humhub\modules\xcoin\widgets\AssetAmount::widget() ?>
                </div>

                <div class="topbar-actions pull-right">
                    <?= \humhub\modules\user\widgets\AccountTopMenu::widget(); ?>
                </div>

                <div class="notifications pull-right hidden-xs">
                    <?= \humhub\widgets\NotificationArea::widget(); ?>
                </div>

                <div class="search pull-right hidden-xs">
                    <?= \yii\helpers\Html::a('<i class="fa fa-search"></i>', ['/search']) ?>
                </div>

                <div class="nav-menu pull-right">
                    <li class="dropdown">
                        <a href="#" id="top-dropdown-menu" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-ellipsis-h"></i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <?= \humhub\widgets\TopMenu::widget(); ?>
                        </ul>
                    </li>
                </div>
                

            </div>
        </div>
        <!-- end: first top navigation bar -->

        <div id="bottombar" class="bottombar visible-xs">
            <div class="container links">
                <?= \yii\helpers\Html::a(
                    '<i class="fa fa-home"></i>',
                    ['/dashboard/dashboard'],
                    Yii::$app->requestedRoute == "dashboard/dashboard" ? [ 'class' => ['active', 'home'] ] : ['class' => 'home']); ?>
                <?= \yii\helpers\Html::a(
                    '<i class="fa fa-bell"></i>',
                    ['/notification/overview'],
                    Yii::$app->requestedRoute == "notification/overview" ? [ 'class' => ['active', 'notifications'] ] : ['class' => 'notifications']); ?>
                <?= \yii\helpers\Html::a(
                    '<i class="fa fa-envelope"></i>',
                    ['/mail/mail/index'],
                    Yii::$app->requestedRoute == "mail/mail/index" ? ['class' => ['active', 'messages'] ] : ['class' => 'messages']); ?>

                <?= \yii\helpers\Html::a(
                    '<i class="fa fa-dot-circle-o"></i>',
                    ['/directory/spaces'],
                    Yii::$app->requestedRoute == "directory/spaces" ? [ 'class' => ['active', 'spaces'] ] : ['class' => 'spaces']); ?>


                <?= \yii\helpers\Html::a(
                    '<i class="fa fa-search"></i>',
                    ['/search/search/index'],
                    Yii::$app->requestedRoute == "search/search/index" ? [ 'class' => ['active', 'search'] ] : ['class' => 'search']); ?>
            </div>

        </div>

        <script>
            $('body').off('click', '#bottombar .links a');
            $('body').on('click', '#bottombar .links a' ,function () {
                $('#bottombar .links a').removeClass('active');
                setTimeout(function () {
                    switch (window.location.pathname) {
                        case '/dashboard':
                            $('#bottombar .links .home').removeClass('active').addClass('active');
                            break;
                        case '/notification/overview':
                            $('#bottombar .links .notifications').removeClass('active').addClass('active');
                            break;
                        case '/mail/mail/index':
                            $('#bottombar .links .messages').removeClass('active').addClass('active');
                            break;
                        case '/directory/spaces':
                            $('#bottombar .links .spaces').removeClass('active').addClass('active');
                            break;
                        case '/search':
                            $('#bottombar .links .search').removeClass('active').addClass('active');
                            break;
                        default:
                            break;
                    }
                })
            });
            if (humhub.modules.event) {
                const event = humhub.modules.event;
                event.on('humhub:modules:space:afterInit', function(evt, space) {
                    
                    if (space.isSpacePage()) {
                        $('#topbar-first .space-menu').show();
                    }
                    space.init = function() {
                        if(!space.isSpacePage()) {
                            space.options = undefined;
                            $('#topbar-first .space-menu').hide();
                        } else {
                            const nav = $('.space-content .layout-nav-container').html();
                            $('#topbar-first .space-menu .dropdown-menu').html(nav);
                            $('#topbar-first .space-menu').show();
                            $('#topbar-first .space-menu .list-group-item').removeClass('active');
                            if (
                                window.location.pathname.includes('/space/space/home') ||
                                window.location.pathname.includes('/xcoin/')
                            ) {
                                $('#topbar-first .space-menu .list-group-item[href="' + window.location.pathname + '"]').removeClass('active').addClass('active');
                            } else {
                                $('#topbar-first .space-menu .list-group-item[href*="/space/space/home"]').removeClass('active').addClass('active');
                            }
                        }
                    };
                });
            }

        </script>

        <?= $content; ?>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
