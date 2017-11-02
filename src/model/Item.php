<?php
namespace BoxzookaAPI\model;

class Item extends AbstractModel {

	public function getNodeName() {
		return 'Item';
	}

	public function __construct() {
		// item data fields
		$this->addField('Sku', array(
			'type' => 'string',
			'required' => true,
			'min' => 5,
			'max' => 20
		));
		$this->addField('ItemName', array(
			'type' => 'string',
			'required' => true,
			'min' => 5,
			'max' => 255
		));
		$this->addField('DeclaredCustomsValue', array(
			'type' => 'currency',
			'required' => true,
			'min' => 0,
			'max' => null
		));
		$this->addField('CurrencyCode', array(
			'type' => 'string',
			'required' => true,
			'min' => 3,
			'max' => 3
		));
		$this->addField('Category', array(
			'type' => 'string',
			'required' => false,
			'min' => 0,
			'max' => 3255
		));
		$this->addField('Color', array(
			'type' => 'string',
			'required' => false,
			'min' => 0,
			'max' => 100
		));
		$this->addField('Description', array(
			'type' => 'string',
			'required' => false,
			'min' => 5,
			'max' => 65000,
			'cdata' => true
		));
		$this->addField('Style', array(
			'type' => 'string',
			'required' => false,
			'min' => 0,
			'max' => 100
		));
		$this->addField('Materials', array(
			'type' => 'string',
			'required' => false,
			'min' => 0,
			'max' => 255
		));
		$this->addField('Size', array(
			'type' => 'string',
			'required' => false,
			'min' => 0,
			'max' => 20
		));
		$this->addField('BrandOrManufacturer', array(
			'type' => 'string',
			'required' => false,
			'min' => 0,
			'max' => 100
		));
		$this->addField('UpcVendorBarcode', array(
			'type' => 'string',
			'required' => false,
			'min' => 0,
			'max' => 50
		));
		$this->addField('CountryOfOrigin', array(
			'type' => 'string',
			'required' => true,
			'min' => 2,
			'max' => 2
		));
		$this->addField('ItemUrl', array(
			'type' => 'string',
			'required' => false,
			'min' => 11,
			'max' => 1000
		));
		$this->addField('ImageUrl', array(
			'type' => 'string',
			'required' => false,
			'min' => 0,
			'max' => 1000
		));
		$this->addField('Weight', array(
			'type' => 'float',
			'required' => true,
			'min' => 0,
			'max' => null
		));
		$this->addField('WeightUnit', array(
			'type' => 'string',
			'required' => true,
			'min' => 3,
			'max' => 3,
			'accept' => array(
				'LBS',
				'KGS'
			)
		));
		$this->addField('DimWidth', array(
			'type' => 'float',
			'required' => true,
			'min' => 0,
			'max' => null
		));
		$this->addField('DimHeight', array(
			'type' => 'float',
			'required' => true,
			'min' => 0,
			'max' => null
		));
		$this->addField('DimLength', array(
			'type' => 'float',
			'required' => true,
			'min' => 0,
			'max' => null
		));
		$this->addField('DimUnit', array(
			'type' => 'string',
			'required' => true,
			'min' => 2,
			'max' => 2,
			'accept' => array(
				'IN',
				'CM'
			)
		));
		$this->addField('Quantity', array(
			'type' => 'integer',
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