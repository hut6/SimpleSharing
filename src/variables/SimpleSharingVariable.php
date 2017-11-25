<?php
/**
 * SimpleSharing plugin for Craft CMS 3.x
 *
 * Simple Sharing generates social media share links within CP entry pages, allowing you to quickly & easily share entries.
 *
 * @link      https://hutsix.com.au
 * @copyright Copyright (c) 2017 reganlawton
 */

namespace hut6\simplesharing\variables;

use hut6\simplesharing;

use Craft;

/**
 * @author    reganlawton
 * @package   SimpleSharing
 * @since     2.0.0
 */
class SimpleSharingVariable
{
    // Public Methods
    // =========================================================================

    /**
     * Call it like this:
     *
     *     {{ craft.simplesharing.link(url, service) }}
     *
     * @param $url
     * @param $service
     * @return string
     */
    public function link($url, $service)
    {
        switch ($service) {
            case 'facebook':
                return 'https://www.facebook.com/sharer/sharer.php?u='.$url;
                break;
            case 'twitter':
                return 'https://twitter.com/home?status='.$url;
                break;
            case 'google':
                return 'https://plus.google.com/share?url='.$url;
                break;
            default:
                return null;
        }
    }
}
