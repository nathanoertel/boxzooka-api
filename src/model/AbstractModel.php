<?php
namespace BoxzookaAPI\model;

abstract class AbstractModel {

	private $fields = array();

	private $data = array();

	public function __set($name, $value) {
		if(isset($this->fields[$name])) {
			$definition = $this->fields[$name];

			if($definition['array'] && is_array($value)) {
				$this->data[$name] = array();
				
				foreach($value as $val) $this->__set($name, $val); 
			} else {
				if(!is_object($value) && strlen($value) == 0) {
					unset($this->data[$name]);
				} else {
					switch($definition['type']) {
						case 'currency':
							if(is_numeric($value) && preg_match('/^\d*(\.\d{2})?$/', $value)) {
								$value = number_format(floatval($value), 2);
								if($definition['min'] !== null && $value < $definition['min']) throw new \InvalidArgumentException($value.' is not valid value for '.$name.', minimium '.$definition['min'].' expected', 2);
								if($definition['max'] !== null && $value > $definition['max']) throw new \InvalidArgumentException($value.' is not valid value for '.$name.', maximum '.$definition['max'].' expected', 2);
								if($definition['array']) {
									if(!isset($this->data[$name])) $this->data[$name] = array();
									$this->data[$name][] = number_format($value, 2);
								} else $this->data[$name] = number_format($value, 2);
							} else throw new \InvalidArgumentException($value.' is not valid type for '.$name.', '.$definition['type'].' expected', 1);
							break;
						case 'float':
							if(is_numeric($value)) {
								$value = floatval($value);
								if($definition['min'] !== null && $value < $definition['min']) throw new \InvalidArgumentException($value.' is not valid value for '.$name.', minimium '.$definition['min'].' expected', 2);
								if($definition['max'] !== null && $value > $definition['max']) throw new \InvalidArgumentException($value.' is not valid value for '.$name.', maximum '.$definition['max'].' expected', 2);
								if($definition['array']) {
									if(!isset($this->data[$name])) $this->data[$name] = array();
									$this->data[$name][] = $value;
								} else $this->data[$name] = $value;
							} else throw new \InvalidArgumentException($value.' is not valid type for '.$name.', '.$definition['type'].' expected', 1);
							break;
						case 'integer':
							if(is_numeric($value)) {
								$value = intval($value);
								if($definition['min'] !== null && $value < $definition['min']) throw new \InvalidArgumentException($value.' is not valid value for '.$name.', minimium '.$definition['min'].' expected', 2);
								if($definition['max'] !== null && $value > $definition['max']) throw new \InvalidArgumentException($value.' is not valid value for '.$name.', maximum '.$definition['max'].' expected', 2);
								if($definition['array']) {
									if(!isset($this->data[$name])) $this->data[$name] = array();
									$this->data[$name][] = $value;
								} else $this->data[$name] = $value;
							} else throw new \InvalidArgumentException($value.' is not valid type for '.$name.', '.$definition['type'].' expected', 1);
							break;
						case 'string':
							if(is_string($value)) {
								if($definition['min'] !== null && strlen($value) < $definition['min']) throw new \LengthException($value.' is not valid value for '.$name.', minimium '.$definition['min'].' characters expected', 2);
								if($definition['max'] !== null && strlen($value) > $definition['max']) throw new \LengthException($value.' is not valid value for '.$name.', maximum '.$definition['max'].' characters expected', 2);
								if(isset($definition['accept']) && !in_array($value, $definition['accept'])) throw new \InvalidArgumentException($value.' is not valid value for '.$name.', not accepted value', 2);
								if($definition['array']) {
									if(!isset($this->data[$name])) $this->data[$name] = array();
									$this->data[$name][] = $value;
								} else $this->data[$name] = $value;
							} else throw new \InvalidArgumentException($value.' is not valid type for '.$name.', '.$definition['type'].' expected', 1);
							break;
						case 'timestamp':
							if(is_string($value)) {
								$value = strtotime($value);
							}

							if(is_numeric($value)) {
								if($definition['array']) {
									if(!isset($this->data[$name])) $this->data[$name] = array();
									$this->data[$name][] = date('Y-m-d H:i:s', $value);;
								} else $this->data[$name] = date('Y-m-d H:i:s', $value);;
							} else throw new \InvalidArgumentException($value.' is not valid type for '.$name.', '.$definition['type'].' expected', 1);
							break;
						default:
							if(get_class($value) == $definition['type']) {
								if($definition['array']) {
									if(!isset($this->data[$name])) $this->data[$name] = array();
									if($definition['max'] !== null && count($this->data[$name]) > $definition['max']) throw new \LengthException($value.' is not valid value for '.$name.', maximum '.$definition['max'].' values expected', 2);
									$this->data[$name][] = $value;
								} else $this->data[$name] = $value;
							} else throw new \InvalidArgumentException(get_class($value).' is not valid type for '.$name.', '.$definition['type'].' expected', 1);
							break;
					}
				}
			}
		} else {
			//trigger_error($name.' is not a valid field');
		}
	}

	public function __get($key) {
		if(isset($this->fields[$key])) {
			if(isset($this->data[$key])) return $this->data[$key];
			else return null;
		}
	}

