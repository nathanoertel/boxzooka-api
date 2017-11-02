<?php
namespace BoxzookaAPI\model;

abstract class AbstractRequestModel extends AbstractModel {

	public abstract function getResponseModel();
	
	public function __construct() {
		$this->addField('CustomerAccess', array(
			'type' => 'BoxzookaAPI\model\CustomerAccess',
			'required' => true
		));
		$this->addField('Version', array(
			'type' => 'float'
		));
	}
}