<?php
namespace BoxzookaAPI;

use BoxzookaAPI\model\InboundList;

class InboundListAPIRequest extends AbstractRequest {

	public function find($page = 0, $filters = array(), $filterLogic = 'AND') {
		$inboundList = new InboundList();
		
		if(count($filters)) {
			$inboundList->Filter = $filters;
			$inboundList->FilterLogic = $filterLogic;
		}
		
		if($page > 0) $inboundList->SkipCount = $page*300;

		return $this->post($inboundList);
	}

	public function getEndpoint() {
		return 'inboundlistapi/';
	}
}