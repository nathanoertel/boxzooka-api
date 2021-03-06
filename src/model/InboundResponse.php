<?php
namespace BoxzookaAPI\model;

class InboundResponse extends AbstractResponseModel {

	public function getNodeName() {
		return 'InboundResponse';
	}
	public function __construct() {
		$this->addField('PO', array(
			'type' => 'string',
			'min' => 1,
			'max' => 50,
			'required' => true
		));
		$this->addField('Results', array(
			'type' => 'BoxzookaAPI\model\Items'
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