
<?php 
/*人民币大写  
*调用 cny(123.45)
*/
function cny($ns) { 
    static $cnums=array("零","壹","贰","叁","肆","伍","陆","柒","捌","玖"), 
        $cnyunits=array("","圆","角","分"), 
        $grees=array("","拾","佰","仟","万","拾","佰","仟","亿"); 
    list($ns1,$ns2)=explode(".",$ns,2); 
   
    $ns2=array_filter(array($ns2[1],$ns2[0])); //转为数组
   
    $arrayTemp=_cny_map_unit(str_split($ns1),$grees);
 
    //die();
 
 
    $ret=array_merge($ns2,array(implode("",$arrayTemp),"")); //处理整数
   
   	$arrayTemp=_cny_map_unit($ret,$cnyunits);
   
    $ret=implode("",array_reverse($arrayTemp)); 	//处理小数
   
    return str_replace(array_keys($cnums),$cnums,$ret); 
}
function _cny_map_unit($list,$units) { 
    $ul=count($units); 
    $xs=array(); 
    foreach (array_reverse($list) as $x) { 
        $l=count($xs);
 
 
        if ($x!="0" || !($l%4)) $n=($x=='0'?'':$x).($units[($l)%$ul]); 
        else $n=is_numeric($xs[0][0])?$x:''; 
        array_unshift($xs,$n); 
    } 
    return $xs; 
}
echo cny(12345678.00);
