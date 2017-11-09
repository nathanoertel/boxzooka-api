<?php
namespace BoxzookaAPI\model;

class Inventory extends AbstractModel {

	public function getNodeName() {
		return 'Inventory';
	}

	public function __construct() {
		// item data fields
		$this->addField('Sku', array(
			'type' => 'string',
			'required' => true,
			'min' => 5,
			'max' => 20
		));
		$this->addField('Quantity', array(
			'type' => 'integer',
			'required' => true,
			'min' => 1
		));
		$this->addField('QuantityReady', array(
			'type' => 'integer',
			'required' => true,
			'min' => 1
		));
		$this->addField('WarehouseID', array(
			'type' => 'string',
			'required' => true,
			'min' => 6,
			'max' => 6
		));
		$this->addField('WarehouseCity', array(
			'type' => 'string',
			'required' => true,
			'min' => 3,
			'max' => 100
		));
		$this->addField('WarehouseProvince', array(
			'type' => 'string',
			'required' => false,
			'min' => 2,
			'max' => 100
		));
		$this->addField('WarehouseCountry', array(
			'type' => 'string',
			'required' => false,
			'min' => 2,
			'max' => 2
		));
		// item addition result fields
		$this->addField('Status', array(
			'type' => 'string',
			'setter' => false
		));
		$this->addField('ErrorMessage', array(
			'type' => 'string',
			'setter' => false,
			'array' => true
		));
	}
}