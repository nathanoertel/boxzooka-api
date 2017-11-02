<?php
namespace BoxzookaAPI\model;

class Items extends AbstractModel {

	public function getNodeName() {
		return 'Items';
	}

	public function __construct() {
		$this->addField('Item', array(
			'type' => 'BoxzookaAPI\model\Item',
			'required' => true,
			'min' => 1,
			'max' => null,
			'array' => true
		));
	}
}