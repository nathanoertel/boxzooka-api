<?php
namespace BoxzookaAPI\model;

class Inventories extends AbstractModel {

	public function getNodeName() {
		return 'Inventories';
	}

	public function __construct() {
		$this->addField('Item', array(
			'type' => 'BoxzookaAPI\model\Inventory',
			'required' => true,
			'min' => 1,
			'max' => null,
			'array' => true
		));
	}
}