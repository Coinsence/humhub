<?php
/**
 * @link https://coinsence.org/
 * @copyright Copyright (c) 2020 Coinsence
 * @license https://www.humhub.com/licences
 *
 * @author Daly Ghaith <daly.ghaith@gmail.com>
 */

namespace humhub\modules\admin\permissions;

use humhub\modules\admin\components\BaseAdminPermission;
use Yii;

/**
 * ManageMarketplaces permission allows access to marketplaces section within the admin area.
 */
class ManageMarketplaces extends BaseAdminPermission
{
    /**
     * @inheritdoc
     */
    protected $id = 'admin_manage_marketplaces';

    public function __construct($config = [])
    {
        parent::__construct($config);

        $this->title = Yii::t('AdminModule.permissions', 'Manage Marketplaces');
        $this->description = Yii::t('AdminModule.permissions', 'Can manage marketplaces within the \'Administration -> marketplaces\' section (edit).');
    }

}
