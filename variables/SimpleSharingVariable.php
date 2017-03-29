<?php
/**
 * oEmbed Variable
 *
 * @author    HutSix
 * @copyright Copyright (c) 2017 HutSix
 * @link      https://hutsix.com.au
 * @package   OEmbed
 * @since     1.0.0
 */

namespace Craft;

class SimpleSharingVariable
{
    public function link($url, $service)
    {
        switch ($service) {
            case "facebook":
                return 'https://www.facebook.com/sharer/sharer.php?u='.$url;
                break;
            case "twitter":
                return 'https://twitter.com/home?status='.$url;
                break;
            case "google":
                return 'https://plus.google.com/share?url='.$url;
                break;
            default:
                return null;
        }
    }
}