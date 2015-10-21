<?php namespace Craft;

class SimpleSharingPlugin extends BasePlugin
{
	public function getName()
	{
		return 'Simple Sharing';
	}

	public function getVersion()
	{
		return '1.0';
	}

	public function getDeveloper()
	{
		return 'Hut6';
	}

	public function getDeveloperUrl()
	{
		return 'https://hut6.com.au';
	}

	protected function defineSettings()
	{
		return array(
			'allowedSections' => AttributeType::Mixed,
		);
	}

	function init() {
		// check we have a admin user as we don't want to the js to run anywhere but when an admin is logged in
		if ( craft()->userSession->isLoggedIn() && craft()->userSession->isAdmin() ) {
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