	public function toJSON($output = true) {
		$object = new \stdClass();

		foreach($this->fields as $key => $def) {
			if(!$def['index']) {
				if(isset($this->data[$key])) {
					if($def['array']) {
						if($def['min'] !== null && count($this->data[$key]) < $def['min']) throw new \LengthException($key.' minimium '.$def['min'].' values expected', 2);
						$object->$key = array();
						foreach($this->data[$key] as $value) {
							$index = $value->getNodeName();
							if($index) {
								if($def['object']) $object->$key[$index] = $value->toJSON(false)->$index;
								else $object->$key[$index] = $value;
							} else {
								$entries = $object->$key;
								if($def['object']) $entries[] = $value->toJSON(false);
								else $entries[] = $value;
								
								$object->$key = $entries;
							}
						}
					} else {
						if($def['object']) $object->$key = $this->data[$key]->toJSON(false);
						else $object->$key = $this->data[$key];
					}
				}
			}
		}

		if($output) return json_encode($object);
		else return $object;
	}

	public function fromJSON($json) {
		if(is_string($json)) $json = json_decode($json, true);

		foreach($this->fields as $key => $def) {
			if(isset($json[$key])) {
				if($def['array']) {
					$this->data[$key] = array();
					foreach($json[$key] as $index => $value) {
						if($def['object']) {
							$className = $def['type'];
							$object = new $className($index);
							$node = $object->getNodeName();
							if($node) {
								$object->fromJSON($json[$key]);
								$this->data[$key][$node] = $object;
							} else {
								$object->fromJSON($value);
								$this->data[$key][] = $object;
							}
						} else {
							switch($def['type']) {
								case 'currency':
								case 'float':
									$value = (float)$value;
									break;
								case 'integer':
									$value = (integer)$value;
									break;
								default:
									$value = (string)$value;
									break;
							}
							$this->data[$key][] = $value;
						}
					}
				} else {
					if($def['object']) {
						$className = $def['type'];
						$object = new $className();
						$object->fromJSON($json[$key]);

						$this->data[$key] = $object;
					} else {
						switch($def['type']) {
							case 'currency':
							case 'float':
								$value = (float)$json[$key];
								break;
							case 'integer':
								$value = (integer)$json[$key];
								break;
							default:
								$value = (string)$json[$key];
								break;
						}
						$this->data[$key] = $value;
					}
				}
			}
		}
	}

	public function toXML($xml = null) {
		if($xml == null) {
			$xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><'.$this->getNodeName().'></'.$this->getNodeName().'>');
		}

		$node = $xml;
		
		foreach($this->fields as $key => $def) {
			if(isset($this->data[$key])) {
				if($def['array']) {
					if($def['min'] !== null && count($this->data[$key]) < $def['min']) throw new \LengthException($key.' minimium '.$def['min'].' values expected', 2);
					foreach($this->data[$key] as $value) {
						if($def['object']) $value->toXML($node->addChild($key));
						else $node->addChild($key, $value);
					}
				} else {
					if($def['object']) $this->data[$key]->toXML($node->addChild($key));
					else if($def['cdata']) {
						$node->$key = null;
						$dom = dom_import_simplexml($node->$key); 
						$no   = $dom->ownerDocument; 
						$dom->appendChild($no->createCDATASection($this->data[$key])); 
					} else $node->$key = $this->data[$key];
				}
			}
		}

		return $xml;
	}

	public function fromXML($xml) {
		if(is_string($xml)) $xml = simplexml_Load_string($xml);

		foreach($this->fields as $key => $def) {
			if(isset($xml->$key)) {
				if($def['array']) {
					$this->data[$key] = array();
					if(count($xml->$key) == 1) {
						if($def['object']) {
							$className = $def['type'];
							$object = new $className();
							$object->fromXML($xml->$key);

							$this->data[$key][] = $object;
						} else {
							switch($def['type']) {
								case 'currency':
								case 'float':
									$value = (float)$xml->$key;
									break;
								case 'integer':
									$value = (integer)$xml->$key;
									break;
								default:
									$value = (string)$xml->$key;
									break;
							}
							$this->data[$key][] = $value;
						}
					} else {
						foreach($xml->$key as $value) {
							if($def['object']) {
								$className = $def['type'];
								$object = new $className();
								$object->fromXML($value);

								$this->data[$key][] = $object;
							} else {
								switch($def['type']) {
									case 'currency':
									case 'float':
										$value = (float)$value;
										break;
									case 'integer':
										$value = (integer)$value;
										break;
									default:
										$value = (string)$value;
										break;
								}
								$this->data[$key][] = $value;
							}
						}
					}
				} else {
					if($def['object']) {
						$className = $def['type'];
						$object = new $className();
						$object->fromXML($xml->$key);

						$this->data[$key] = $object;
					} else {
						switch($def['type']) {
							case 'currency':
							case 'float':
								$value = (float)$xml->$key;
								break;
							case 'integer':
								$value = (integer)$xml->$key;
								break;
							default:
								$value = (string)$xml->$key;
								break;
						}
						$this->data[$key] = $value;
					}
				}
			}
		}
	}

	protected function addField($key, $definition) {
		if(!isset($definition['array'])) $definition['array'] = false;
		if(!isset($definition['index'])) $definition['index'] = false;
		if(!isset($definition['min'])) $definition['min'] = null;
		if(!isset($definition['max'])) $definition['max'] = null;
		if(!isset($definition['required'])) $definition['required'] = false;
		if(!isset($definition['cdata'])) $definition['cdata'] = false;
		if(in_array($definition['type'], array(
			'currency',
			'float',
			'integer',
			'timestamp',
			'string'
		))) $definition['object'] = false;
		else $definition['object'] = true;
		$this->fields[$key] = $definition;
	}

	protected abstract function getNodeName();
}