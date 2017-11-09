<?php
namespace BoxzookaAPI;

use BoxzookaAPI\model\Orders;

class OrdersAPIRequest extends AbstractRequest {

	public function sendOrders($orders) {
		$order = new Orders();

		$order->Order = $orders;

		return $this->post($order);
	}

	public function getEndpoint() {
		return 'ordersapi/';
	}
}