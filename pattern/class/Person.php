<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/2/18 0018
     * Time: 12:42
     */

    class Person {

        private $_name = "Bos";
        private $_age;
        public $_writer;

        public function __destruct() {

            // TODO: Implement __destruct() method.
            echo "PERSON DESC";
        }

        public function __construct(PersonWriter $writer) {

            var_dump($this);
            $this->_writer = $writer;
        }

        public function __call($name, $arguments) {

            // TODO: Implement __call() method.
            if (method_exists($this->_writer, $name)) {
                return $this->_writer->$name($this);
            }
        }

        public function __set($property, $value) {

            $method = "set$property";
            if (method_exists($this, $method)) {
                return $this->$method($value);
            }
        }

        public function __unset($name) {

            // TODO: Implement __unset() method.
            unset($this->$name);
        }

//        public function unsetName(){
//            return $this->_name="";
//        }

        public function __get($property) {

            $method = "get{$property}";
            if (method_exists($this, $method)) {
                return $this->$method();
            }
            return "there is no name";
        }

        public function __isset($name) {

            // TODO: Implement __isset() method.
            $method = "get{$name}";
            echo "FF";
            return (method_exists($this, $method));
        }

        public function setName($name) {

            return $this->_name = $name;
        }

        function getName() {

            return $this->_name;
        }

        function getAge() {

            return 44;
        }
    }

    class PersonWriter {

        public function __destruct() {

            // TODO: Implement __destruct() method.
            echo "PERSONWRITE DESC";
        }

        public function __construct() {

            var_dump($this);
        }


        public function writeName(Person $person) {

            echo $person->getName() . "<hr />";
        }

        public function writeAge(Person $person) {

            echo $person->getAge() . "<hr />";
        }
    }

    class cloneTest {

        private $name;
        private $age;
        public $id;
        public $tt;

        public function __construct($name, $age) {

            $this->name = $name;
            $this->age = $age;
            $this->tt = $this;
        }

        public function setId($id) {

            $this->id = $id;
        }

        public function __clone() {

            // TODO: Implement __clone() method.
            $this->id = 0;
        }
    }

    class Account {

        public $balance;

        function __construct($balance) {

            $this->balance = $balance;
        }
    }

    class Person1 {

        private $name;
        private $age;
        private $id;
        public $account;

        public function __construct($name, $age, Account $account) {

            $this->name = $name;
            $this->age = $age;
            $this->account = $account;
        }

        function setId($id) {

            $this->id = $id;
        }

        function __clone() {

            // TODO: Implement __clone() method.
            $this->id = 0;
            $this->account = clone $this->account;
        }

    }

    class Product {

        public $name;
        public $price;

        function __construct($name, $price) {

            $this->name = $name;
            $this->price = $price;
        }
    }

    class ProcessSale {

        private $callbacks;

        function registerCallback($callback) {

            try {

                echo "FFF";
                if (!is_callable($callback)) {
                    throw new  \Exception("callback not callable");
                    echo "PPPP";
                }
            }
 catch (\Exception $e) {
                echo "LLL";
            }


            $this->callbacks[] = $callback;
        }

        function sale($product) {

            print "{$product->name}: processing \n";
            foreach ($this->callbacks as $callback) {
                try{

                    call_user_func($callback, $product);

                }catch (\Exception $e){
                    
                    echo "DDD";
                    echo $e->getMessage();
                }
            }
        }
    }