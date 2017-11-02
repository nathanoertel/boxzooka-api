<?php
namespace BoxzookaAPI\model;

class InboundResponse extends AbstractResponseModel {

	public function getNodeName() {
		return 'InboundResponse';
	}
	public function __construct() {
		$this->addField('Results', array(
			'type' => 'BoxzookaAPI\model\Items'
		));
	}
}