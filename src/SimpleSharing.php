<?php
/**
 * SimpleSharing plugin for Craft CMS 3.x
 *
 * Simple Sharing generates social media share links within CP entry pages, allowing you to quickly & easily share entries.
 *
 * @link      https://hutsix.com.au
 * @copyright Copyright (c) 2017 reganlawton
 */

namespace hut6\simplesharing;

use craft\web\View;
use hut6\simplesharing\variables\SimpleSharingVariable;
use hut6\simplesharing\models\Settings;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\web\UrlManager;
use craft\web\twig\variables\CraftVariable;
use craft\events\RegisterUrlRulesEvent;

use yii\base\Event;

/**
 * Class SimpleSharing
 *
 * @author    reganlawton
 * @package   SimpleSharing
 * @since     2.0.0
 *
 */
class SimpleSharing extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var SimpleSharing
     */
    public static $plugin;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_SITE_URL_RULES,
            function (RegisterUrlRulesEvent $event) {
                $event->rules['siteActionTrigger1'] = 'simple-sharing/default';
            }
        );

        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_CP_URL_RULES,
            function (RegisterUrlRulesEvent $event) {
                $event->rules['cpActionTrigger1'] = 'simple-sharing/default/do-something';
            }
        );

        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('simpleSharing', SimpleSharingVariable::class);
            }
        );

        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                }
            }
        );

        // TODO
        Event::on(
            View::class,
            View::EVENT_END_PAGE,
            function(Event $event) {
                $url = Craft::$app->assetManager->getPublishedUrl('@hut6/simplesharing/assetbundles/simplesharing/dist/js/SimpleSharing.js', true);

                echo "<script src='$url'></script>";
            }
        );

        Craft::info(
            Craft::t(
                'simple-sharing',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }

    /**
     * @inheritdoc
     */
    protected function settingsHtml(): string
    {
        $sections = Craft::$app->sections->getAllSections('id');
        $options = [];

        foreach ($sections as $id => $section) {
            $options[$id] = $section->name;
        }
        return Craft::$app->view->renderTemplate(
            'simple-sharing/settings',
            [
                'settings' => $this->getSettings(),
                'options' => $options,
            ]
        );
    }
}
