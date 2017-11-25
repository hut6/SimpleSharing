<?php
/**
 * SimpleSharing plugin for Craft CMS 3.x
 *
 * Simple Sharing generates social media share links within CP entry pages, allowing you to quickly & easily share entries.
 *
 * @link      https://hutsix.com.au
 * @copyright Copyright (c) 2017 reganlawton
 */

namespace hut6\simplesharing\assetbundles\SimpleSharing;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    reganlawton
 * @package   SimpleSharing
 * @since     2.0.0
 */
class SimpleSharingAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@hut6/simplesharing/assetbundles/simplesharing/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/SimpleSharing.js',
        ];

        $this->css = [
            'css/SimpleSharing.css',
        ];

        parent::init();
    }
}
