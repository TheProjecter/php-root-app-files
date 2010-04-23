<?php
/*

jhat freelance

 # small business solutions

about this file

 #  name = fn.php
 #  desc = Function class
 #  auth = Joshua Hatfield
 #  date = XX XXX XX

important

 #  keep table of contents updated
 #  make revision notes and update examples
 
 #  !nf! = not finished
 #  !sp! = stopping pt.

revision notes

 #  0001 = example 1 		fixed API key in ex002					Josh	07 apr 10
 #  0002 = example 2 		fixed db checking in ex012				Josh	07 apr 10

table of contents

 #  ex01 = example 1		string / array			contains example 1
 #  ex02 = example 2		function				returns example 2

examples

 #  ex01 = example 1
 
 if(is_array($ex01))    print_r ($ex01);
 else   				print($ex01);
 
 #  ex02 = example 2
 
 echo ex02();
 
*/
class fn{
	
	var $msg = false;
	
	function a2o($a=array()) {
		return (object) $a;
	}
	
	function o2a($a=array()) {
		return (array) $a;
	}
	
	function s2i($a=array()) {
		return (int) $a;
	}
	
	function i2s($a=array()) {
		return (string) $a;
	}
	
	function generate_key($len=20){
		$aa = '';
		$bb = '';
		$sec = array();
		
		for($i=0;$i<$len;$i++) $sec[] = md5(rand(0,99));
		
		foreach($sec as $k=>$v) $aa .= substr(md5($v),0,1);
		
		foreach($sec as $k=>$v) $bb .= substr(($v),0,1);	
		
		return $aa . $bb;
	}
	
	function subval_sort($a,$subkey) {
		foreach($a as $k=>$v) $b[$k] = strtolower($v[$subkey]);
		asort($b);
		
		foreach($b as $key=>$val) $c[] = $a[$key];
		return $c;
	}
	
	function add_http($url){
		$url = eregi_replace('http://http://','http://',$url);
		$url = eregi_replace('http://https://','https://',$url);
		if(strtolower(substr($url,0,4)) == 'http' || $url == '') return $url;
		else return "http://$url";
	}
	
	function remove_http($url){
		$url = eregi_replace('http://','',$url);
		$url = eregi_replace('https://','',$url);
		return $url;
	}
}
?>