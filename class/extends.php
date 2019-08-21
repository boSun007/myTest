<?php
class book{
    public $bookName="phpBook";
    public function __construct(){
        $this->bookName="phpBook CONST";
    }

}

class myBook extends book{
    public $bookName="myBook";
    public function __construct() {
        parent::__construct();
    }

}
class cat extends book{
    public $bookName="cat";
}

class test{
    public function getBookName(book $book){
        return $book->bookName;
    }
}
//$bookObj = new book();
//$myBookObj = new myBook();
$catObj = new cat();
$test = new test();
echo $test->getBookName($catObj);