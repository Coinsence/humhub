<?php

use humhub\modules\space\widgets\Header;
use humhub\modules\space\widgets\Menu;
use humhub\modules\space\widgets\SpaceContent;
use humhub\widgets\FooterMenu;

/**
 * @var \humhub\modules\ui\view\components\View $this
 * @var \humhub\modules\space\models\Space $space
 * @var string $content
 * @var \humhub\modules\content\components\ContentContainerController $context
 */

$context = $this->context;
$space = $context->contentContainer;

?>
<div class="container space-layout-container">
    <?php if (
        !$space->isModuleEnabled('xcoin') ||
        $context->module->id === 'space' ||
        $context->module->id === 'manage' ||
        (
            $context->module->id === 'xcoin' &&
            $context->id === 'config'
        ) ||
        !Yii::$app->getModule('xcoin')->settings->space()->get('partiallyHideCover', true)
    ): ?>
        <div class="row">
            <div class="col-md-12">
                <?= Header::widget(['space' => $space]); ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="row space-content">
        <div class="col-md-2 layout-nav-container hidden">
            <?= Menu::widget(['space' => $space]); ?>
            <br>
        </div>
        <div class="col-md-<?= ($this->hasSidebar()) ? '9' : '12' ?> layout-content-container">
            <?= SpaceContent::widget(['contentContainer' => $space, 'content' => $content]) ?>
        </div>
        <?php if ($this->hasSidebar()): ?>
            <div class="col-md-3 layout-sidebar-container">
                <?= $this->getSidebar() ?>
                <?= FooterMenu::widget(['location' => FooterMenu::LOCATION_SIDEBAR]); ?>
            </div>
        <?php endif; ?>
    </div>

    <?php if (!$this->hasSidebar()): ?>
        <?= FooterMenu::widget(['location' => FooterMenu::LOCATION_FULL_PAGE]); ?>
    <?php endif; ?>
</div>
