<?php
namespace BoxzookaAPI\model;

class InboundListResponse extends AbstractResponseModel {

	public function getNodeName() {
		return 'InboundListResponse';
	}
	public function __construct() {
		$this->addField('Results', array(
			'type' => 'BoxzookaAPI\model\Inbounds'
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