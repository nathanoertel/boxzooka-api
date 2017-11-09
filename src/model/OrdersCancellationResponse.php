<?php
namespace BoxzookaAPI\model;

class OrdersCancellationResponse extends AbstractResponseModel {

	public function getNodeName() {
		return 'OrdersCancellationResponse';
	}
	public function __construct() {
		$this->addField('Response', array(
			'type' => 'BoxzookaAPI\model\Order',
			'array' => true
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