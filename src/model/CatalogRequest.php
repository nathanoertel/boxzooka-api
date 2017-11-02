<?php
namespace BoxzookaAPI\model;

class CatalogRequest extends AbstractRequestModel {

	public function getNodeName() {
		return 'CatalogRequest';
	}

	public function getResponseModel() {
		return new CatalogResponse();
	}

	public function __construct() {
		parent::__construct();
		$this->addField('Items', array(
			'type' => 'BoxzookaAPI\model\Items',
			'required' => true
		));
	}
}