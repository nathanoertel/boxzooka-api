<?php
namespace BoxzookaAPI\model;

class WarehouseInventoryList extends AbstractModel {
	public function getNodeName() {
		return $this->warehouse_id;
	}

	public function __construct($index) {
		$this->addField('warehouse_id', array(
			'type' => 'integer',
			'min' => 1,
			'required' => true,
			'index' => true
		));
		$this->addField($index, array(
			'type' => 'BoxzookaAPI\model\Inventory',
			'min' => 1,
			'required' => true,
			'array' => true
		));

		$this->warehouse_id = $index;
	}
}