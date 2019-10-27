<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/4/3 0003
     * Time: 13:50
     */
    abstract class Expression{
        private static $keycount=0;
        private $key;
        abstract function interpret(InterpreterContext $context);
        function getKey(){
            if(!isset($this->key)){
                self::$keycount++;
                $this->key = self::$keycount;
            }
            return $this->key;
        }
    }

    class LiteralExpression extends Expression{
        private $value;
        function __construct($value) {
            $this->value = $value;
        }
        function interpret(InterpreterContext $context) {
            // TODO: Implement interpert() method.\
            $context->replace($this,$this->value);
        }
    }

    class InterpreterContext{
        private $expressionstore = array();
        function replace(Expression $exp, $value){
            $this->expressionstore[$exp->getKey()] = $value;
        }
        function lookup(Expression $exp){
            return $this->expressionstore[$exp->getKey()];
        }
    }

    $context = new InterpreterContext();
    $literal = new LiteralExpression('four');
    $literal->interpret($context);
    print $context->lookup($literal).PHP_EOL;


