<?php
namespace BoxzookaAPI\model;

abstract class AbstractResponseModel extends AbstractModel {

	public function __construct() {
		$this->addField('CustomerID', array(
			'type' => 'string',
			'set' => false
		));
		$this->addField('Version', array(
			'type' => 'float',
			'set' => false
		));
	}
}