<?php
namespace BoxzookaAPI\model;

class InventoryListResponse extends AbstractResponseModel {

	public function getNodeName() {
		return 'InventoryListResponse';
	}
	public function __construct() {
		$this->addField('Results', array(
			'type' => 'BoxzookaAPI\model\Inventories'
		));
		// item addition result fields
		$this->addField('Status', array(
			'type' => 'string',
			'setter' => false
		));
		$this->addField('ErrorMessage', array(
			'type' => 'string',
			'setter' => false
		));
	}
}