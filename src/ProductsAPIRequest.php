<?php
namespace BoxzookaAPI;

use BoxzookaAPI\model\Items;
use BoxzookaAPI\model\CatalogRequest;

class ProductsAPIRequest extends AbstractRequest {

	public function addProducts($productData) {
		$items = new Items();

		$items->Item = $productData;

		$catalogRequest = new CatalogRequest();

		$catalogRequest->Items = $items;

		return $this->post($catalogRequest);
	}

	public function getEndpoint() {
		return 'productsapi/';
	}

	protected function getResponse() {
		return 'BoxzookaAPI\model\CatalogResponse';
	}
}