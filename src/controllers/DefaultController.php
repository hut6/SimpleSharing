<?php
/**
 * SimpleSharing plugin for Craft CMS 3.x
 *
 * Simple Sharing generates social media share links within CP entry pages, allowing you to quickly & easily share entries.
 *
 * @link      https://hutsix.com.au
 * @copyright Copyright (c) 2017 reganlawton
 */

namespace hut6\simplesharing\controllers;

use craft\elements\Entry;
use hut6\simplesharing\SimpleSharing;

use Craft;
use craft\web\Controller;

/**
 * @author    reganlawton
 * @package   SimpleSharing
 * @since     2.0.0
 */
class DefaultController extends Controller
{

    // Protected Properties
    // =========================================================================

    protected $allowAnonymous = true;

    // Public Methods
    // =========================================================================

    public function actionUrl()
    {
        $data            = Craft::$app->request->getQueryParams();
        $allowedSections = SimpleSharing::getInstance()->getSettings()->allowedSections;

        if (!$allowedSections or (is_array($allowedSections) and in_array($data['sectionId'], $allowedSections))) {
            /** @var Entry|null $entry */
            $entry = Craft::$app->getEntries()->getEntryById($data['id']);

            if (null !== $entry) {
                echo $entry->url;
            }
        }

        Craft::$app->end();
    }
}
