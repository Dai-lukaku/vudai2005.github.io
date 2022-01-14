<?php
	$url = 'http://thesieure.com/chargingws/v2';
	$partner_id = '7246413951';
	$partner_key = 'e4ddfd48ece4b112b03e97c3b89165b9';
	
	
    function creatSign($partner_key, $params)
    {
        $data = array();
        $data['request_id'] = $params['request_id'];
        $data['code'] = $params['code'];
        $data['partner_id'] = $params['partner_id'];
        $data['serial'] = $params['serial'];
        $data['telco'] = $params['telco'];
        $data['command'] = $params['command'];
        ksort($data);
        $sign = $partner_key;
        foreach ($data as $item) {
            $sign .= $item;
        }
		
		//return $sign;

        return md5($sign);
    }
?>