<?php
namespace BoxzookaAPI\model;

class InboundList extends AbstractRequestModel {

	public function getNodeName() {
		return 'InboundList';
	}

	public function getResponseModel() {
		return new InboundListResponse();
	}

	public function __construct() {
		parent::__construct();
		$this->addField('Filter', array(
			'type' => 'BoxzookaAPI\model\Filter',
			'min' => 1,
			'required' => true,
			'array' => true
		));
		$this->addField('FilterLogic', array(
			'type' => 'string',
			'required' => false,
			'accept' => array(
				'AND',
				'OR'
			)
		));
		$this->addField('OrderBy', array(
			'type' => 'string',
			'min' => 0,
			'max' => 50,
		));
		$this->addField('Sort', array(
			'type' => 'string',
			'min' => 0,
			'max' => 5,
			'accept' => array(
				'ASC',
				'DESC'
			)
		));
		$this->addField('SkipCount', array(
			'type' => 'integer',
		));
	}
}