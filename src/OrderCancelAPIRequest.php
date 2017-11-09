<?php
namespace BoxzookaAPI;

use BoxzookaAPI\model\OrderCancellation;

class OrderCancelAPIRequest extends AbstractRequest {

	public function cancelOrders($orderIds, $delete = 'N') {
		$orderCancellation = new OrderCancellation();

		$orderCancellation->OrderID = $orderIds;
		$orderCancellation->Delete = $delete;

		return $this->post($orderCancellation);
	}

	public function getEndpoint() {
		return 'ordercancelapi/';
	}
}