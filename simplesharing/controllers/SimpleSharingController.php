<?php namespace Craft;

class SimpleSharingController extends BaseController
{
	protected $allowAnonymous = true;

	public function actionUrl()
	{
		$this->requireAjaxRequest();

		$data = craft()->request->getQuery();

		$allowedSections = craft()->plugins->getPlugin("SimpleSharing")->getSettings()->allowedSections;

		if (!$allowedSections or (is_array($allowedSections) and in_array($data['sectionId'], $allowedSections))) {
			$attr = [
				"id" => $data["id"]
			];

			$criteria = craft()->elements->getCriteria(ElementType::Entry, $attr);

			$entry = $criteria->first();
			if($entry->url) {
				echo $entry->url;
			}

		}

		craft()->end();

	}
}
