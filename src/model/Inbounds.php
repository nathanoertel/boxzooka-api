<?php
namespace BoxzookaAPI\model;

class Inbounds extends AbstractModel {

	public function getNodeName() {
		return 'Results';
	}

	public function __construct() {
		$this->addField('Inbound', array(
			'type' => 'BoxzookaAPI\model\Inbound',
			'required' => true,
			'min' => 1,
			'max' => null,
			'array' => true
		));
	}
}