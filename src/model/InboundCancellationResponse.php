<?php
namespace BoxzookaAPI\model;

class InboundCancellationResponse extends AbstractResponseModel {

	public function getNodeName() {
		return 'InboundCancellationResponse';
	}
	public function __construct() {
		$this->addField('Response', array(
			'type' => 'BoxzookaAPI\model\Inbound',
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