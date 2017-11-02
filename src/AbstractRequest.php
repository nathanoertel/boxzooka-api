<?php
namespace BoxzookaAPI;

use BoxzookaAPI\model\CustomerAccess;
use BoxzookaAPI\model\AbstractRequestModel;
use BoxzookaAPI\exception\InvalidRequestException;

abstract class AbstractRequest {

	const ENV_PROD = 'prod';
	const ENV_DEV = 'dev';
	
	const BASE_URL_PROD = 'https://merchant-api.jet.com/api';
	const BASE_URL_DEV = 'https://sandbox2.boxzooka.com/';

	const GET = 'GET';
	const ADD = 'ADD';
	const UPDATE = 'POST';
	const PUT = 'PUT';
	const DELETE = 'DELETE';

	public $env;

	protected $config = array(
		'max_retries' => 3
	);

	private $logger;

	/**
	 * @param array $config
	 * @param string $env
	 * @throws \Exception
	 */
	public function __construct(array $config = array(), $logger = null, $env = self::ENV_PROD)
	{
		// check the environment
		if(!in_array($env, array(self::ENV_PROD, self::ENV_DEV))) {
			throw new \Exception('Invalid environment');
		}

		$this->env = $env;

		// check that the necessary keys are set
		if(!isset($config['user']) || !isset($config['password'])) {
			throw new \Exception('Configuration missing user or password');
		}
	
		// Apply some defaults.
		$this->config = array_merge_recursive($this->config, $config);
		
		$this->logger = $logger;
	}

	public function get($data) {
		return $this->request(self::GET, $data);
	}

	public function post($data) {
		return $this->request(self::UPDATE, $data);
	}

	public function put($data) {
		return $this->request(self::PUT, $data);
	}

	public function delete($data) {
		return $this->request(self::DELETE, $data);
	}

	private function request($method, $data) {
		$result = false;

		$url = $this->getEnvBaseUrl($this->env).$this->getEndpoint();

		if($data instanceof AbstractRequestModel) {
			$customerAccess = new CustomerAccess();
			$customerAccess->CustomerID = $this->config['user'];
			$customerAccess->CustomerKey = $this->config['password'];

			$data->CustomerAccess = $customerAccess;
			$data->Version = 1.5;
		} else throw new InvalidRequestException('Invalid request type: '.get_class($data));
		
		$curl = curl_init();

		$time = round(microtime(true)*1000);

		$options = array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $url,
			CURLOPT_USERAGENT => 'Digital Cloud Commerce',
			CURLOPT_HEADER => 1,
			CURLOPT_RETURNTRANSFER => 1,
			CURLINFO_HEADER_OUT => true
		);

		$httpHeaders = array();

		if($method == self::GET) {
			if($data != null) $options[CURLOPT_URL] .= '?'.http_build_query($data);
			$this->log('GET '.$options[CURLOPT_URL]);
		} else if($method == self::UPDATE || $method == self::PUT) {
			$options[CURLOPT_POST] = 1;
			$options[CURLOPT_POSTFIELDS] = $data->toXML()->asXML();
			if($method == self::PUT) {
				$options[CURLOPT_CUSTOMREQUEST] = 'PUT';
				$this->log('PUT '.$options[CURLOPT_URL]);
			} else $this->log('UPDATE '.$options[CURLOPT_URL]);
			$this->log($data->toXML()->asXML());
		} else if($method == self::ADD) {
			$options[CURLOPT_POST] = 1;
			$options[CURLOPT_POSTFIELDS] = $data;
			$this->log('ADD '.$options[CURLOPT_URL]);
			$this->log($data);
		} else if($method == self::DELETE) {
			$options[CURLOPT_URL] .= '/'.$data;
			$options[CURLOPT_CUSTOMREQUEST] = 'DELETE';
			$this->log('DELETE '.$options[CURLOPT_URL]);
		}

		$options[CURLOPT_HTTPHEADER] = $this->getHeaders($options[CURLOPT_URL], $method, $httpHeaders);

		curl_setopt_array($curl, $options);

		$response = curl_exec($curl);
		$information = curl_getinfo($curl);
		
		$this->log('Request Header:');
		$this->log($information['request_header']);

		if($response !== false) {
			$this->log($response);
			
			$headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);

			$headers = substr($response, 0, $headerSize);
			$body = substr($response, $headerSize);

			$result = $data->getResponseModel();

			$result->fromXML($body);

			unset($headerSize, $headers, $body);
		} else {
			$this->log(curl_error($curl));
		}
		
		curl_close($curl);

		return $result;
	}
	
	protected function getPostFields($data) {
		return json_encode($data);
	}

	/**
	 * Get baseUrl for given environment
	 * @param string $env
	 * @return null|string
	 */
	public function getEnvBaseUrl($env)
	{
		switch ($env) {
			case self::ENV_PROD:
				return self::BASE_URL_PROD;
			case self::ENV_DEV:
				return self::BASE_URL_DEV;
			default:
				return null;
		}
	}
	
	protected function getPostContentType() {
		return 'Content-Type: application/xml';
	}

	public abstract function getEndpoint();

	protected abstract function getResponse();

	public function getHeaders($url, $method, $headers = array()) {
		$headers[] = $this->getPostContentType();
		$headers[] = 'Accept: application/xml';

		return $headers;
	}

	private function log($message) {
		if($this->logger) $this->logger->log($message);
	}
}