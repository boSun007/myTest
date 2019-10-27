<?php

namespace ipAddress;

class myIPFilter
{

    private $ip;
    private $mask;

    public function __construct($ip, $mask=32)
    {
        # code...
        $this->ip = $ip;
        $this->mask = $mask;
    }

    public function getRange()
    {
        # code...
        return [
            $this->getMinHost(),
            $this->getMaxHost(),
        ];
    }

    public function getRangeInt()
    {
        # code...
        return [
            ip2long( $this->getMinHost()),
            ip2long($this->getMaxHost()),
        ];
    }

    public function getMinHostInt(){
        return ip2long($this->getMinHost());
    }

    public function getMaxHostInt()
    {
        return ip2long($this->getMaxHost());
    }

    public function inTheRange(string $ip)
    {

        return (ip2long($ip)>=$this->getMinHostInt() && ip2long($ip)<=$this->getMaxHostInt());
    }


    public function getMinHost()
    {

        if($this->mask == 32){
            return $this->ip;
        }

        # code...
        $ipArray = explode(".", $this->ip);
        $minip = $ipArray;
        $maskSize = 32 - $this->mask;



        

        for ($i = 0; $i < $maskSize; $i++) {
            array_pop($minip);
        }

        for ($i = 0; $i < $maskSize; $i++) {
            array_push($minip, 0);
        }

        $minip = long2ip(ip2long(implode('.',$minip))+1);
       
        return $minip;
    }

    public function getMaxHost()
    {

        
        if($this->mask == 32){
            return $this->ip;
        }

        # code...
          # code...
          $ipArray = explode(".", $this->ip);
          $maxip = $ipArray;
          $maskSize = 4 - $this->mask / 8;
  
          for ($i = 0; $i < $maskSize; $i++) {
              array_pop($maxip);
          }
  
          for ($i = 0; $i < $maskSize; $i++) {
              array_push($maxip, 255);
          }
          
          $maxip = long2ip(ip2long(implode('.',$maxip))-1);
  
          return $maxip;
    }
}
