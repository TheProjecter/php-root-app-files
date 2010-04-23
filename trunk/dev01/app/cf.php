<?php
/*

jhat freelance

 # small business solutions

about this file

 #  name = cf.php
 #  desc = Config class
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
class cf{
	
	# 0001 name
	var $name 	= 'jhat freelance';
	
	# 0002 dir
	var $dir	= '/home/';
	
	# 0003 meta keyw
	var $keyw 	= '';
	
	# 0004 meta desc
	var $desc 	= '';
	
	# 000x
	var $login_url = '/login';
	
	# 0005 css
	var $css 	= array(
		'960/reset.css',
		'960/text.css',
		'960/960.css',
	);
	
	# 0006 js
	var $js 	= array(
		'jquery.js',
	);
	
	# 000x database
	var $db 	= array(
		'host' => '',
		'name' => '',
		'user' => '',
		'pass' => '',
	);
	
	# 000x emailsrv
	var $em = array(
		'host' => '',
	);
	
	var $locked = array(
		'locked-page',
	);
}