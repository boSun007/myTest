<?php
    /**
     * 测试限制字符对于子类和父类的限定访问
     * 如果限定为父类, 则子类可以使用,
     * 如果限定为子类, 则父类不能使用
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/3/24 0024
     * Time: 13:54
     */
    class fatherClass{
        public $name;
    }
    class sonClass extends fatherClass{
    }

    function test(sonClass $father){
        $father->name="abc";
        echo $father->name;
    }
     test(new fatherClass());
    print "--------------------".PHP_EOL;

    class grandSon extends SonClass{

    }
    new grandSon();

