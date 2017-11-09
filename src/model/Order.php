<?php
namespace BoxzookaAPI\model;

class Order extends AbstractModel {

	public function getNodeName() {
		return 'Order';
	}

	public function __construct() {
		$this->addField('OrderID', array(
			'type' => 'string',
			'min' => 1,
			'max' => 50,
			'required' => true
		));
		$this->addField('PackageID', array(
			'type' => 'string',
			'min' => 1,
			'max' => 50,
			'required' => true,
			'array' => true
		));
		$this->addField('OrderDate', array(
			'type' => 'timestamp',
			'required' => true
		));
		$this->addField('ShipTo', array(
			'type' => 'BoxzookaAPI\model\Address',
			'required' => true
		));
		$this->addField('Method', array(
			'type' => 'string',
			'min' => 7,
			'max' => 20
		));
		$this->addField('Incoterms', array(
			'type' => 'string',
			'accept' => array(
				'DDU',
				'DDP'
			)
		));
		$this->addField('OrderValue', array(
			'type' => 'currency',
			'required' => true
		));
		$this->addField('OrderCurrency', array(
			'type' => 'string',
			'min' => 3,
			'max' => 3,
			'required' => true
		));
		$this->addField('CustomsDescription', array(
			'type' => 'string',
			'min' => 3,
			'max' => 255
		));
		$this->addField('Carrier', array(
			'type' => 'string',
			'min' => 0,
			'max' => 50
		));
		$this->addField('CarrierAccountNo', array(
			'type' => 'string',
			'min' => 0,
			'max' => 50
		));
		$this->addField('CarrierMethod', array(
			'type' => 'string',
			'min' => 0,
			'max' => 30
		));
		$this->addField('Item', array(
			'type' => 'BoxzookaAPI\model\Item',
			'array' => true,
			'required' => true,
			'min' => 1
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