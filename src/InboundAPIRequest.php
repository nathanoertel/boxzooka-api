<?php
namespace BoxzookaAPI;

use BoxzookaAPI\model\Inbound;

class InboundAPIRequest extends AbstractRequest {

	public function addInbound($poNumber, $carrier, $containerIds, $trackingNumber, $shipDate, $deliveryDate, $items) {
		$inbound = new Inbound();

		$inbound->PO = $poNumber;
		$inbound->Carrier = $carrier;
		foreach($containerIds as $containerId) $inbound->ContainerID = $containerId;
		$inbound->TrackingNumber = $trackingNumber;
		$inbound->ShipDate = $shipDate;
		$inbound->EstimatedDeliveryDate = $deliveryDate;
		$inbound->Item = $items;

		return $this->post($inbound);
	}

	public function getEndpoint() {
		return 'inboundapi/';
	}
}