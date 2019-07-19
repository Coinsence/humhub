<?php
/* @var $this \yii\web\View */
/* @var $content string */

\humhub\assets\AppAsset::register($this);

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url; ?>
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

                <div class="topbar-menu visible-xs-inline-block visible-sm-inline-block pull-left">
                    <?= \humhub\widgets\TopMenu::widget(); ?>
                </div>

                <div class="topbar-brand">
                    <?= \humhub\widgets\SiteLogo::widget(); ?>
                </div>

                <div class="topbar-coins hidden-xs"></div>

                <div class="topbar-actions pull-right hidden-xs">
                    <?= \humhub\modules\user\widgets\AccountTopMenu::widget(); ?>
                </div>

                <div class="notifications pull-right hidden-xs">
                    <?= \humhub\widgets\NotificationArea::widget(); ?>
                </div>

                <div class="spaces pull-right hidden-xs">
                    <!-- load space chooser widget -->
                    <?= \humhub\modules\space\widgets\Chooser::widget(); ?>
                </div>

                <div class="search-xs visible-xs pull-right">
                    <?= \humhub\modules\search\widgets\SearchMenu::widget(); ?>
                </div>

                <div class="search hidden-xs">
                    <?php $form = ActiveForm::begin(['action' => Url::to(['/search']), 'method' => 'GET']); ?>
                    <div class="form-group form-group-search">
                        <?= Html::textInput('SearchForm[keyword]', null, ['placeholder' => Yii::t('SearchModule.views_search_index', 'Search for user, spaces and content'),
                            'title' => Yii::t('SearchModule.views_search_index', 'Search for user, spaces and content'), 'class' => 'form-control', 'id' => 'search-input-field']) ?>
                        <?php echo Html::submitButton('<i class="fa fa-search"></i>', ['class' => 'btn btn-default btn-sm form-button-search', 'data-ui-loader' => '']); ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>


            </div>
        </div>
        <!-- end: first top navigation bar -->

        <!-- start: second top navigation bar -->
        <div id="topbar-second" class="topbar visible-md visible-lg">
            <div class="container">
                <ul class="nav" id="top-menu-nav">
                    <!-- load navigation from widget -->
                    <?= \humhub\widgets\TopMenu::widget(); ?>
                </ul>
            </div>
        </div>
        <!-- end: second top navigation bar -->

        <?= $content; ?>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
