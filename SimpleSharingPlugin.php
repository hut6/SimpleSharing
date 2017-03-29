<?php namespace Craft;

class SimpleSharingPlugin extends BasePlugin
{

    public function getName()
    {
        return Craft::t('Simple Sharing');
    }

    public function getDescription()
    {
        return Craft::t('Simple Sharing generates social media share links within CP entry pages, allowing you to quickly & easily share entries.');
    }

    public function getVersion()
    {
        return '1.1.0';
    }

    public function getDeveloper()
    {
        return 'HutSix';
    }

    public function getDeveloperUrl()
    {
        return 'https://hutsix.com.au';
    }

	protected function defineSettings()
	{
		return array(
			'allowedSections' => AttributeType::Mixed,
		);
	}

    public function getDocumentationUrl()
    {
        return 'https://github.com/hut6/simplesharing/blob/master/README.md';
    }

    public function getReleaseFeedUrl()
    {
        return 'https://raw.githubusercontent.com/hut6/simplesharing/master/releases.json';
    }

	function init() {
		if (craft()->userSession->isLoggedIn() && craft()->userSession->isAdmin() ) {
			craft()->templates->includeJsResource("simplesharing/js/simple_sharing.js");
			craft()->templates->includeCssResource("simplesharing/css/simple_sharing.css");
		}
	}

	public function registerSiteRoutes()
	{
		return array(
			'_simple_sharing_url' => array('action' => 'simpleSharing/url'),
		);
	}

	public function getSettingsHtml()
	{
		$sections = craft()->sections->getAllSections("id");
		$options = array();

		foreach ($sections as $id => $section) {
			$options[$id] = $section->name;
		}

		return craft()->templates->render('simplesharing/settings', array(
			'settings' => $this->getSettings(),
			'options' => $options,
		));
	}
}
