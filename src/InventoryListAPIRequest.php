<?php
namespace BoxzookaAPI;

use BoxzookaAPI\model\InventoryList;

class InventoryListAPIRequest extends AbstractRequest {

	public function find($page, $filters = array(), $filterLogic = 'AND') {
		$inventoryList = new InventoryList();
		
		if(count($filters)) {
			$shipmentList->Filter = $filters;
			$shipmentList->FilterLogic = $filterLogic;
		}
		
		$inventoryList->SkipCount = $page*300;

		return $this->post($inventoryList);
	}

	public function getEndpoint() {
		return 'inventorylistapi/';
	}
}