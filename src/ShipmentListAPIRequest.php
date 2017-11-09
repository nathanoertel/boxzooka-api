<?php
namespace BoxzookaAPI;

use BoxzookaAPI\model\ShipmentList;

class ShipmentListAPIRequest extends AbstractRequest {

	public function find($filters = array(), $filterLogic = 'AND') {
		$shipmentList = new ShipmentList();
		
		if(count($filters)) {
			$shipmentList->Filter = $filters;
			$shipmentList->FilterLogic = $filterLogic;
		}

		return $this->post($shipmentList);
	}

	public function getEndpoint() {
		return 'shipmentlistapi/';
	}
}