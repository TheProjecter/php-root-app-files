<?
/*

jhat freelance

 # small business solutions

about this file

 #  name = hd.php
 #  desc = Head file
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
?>

<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

    <title><?=$cf->name?></title>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="<?=$cf->desc?>" />
    <meta name="keywords" content="<?=$cf->keyw?>" />
    
    <link rel="shortcut icon" href="/favicon.ico" />
    
    <style type="text/css"><? foreach($cf->css as $a) echo "@import url(/site/$a);";?></style>
    
    <? foreach($cf->js as $a) echo "<script type=\"text/javascript\" src=\"/site/$a\"></script>\r\n";?>
    
    <link rel="stylesheet" type="text/css" href="/site/_.css" />
    <script type="text/javascript" src="/site/_.js"></script>

</head>
<body>
	<div class="container_12">