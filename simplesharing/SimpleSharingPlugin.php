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

	function init() {
		// check we have a admin user as we don't want to the js to run anywhere but when an admin is logged in
		if ( craft()->userSession->isLoggedIn() && craft()->userSession->isAdmin() ) {
			craft()->templates->includeJsResource("simplesharing/js/simple_sharing.js");
		}
	}

	public function registerSiteRoutes()
	{
		return array(
			'_simple_sharing_url' => array('action' => 'simpleSharing/url'),
		);
	}
}
