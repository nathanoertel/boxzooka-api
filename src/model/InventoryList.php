<?php
namespace BoxzookaAPI\model;

class InventoryList extends AbstractJSONResponseModel {
	public function getNodeName() {
		return null;
	}

	public function __construct() {
		$this->addField('inventory', array(
			'type' => 'BoxzookaAPI\model\WarehouseInventoryList',
			'min' => 1,
			'required' => true,
			'array' => true
		));
	}
}