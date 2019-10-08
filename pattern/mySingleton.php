<?php
/**
 * Global singleton preferences class
 */
class Prefs {
	
	private static $instance;
	private $props = array();
	
    private function __construct() {}
	
	/**
	 * Set a key / value pair, only if doesn't exist
	 * @param string $key
	 * @param mixed $val
	 * @return boolean False if already exists
	 */
	public function add($key, $val) {
		if (isset($this->props[$key])) {
			return false;
		}
		$this->set($key, $val);
		return true;
	}
	
	/**
	 * Get singleton instance of the class
	 * @return Prefs
	 */
	public static function gi() {
		if (empty(self::$instance)) {
			self::$instance = new Prefs;
		}
		return self::$instance;
	}
	
	/**
	 * Set a key / value pair
	 * @param string $key
	 * @param mixed $val
	 */
	public function set($key, $val) {
		$this->props[$key] = $val;
	}
	
	/**
	 * Retrieve a value by its key
	 * @param string $key
	 * @return mixed:
	 */
	public function get($key) {
		if (array_key_exists($key, $this->props)) {return $this->props[$key];}
		return null;
	}
}

$obj = new Prefs();
$obj->set('name','bo');
echo $obj->get('name');
$obj1 = new Prefs();
$obj1->set('name','bo1');
echo $obj1->get('name');
var_dump($obj);