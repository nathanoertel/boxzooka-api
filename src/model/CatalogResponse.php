<?php
namespace BoxzookaAPI\model;

class CatalogResponse extends AbstractResponseModel {

	public function getNodeName() {
		return 'CatalogResponse';
	}
	public function __construct() {
		$this->addField('Results', array(
			'type' => 'BoxzookaAPI\model\Items'
		));
	}
}