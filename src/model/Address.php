<?php
namespace BoxzookaAPI\model;

class Address extends AbstractModel {

	public function getNodeName() {
		return 'Address';
	}

	public function __construct() {
		$this->addField('FirstName', array(
			'type' => 'string',
			'min' => 0,
			'max' => 255
		));
		$this->addField('LastName', array(
			'type' => 'string',
			'min' => 0,
			'max' => 255
		));
		$this->addField('Company', array(
			'type' => 'string',
			'min' => 0,
			'max' => 255
		));
		$this->addField('Address1', array(
			'type' => 'string',
			'min' => 5,
			'max' => 255,
			'required' => true
		));
		$this->addField('Address2', array(
			'type' => 'string',
			'min' => 0,
			'max' => 255
		));
		$this->addField('Address3', array(
			'type' => 'string',
			'min' => 0,
			'max' => 255
		));
		$this->addField('City', array(
			'type' => 'string',
			'min' => 3,
			'max' => 100,
			'required' => true
		));
		$this->addField('Province', array(
			'type' => 'string',
			'min' => 2,
			'max' => 100,
			'required' => true
		));
		$this->addField('PostalCode', array(
			'type' => 'string',
			'min' => 5,
			'max' => 15,
			'required' => true
		));
		$this->addField('CountryCode', array(
			'type' => 'string',
			'min' => 2,
			'max' => 2,
			'required' => true
		));
		$this->addField('Phone', array(
			'type' => 'string',
			'min' => 0,
			'max' => 20
		));
		$this->addField('Email', array(
			'type' => 'string',
			'min' => 0,
			'max' => 100
		));
	}
}