<?php
namespace BoxzookaAPI\log;

class ErrorLogger implements Logger {
	
	public function log($message, $error = false) {
		error_log($message);
	}
}