<?php


function xml_to_array($root) {
    $result = array();

    if ($root->hasAttributes()) {
        $attrs = $root->attributes;
        foreach ($attrs as $attr) {
            $result['@attributes'][$attr->name] = $attr->value;
        }
    }

    if ($root->hasChildNodes()) {
        $children = $root->childNodes;
        if ($children->length == 1) {
            $child = $children->item(0);
            if ($child->nodeType == XML_TEXT_NODE) {
                $result['_value'] = $child->nodeValue;
                return count($result) == 1
                    ? $result['_value']
                    : $result;
            }
        }
        $groups = array();
        foreach ($children as $child) {
            if (!isset($result[$child->nodeName])) {
                $result[$child->nodeName] = xml_to_array($child);
            } else {
                if (!isset($groups[$child->nodeName])) {
                    $result[$child->nodeName] = array($result[$child->nodeName]);
                    $groups[$child->nodeName] = 1;
                }
                $result[$child->nodeName][] = xml_to_array($child);
            }
        }
    }

    return $result;
}


$xml = __DIR__.'/dom.xml';
$xml = file_get_contents($xml);
libxml_disable_entity_loader(true); 
$xmlstring = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA); 
$val = json_decode(json_encode($xmlstring),true);   

var_dump($val);die();




    $dom = new DomDocument();
    $dom->load(__DIR__.'/dom.xml');
$arr = xml_to_array($dom);
    
    die(var_dump($arr));
    
    $people = $dom->getElementsByTagName('people');//获取people的节点数组
// die(print_r($people->item(0)));

    $people->item(0);//获取第一个people节点
    $people->item(0)->childNodes;//获取第一个people节点的所有子节点
    $people->item(0)->attributes;//获取第一个people节点的所有属性

    $people->item(0)->childNodes->item(0);//获取第一个people节点的第一个节点,即xiaohua节点
    $people->item(0)->attributes->item(0);//获取第一个people节点的第一个属性,即nation属性。
    // $people->item(0)->childNodes->item(0)->childNodes->item(0);//获取第一个people节点的第一个节点里的name节点

    echo $people->item(0)->attributes->item(0)->nodeName;//输出字符串:nation
    echo $people->item(0)->attributes->item(0)->nodeValue;//输出字符串：汉族
    // echo $people->item(0)->childNodes->item(0)->childNodes->item(0)->nodeName;//输出字符串：name
// 　　 echo $people->item(0)->childNodes->item(0)->childNodes->item(0)->nodeValue;//输出字符串：小华
 
// 　　foreach($people->item(0)->attributes as $key => $value){//遍历节点
// 　　　　echo $key;//第一次输出字符串：nation，第二次输出字符串：city
// 　　　　echo $value->nodeValue;//第一次输出字符串：汉族，第二次输出字符串：火星
// 　　}