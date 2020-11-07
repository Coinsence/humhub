<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\space\components;

use yii\web\UrlRuleInterface;
use yii\base\BaseObject;
use humhub\modules\space\models\Space;

/**
 * Space URL Rule
 *
 * @author luke
 */
class UrlRule extends BaseObject implements UrlRuleInterface
{

    /**
     * @var string default route to space home
     */
    public $defaultRoute = 'space/space';

    /**
     * @var array map with space guid/url pairs
     */
    public static $spaceUrlMap = [];

    /**
     * @inheritdoc
     */
    public function createUrl($manager, $route, $params)
    {
        if (isset($params['cguid'])) {
            if ($route == $this->defaultRoute) {
                $route = '';
            }

            $urlPart = static::getUrlBySpaceGuid($params['cguid']);
            if ($urlPart !== null) {
                $url = urlencode($urlPart) . "/" . $route;
                unset($params['cguid']);

                if (!empty($params) && ($query = http_build_query($params)) !== '') {
                    $url .= '?' . $query;
                }
                return $url;
            }
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();
            $parts = explode('/', $pathInfo, 2);
            if (isset($parts[0])) {
                $space = Space::find()->where(['guid' => $parts[0]])->orWhere(['url' => $parts[0]])->one();
                if ($space !== null) {
                    if (!isset($parts[1]) || $parts[1] == "") {
                        $parts[1] = $this->defaultRoute;
                    }

                    $params = $request->get();
                    $params['cguid'] = $space->guid;

                    return [$parts[1], $params];
                }
            }

        return false;
    }

    /**
     * Gets space url name by given guid
     *
     * @param string $guid
     * @return string|null the space url part
     */
    public static function getUrlBySpaceGuid($guid)
    {
        if (isset(static::$spaceUrlMap[$guid])) {
            return static::$spaceUrlMap[$guid];
        }

        $space = Space::findOne(['guid' => $guid]);
        if ($space !== null) {
            static::$spaceUrlMap[$space->guid] = ($space->url != '') ? $space->url : $space->guid;
        } else {
            static::$spaceUrlMap[$guid] = null;
        }

        return static::$spaceUrlMap[$guid];
    }

}
