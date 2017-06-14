<?php

namespace ScumPetard\IpCheck;

/**
 * Class IpCheck
 * @package ScumPetard\IpCheck
 */
class IpCheck
{

    public function check($ipStr, $checkip)
    {
        $ipArray = explode('-', $ipStr);
        $ip_start = $this->get_iplong($ipArray[0]);
        $ip_end = $this->get_iplong($ipArray[1]);
        $checkip = $this->get_iplong($checkip);
        if ($checkip >= $ip_start && $checkip <= $ip_end) {
            return true;
        } else {
            return false;
        }

    }

    public function get_iplong($ip)
    {
        return bindec(decbin(ip2long($ip)));
    }

}
