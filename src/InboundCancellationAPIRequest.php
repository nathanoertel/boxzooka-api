<?php
namespace BoxzookaAPI;

use BoxzookaAPI\model\InboundCancellation;

class InboundCancellationAPIRequest extends AbstractRequest {
	
	public function cancelInbound($poNumber) {
		$inboundCancellation = new InboundCancellation();
		
		$inboundCancellation->PO = $poNumber;

		return $this->post($inboundCancellation);
	}

	public function getEndpoint() {
		return 'inboundcancelapi/';
	}
}