<?php
//    include "FileException.php";
//    include "XmlException.php";
//    include "ConfException.php";
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/3/20 0020
     * Time: 13:03
     */

    class Conf {

        private $file;
        private $xml;
        private $lastmatch;

        public function __construct($file) {

            $this->file = $file;
            if(!file_exists($file)){
                throw new FileException("file '{$file}' does not exist");
            }

            try{
                $this->xml = simplexml_load_file($file);
            }catch (\Exception $e){
                echo $e->getMessage();
                throw new XmlException("AAA");
                exit;
            }

            if(!is_object($this->xml)){
                throw new XmlException(libxml_get_last_error());
            }
             gettype($this->xml);
            $matches = $this->xml->xpath("/conf");
            if(!count($matches)){
                throw new ConfException('could not find root element: conf');
            }
        }

        public function write() {
            if(!is_writable($this->file)){
                throw new FileException("file '{$this->file}' is not writable");
            }
            file_put_contents($this->file,$this->xml->asXML());
        }

        public function get($str){
            $matches = $this->xml->xpath("/conf/item[@name=\"$str\"]");
            if(count($matches)){
                $this->lastmatch = $matches[0];
                return $matches[0];
            }
            return null;
        }

        public function set($key,$value){
            if(!is_null($this->get($key))){
                $this->lastmatch[0] = $value;
                return;
            }
            $conf = $this->xml->conf;
            $this->xml->addChild('item',$value)->addAttribute('name',$key);
        }
    }
set_error_handler("abc");
    function abc(){
        $msg="BBBB";
        throw new \Exception($msg);
    }
    try{

        $getXml = new Conf("abc.xml");
        echo $getXml->get("pass");
        $getXml->set("abc","123");
        $getXml->write();
    }
    catch (FileException $e){
        echo $e->getFile();
        echo $e->getLine();
        die("文件不存在");
    }catch (XmlException $e){
        die("文件损坏");
    }catch (ConfException $e){
        die("文件格式错误");
    }catch(\Exception $e){
        die($e->getMessage());
    }
