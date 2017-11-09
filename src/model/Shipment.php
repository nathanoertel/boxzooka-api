<?php
namespace BoxzookaAPI\model;

class Shipment extends AbstractModel {

	public function getNodeName() {
		return 'Shipment';
	}

	public function __construct() {
		$this->addField('InvoiceDate', array(
			'type' => 'timestamp',
			'required' => true
		));
		$this->addField('PackageID', array(
			'type' => 'integer',
			'min' => 1,
			'required' => true
		));
		$this->addField('PO', array(
			'type' => 'string',
			'min' => 0,
			'max' => 50,
			'required' => true
		));
		$this->addField('OrderID', array(
			'type' => 'string',
			'min' => 0,
			'max' => 50,
			'required' => true
		));
		$this->addField('ShipmentDate', array(
			'type' => 'timestamp',
			'required' => true
		));
		$this->addField('TrackingCode', array(
			'type' => 'string',
			'min' => 13,
			'max' => 28,
			'required' => true
		));
		$this->addField('ShipmentWeight', array(
			'type' => 'float'
		));
		$this->addField('DimensionalWeight', array(
			'type' => 'float'
		));
		$this->addField('WeightUnit', array(
			'type' => 'string',
			'min' => 3,
			'max' => 3
		));
		$this->addField('DimLength', array(
			'type' => 'float'
		));
		$this->addField('DimWidth', array(
			'type' => 'float'
		));
		$this->addField('DimHeight', array(
			'type' => 'float'
		));
		$this->addField('DimUnit', array(
			'type' => 'string',
			'min' => 3,
			'max' => 3
		));
		$this->addField('Cost', array(
			'type' => 'currency'
		));
		$this->addField('Incoterms', array(
			'type' => 'string',
			'accept' => array(
				'DDU',
				'DDP'
			)
		));
		$this->addField('ConsolidationID', array(
			'type' => 'string',
			'min' => 0,
			'max' => 12
		));
		$this->addField('ShipTo', array(
			'type' => 'BoxzookaAPI\model\Address'
		));
		$this->addField('Method', array(
			'type' => 'integer'
		));
		$this->addField('OrderValue', array(
			'type' => 'currency'
		));
		$this->addField('OrderCurrency', array(
			'type' => 'string',
			'min' => 3,
			'max' => 3
		));
		$this->addField('Notes', array(
			'type' => 'string',
			'min' => 0,
			'max' => 65000
		));
		$this->addField('CustomsDescription', array(
			'type' => 'string',
			'min' => 3,
			'max' => 255
		));
		$this->addField('SlipNote', array(
			'type' => 'string',
			'min' => 0,
			'max' => 200
		));
		$this->addField('Item', array(
			'type' => 'BoxzookaAPI\model\Item',
			'array' => true
		));
		$this->addField('Status', array(
			'type' => 'string'
		));
		
	}
}