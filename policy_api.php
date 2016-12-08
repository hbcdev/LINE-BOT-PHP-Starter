<?php
$data = getdata('https://api.hbc.in.th/api/')








function fakeip()  
{  
    return long2ip( mt_rand(0, 65537) * mt_rand(0, 65535) );   
}  
function getdata($url,$args=false) 
{ 
    global $session; 
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL,$url); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("REMOTE_ADDR: ".fakeip(),"X-Client-IP: ".fakeip(),"Client-IP: ".fakeip(),"HTTP_X_FORWARDED_FOR: ".fakeip(),"X-Forwarded-For: ".fakeip())); 
    if($args) 
    { 
        curl_setopt($ch, CURLOPT_POST, 1); 
        curl_setopt($ch, CURLOPT_POSTFIELDS,$args); 
    } 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    //curl_setopt($ch, CURLOPT_PROXY, "127.0.0.1:8888"); 
    $result = curl_exec ($ch); 
    curl_close ($ch); 
    return $result; 
} 