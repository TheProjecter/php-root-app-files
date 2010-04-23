<?php
/*

jhat freelance

 # small business solutions

about this file

 #  name = in.php
 #  desc = Include file
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

# set classes
$load = array('cf','db','fn','jh');

# load classes
foreach($load as $l){
	include("app/$l.php");
	$$l = new $l;
}

# view file
$view = isset($_REQUEST['view']) ? $_REQUEST['view'] : 'index';

# is the page locked?
$lock = in_array($view,$cf->locked) ? true : false;

# is the page ajax?
$ajax = isset($ajax) ? true : false;

# must be logged in
if($lock && !$uid) header("Location: $cf->login_url", false);

# load dos
include('app/do.php');

# load view if not ajax
if(!$ajax){
	
	# load header
	include('app/hd.php');
	
	# load view
	include("view/$view.php");
	
	# load footer
	include('app/ft.php');
}