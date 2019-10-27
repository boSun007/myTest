<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/3/31 0031
     * Time: 15:50
     */

    class GDClass {
        public $v=0;
        public function getV(){
            return $this->v+1;
        }
    }
    class FDClass extends GDClass {
        public $v = 7;
        public function getV(){
            return ;
            //我要怎么访问GDClass 中的$v呢?
        }
    }
    $sn = new FDClass();
echo $sn->parent::v;
    class SNClass extends FDClass {
        public function getV(){

        }
    }

