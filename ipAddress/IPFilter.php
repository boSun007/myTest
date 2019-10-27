<?php

namespace SerenityLib;

use DB;


class IPFilter
{

    const FORMAT_QUADS  = '%d';

    private $subnet_mask;
    private $network_size;
    private $quads;

    public static function setIpRange($ip, $size, $xmlBookingLoginID, $tag = 'production')
    {
        $obj = new self($ip, $size);
        $minIP = ip2long($obj->getMinHost());
        $maxIP = ip2long($obj->getMaxHost());

        $data = [
            'XMLBookingLoginID' => $xmlBookingLoginID,
            'WLIPStart' => $minIP,
            'WLIPEnd' => $maxIP,
            'WLIPTag' => $tag,
        ];


        DB::gi()->insert('IPWhiteList', $data);
    }

    public static function isAllowed(string $ip, $xmlBookingLoginID)
    {
        $rtn = [
            'status' => false,
            'msg' => 'not allowed',
        ];

        $ip = ip2long($ip);
        $sql = "SELECT WLIPTag FROM IPWhiteList WHERE WLIPStart<=$ip AND WLIPEnd>=$ip AND XMLBookingLoginID=$xmlBookingLoginID AND WLStatus =1";
        
        $res = DB::gi()->SELECT($sql);
        if ($res && count($res)==1) {
            $rtn['status'] = true;
            $rtn['msg']=$res[0]['WLIPTag'];
        }

        return $rtn;
    }


    




    private function __construct($ip, $network_size)
    {
        $this->network_size = $network_size;
        $this->quads        = explode('.', $ip);

        $this->subnet_mask  = $this->calculateSubnetMask($network_size);
    }

    private function getMinHost()
    {
        if ($this->network_size === 32 || $this->network_size === 31) {
            return $this->ip_address;
        }
        return $this->minHostCalculation(self::FORMAT_QUADS, '.');
    }

    public function getMaxHost()
    {
        if ($this->network_size === 32 || $this->network_size === 31) {
            return $this->ip_address;
        }
        return $this->maxHostCalculation(self::FORMAT_QUADS, '.');
    }

    private function maxHostCalculation($format, $separator = '')
    {
        $network_quads         = $this->getNetworkPortionQuads();
        $number_ip_addresses   = $this->getNumberIPAddresses();

        $network_range_quads = [
            sprintf($format, ($network_quads[0] & ($this->subnet_mask >> 24)) + ((($number_ip_addresses - 1) >> 24) & 0xFF)),
            sprintf($format, ($network_quads[1] & ($this->subnet_mask >> 16)) + ((($number_ip_addresses - 1) >> 16) & 0xFF)),
            sprintf($format, ($network_quads[2] & ($this->subnet_mask >>  8)) + ((($number_ip_addresses - 1) >>  8) & 0xFF)),
            sprintf($format, ($network_quads[3] & ($this->subnet_mask >>  0)) + ((($number_ip_addresses - 1) >>  0) & 0xFE)),
        ];

        return implode($separator, $network_range_quads);
    }


    public function getNetworkPortionQuads()
    {
        return explode('.', $this->networkCalculation(self::FORMAT_QUADS, '.'));
    }

    private function networkCalculation($format, $separator = '')
    {
        $network_quads = [
            sprintf("$format", $this->quads[0] & ($this->subnet_mask >> 24)),
            sprintf("$format", $this->quads[1] & ($this->subnet_mask >> 16)),
            sprintf("$format", $this->quads[2] & ($this->subnet_mask >>  8)),
            sprintf("$format", $this->quads[3] & ($this->subnet_mask >>  0)),
        ];

        return implode($separator, $network_quads);
    }


    public function getNumberIPAddresses()
    {
        return pow(2, (32 - $this->network_size));
    }

    private function minHostCalculation($format, $separator = '')
    {
        $network_quads = [
            sprintf("$format", $this->quads[0] & ($this->subnet_mask >> 24)),
            sprintf("$format", $this->quads[1] & ($this->subnet_mask >> 16)),
            sprintf("$format", $this->quads[2] & ($this->subnet_mask >>  8)),
            sprintf("$format", ($this->quads[3] & ($this->subnet_mask >> 0)) + 1),
        ];

        return implode($separator, $network_quads);
    }

    private function calculateSubnetMask($network_size)
    {
        return 0xFFFFFFFF << (32 - $network_size);
    }
}
