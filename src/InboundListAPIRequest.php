<?php
namespace BoxzookaAPI;

use BoxzookaAPI\model\InboundList;

class InboundListAPIRequest extends AbstractRequest {

	public function find($filters = array(), $filterLogic = 'AND') {
		$inboundList = new InboundList();
		
		if(count($filters)) {
			$inboundList->Filter = $filters;
			$inboundList->FilterLogic = $filterLogic;
		}

		return $this->post($inboundList);
	}

	public function getEndpoint() {
		return 'inboundlistapi/';
	}
}