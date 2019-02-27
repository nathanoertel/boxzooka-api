<?php
namespace BoxzookaAPI;

use BoxzookaAPI\model\InventoryList;

class InventoryAPIRequest extends AbstractJSONRequest {

	public function find($sku = null) {
		return $this->get($sku);
	}

	public function getEndpoint() {
		return 'inventory';
	}

	public function getResponse() {
		return new InventoryList();
	}
}