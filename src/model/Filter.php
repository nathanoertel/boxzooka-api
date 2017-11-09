<?php
namespace BoxzookaAPI\model;

class Filter extends AbstractModel {

	public function getNodeName() {
		return 'Filter';
	}

	public function __construct() {
		$this->addField('FilterType', array(
			'type' => 'string',
			'required' => true
		));
		$this->addField('FilterValue', array(
			'type' => 'string',
			'required' => true
		));
	}
}