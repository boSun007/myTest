<?php

class Solution
{

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[]
     */
    public static function twoSum1($nums, $target)
    {


        foreach ($nums as $key => $value) {

            foreach ($nums as $k => $v) {
                if($key != $k){

                    if ($value + $nums[$k] == $target) {
                        return [$k, $key];
                    }
                }
            }
        }
    }


    public static function twoSum($nums,$target){
       
        foreach($nums as $key => $value){
            $result = $target - $value;
            unset($nums[$key]);
            if(in_array($result,$nums)){
                $key1 = array_search($result,$nums);

                return [$key,$key1];
            }

            
        }

    }
}


$arr =[2,3,2,3];
$target = 6;

$src = Solution::twoSum($arr,$target);

print_r($src);
