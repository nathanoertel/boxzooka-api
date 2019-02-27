<?php
namespace BoxzookaAPI\model;

class Inventory extends AbstractModel {

	public function getNodeName() {
		return null;
	}

	public function __construct() {
		// item data fields
		$this->addField('sku', array(
			'type' => 'string',
			'required' => true,
			'min' => 5,
			'max' => 20
		));
		$this->addField('upc', array(
			'type' => 'string',
			'required' => true,
			'min' => 1
		));
		$this->addField('item_name', array(
			'type' => 'string',
			'required' => true,
			'min' => 1
		));
		$this->addField('style', array(
			'type' => 'string',
			'required' => true,
			'min' => 1
		));
		$this->addField('color', array(
			'type' => 'string',
			'required' => true,
			'min' => 1
		));
		$this->addField('size', array(
			'type' => 'string',
			'required' => true,
			'min' => 1
		));
		$this->addField('retail_price', array(
			'type' => 'float',
			'required' => true,
			'min' => 1
		));
		$this->addField('quantity', array(
			'type' => 'integer',
			'required' => true,
			'min' => 1
		));
		$this->addField('warehouse_id', array(
			'type' => 'integer',
			'required' => true,
			'min' => 6,
			'max' => 6
		));
	}
}