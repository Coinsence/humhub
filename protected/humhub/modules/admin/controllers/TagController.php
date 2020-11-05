<?php
/**
 * @link https://coinsence.org/
 * @copyright Copyright (c) 2020 Coinsence
 * @license https://www.humhub.com/licences
 *
 * @author Daly Ghaith <daly.ghaith@gmail.com>
 */

namespace humhub\modules\admin\controllers;

use humhub\modules\admin\permissions\ManageTags;
use humhub\modules\xcoin\models\Tag;
use Throwable;
use Yii;
use humhub\modules\admin\components\Controller;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\web\ForbiddenHttpException;
use yii\web\HttpException;
use yii\web\Response;

/**
 * TagController provides management for users/spaces tags.
 */
class TagController extends Controller
{

    /**
     * @inheritdoc
     */
    public $adminOnly = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->subLayout = '@admin/views/layouts/tag';
        $this->appendPageTitle(Yii::t('AdminModule.base', 'Tags'));

        return parent::init();
    }

    /**
     * @inheritdoc
     */
    public function getAccessRules()
    {
        return [
            ['permissions' => [ManageTags::class]]
        ];
    }

    /**
     * Shows all available tags for users
     * @throws ForbiddenHttpException
     */
    public function actionIndexUser()
    {
        if (!Yii::$app->user->can(new ManageTags())) {
            return $this->forbidden();
        }


        $dataProvider = new ActiveDataProvider([
            'query' => Tag::find()->where(['type' => Tag::TYPE_USER])
        ]);

        return $this->render('tags-user', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Shows all available tags for spaces
     * @throws ForbiddenHttpException
     */
    public function actionIndexSpace()
    {
        if (!Yii::$app->user->can(new ManageTags())) {
            return $this->forbidden();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Tag::find()->where(['type' => Tag::TYPE_SPACE])
        ]);

        return $this->render('tags-space', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Create new tag
     * @throws ForbiddenHttpException
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->can(new ManageTags())) {
            return $this->forbidden();
        }

        $model = new Tag();
        $model->scenario = Tag::SCENARIO_CREATE;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->fileManager->attach(Yii::$app->request->post('fileList'));
            $this->view->saved();

            return $this->htmlRedirect(['index-' . ($model->type == Tag::TYPE_USER ? 'user' : 'space')]);
        }

        return $this->renderAjax('create', ['model' => $model]);
    }

    /**
     * Delete tag
     * @param $id
     * @return Response
     * @throws HttpException
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionDelete($id)
    {
        $tag = Tag::findOne(['id' => $id]);
        if ($tag === null) {
            throw new HttpException(404);
        }

        $tag->delete();
        $this->view->success(Yii::t('AdminModule.tag', 'Tag successfully deleted'));

        return $this->redirect(['index-' . ($tag->type == Tag::TYPE_USER ? 'user' : 'space')]);
    }
}
