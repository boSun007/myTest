<?php
/**数据操作类**/

class Request
{
	//allowed request methods
	private static $method_type = array('get','post','put','patch','delete');
	
	//testing dta
	private static $test_class = array(
		1 => array('name' => 'toff', 'count' => 18),
		2 => array('name' => 'eles', 'count' =>20),
		);

	public static function getRequest(){
		//get request method
		$method = strtolower($_SERVER['REQUEST_METHOD']);
		if(in_array($method, self::$method_type)){
			//use action according to the request method
			$data_name = $method.'Data';
			return self::$data_name($_REQUEST);
		}
		return false;
	}

	//get method
	private static function getData($request_data){

		$class_id = (int)$request_data['class'];
		//get/class/id: get ided data
		if($class_id > 0){ ////get /class: list all the class
			return self::$test_class[$class_id];
		}else{
			return self::$test_class;
		}
	}

	private static function postData($request_data){
		if(!empty($request_data['name'])){
			$data['name'] = $request_data['name'];
			$data['count'] = (int)$request_data['count'];
			self::$test_class[] = $data;
			return self::$test_class;
		}else{
			return false;
		}
	}

	private static function putData($request_data){
		$class_id = (int)$request_data['class'];
		if($class_id == 0){
			return false;
		}
		$data = array();
		if(!empty($request_data['name']) && isset($request_data['count'])){
			$data['name'] = $request_data['name'];
			$data['count'] = (int)$request_data['count'];
			self::$test_class[$class_id] = $data;
			return self::$test_class;
		}else{
			return false;
		}
	}

	//patch /class/id: update indicated data/field
	private static function patchData($request_data){
		$class_id = (int)$request_data['class'];
		if($class_id == 0){
			return false;
		}
		
		if(!empty($request_data['name'])){
			self::$test_class[$class_id]['name'] = $request_data['name'];
		}

		if(isset($request_data['count'])){
			self::$test_class[$class_id]['count'] = (int)$request_data['count'];
		}
		return self::$test_class;
	}

	//delete
	private static function deleteData($request_data){
		$class_id = (int)$request_data['class'];
		if($class_id == 0){
			return false;
		}

		unset(self::$test_class[$class_id]);
		return self::$test_class;
	}
}












