<?php
namespace BoxzookaAPI\log;

interface Logger {
	
	public function log($message, $error = false);
}
?>