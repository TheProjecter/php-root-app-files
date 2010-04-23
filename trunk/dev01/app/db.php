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
class db{
	
	# db01 mysql_insert_id
	var $id;
	
	# db02 mysql_error
	var $e;
	
	# db03 mysql_error
	var $msg;
	
	# db03 mysql_error
	var $debug = false;
	
	#db14 init
	function __construct(){
		
		$this->c();
	}
	
	# db04 connect to db
	function c(){
		
		global $cf;
		
		if(mysql_connect($cf->db['host'],$cf->db['user'],$cf->db['pass']) && mysql_select_db($cf->db['name'])) return true;
		else die('Cant connect');
	}
	
	# db05 send to db
	function q($sql){
		$this->id = false;
		
		if($this->debug) echo "<div style=\"font-family:Courier New;\">$sql</div>\r\n";
		
		$r = mysql_query($sql);
		if(!$r){
			$this->e = mysql_error();
			return false;
		}
		else{
			$this->id = mysql_insert_id();
			return $r;
		}
	}
	
	# db06 get single field by field, table, and conditions
	function s($table,$field,$cond=array()){
		$sql = "SELECT
			$field
		FROM
			$table";
			
		$count = 0;
		foreach($cond as $var=>$val){
			$count++;
			$val = addslashes($val);
			$sql .= ($count != 1 ? " AND $var='$val'" : " WHERE $var='$val'");
		}
		$sql .= " LIMIT 1";
		
		$data = false;
		if($r = $this->q($sql)){
			if(mysql_num_rows($r)) $data = mysql_result($r,0,$field);
		} else $this->e = mysql_error();
		return $data;
	}
	
	# db07 get row by table and conditions
	function row($table,$cond=array(),$all=false){
		$sql = "SELECT
			*
		FROM
			$table";
			
		$count = 0;
		foreach($cond as $var=>$val){
			$count++;
			$val = addslashes($val);
			$sql .= ($count != 1 ? " AND $var='$val'" : " WHERE $var='$val'");
		}
		if(!$all) $sql .= " LIMIT 1";
		
		$data = false;
		if($r = $this->q($sql)){
			if(mysql_num_rows($r)){
				if(!$all) $data = mysql_fetch_assoc($r);
				else while($row = mysql_fetch_assoc($r)) $data[] = $row;
			} else $data = array();
		} else $this->e = mysql_error();
		return $data;
	}
	
	# db08 get column array by table, field, and conditions
	function col($table,$col,$cond=array(),$key=false,$order=false,$dir=false){
		$sql = "SELECT";
		$count=0;
		if($key) $sql .= " $key,";
		$sql .= " $col FROM
			$table";
			
		$count = 0;
		foreach($cond as $var=>$val){
			$count++;
			$val = addslashes($val);
			$sql .= ($count != 1 ? " AND $var='$val'" : " WHERE $var='$val'");
		}
		if($order && $dir) $sql .= " ORDER BY $order $dir";
		$data = false;
		if($r = $this->q($sql)){
			if(mysql_num_rows($r)){
				while($row = mysql_fetch_assoc($r)) $data[$row[$key]] = $row[$col];
			} else $data = true;
		} else $this->e = mysql_error();
		return $data;
	}
	
	# db09 check if data exists by table,field, and conditions
	function exists($table,$field,$cond=array()){
		$sql = "SELECT
			$field
		FROM
			$table";
			
		$count = 0;
		foreach($cond as $var=>$val){
			$count++;
			$val = addslashes($val);
			$sql .= ($count != 1 ? " AND $var='$val'" : " WHERE $var='$val'");
		}
		$sql .= " LIMIT 1";
		
		$data = false;
		if($r = $this->q($sql)){
			if(mysql_num_rows($r)) $data = true;
		} else $this->e = mysql_error();
		return $data;
	}
	
	# db10 insert data by table and array
	function i($table,$data=array()){
	
		# create vars
		$count=0; $fields = false; $values = false;
		foreach($data as $var=>$val){
			$count++;
			$val = addslashes(trim($val));
			# add the fields
			$fields .= ($count != sizeof($data) ? "$var," : "$var");
			
			$noquotes = array('NOW()','CURRENT_TIMESTAMP');
			$values .= ($count != sizeof($data)
					? (in_array($val,$noquotes)
							 ? "$val,"
							 : "'$val',"
						) 
					: (in_array($val,$noquotes)
							? $val
							: "'$val'"
						)
					);
		}
		$sql = "INSERT INTO
		$table (
			$fields
		) VALUES (
			$values
		)";
		$ret = false;
		if($this->q($sql)){
			$this->id = mysql_insert_id();
			$ret = true;
		}
		else $this->e = mysql_error();
		return $ret;
	}
	
	# db11 update row by table, data, and conditions
	function u($table,$data=array(),$cond=array()){
		
		$sql = "UPDATE
			$table
		SET ";
		
		$count = 0;
		foreach($data as $var=>$val){
			$count++;
			$val = addslashes(trim($val));
			
			$noquotes = array('NOW()','CURRENT_TIMESTAMP');
			$sql .= ($count != sizeof($data)
					? (in_array($val,$noquotes)
							 ? "$var=$val,"
							 : "$var='$val',"
						) 
					: (in_array($val,$noquotes)
							 ? "$var=$val"
							 : "$var='$val'"
						)
					);
		}
			
		$count = 0;
		foreach($cond as $var=>$val){
			$count++;
			$val = addslashes($val);
			$sql .= ($count != 1 ? " AND $var='$val'" : " WHERE $var='$val'");
		}
		$ret = false;
		if($this->q($sql)) $ret = true;
		else $this->e = mysql_error();
		return $ret;
	}
	
	# db12 delete row by table and conditions
	function d($table,$cond=array()){
		$sql = "DELETE FROM
			$table ";
			
			
		$count = 0;
		foreach($cond as $var=>$val){
			$count++;
			$val = addslashes($val);
			$sql .= ($count != 1 ? " AND $var='$val'" : " WHERE $var='$val'");
		}
		$ret = false;
		if($this->q($sql)) $ret = true;
		else $this->e = mysql_error();
		return $ret;
	}
	
	# db13 easy query
	function eq($table,$fields=false,$cond=false,$key=false,$order=false,$dir=false,$limit=false){
		$sql = "SELECT";
		$count=0;
		if($fields){
			if(is_array($fields)){
				foreach($fields as $var=>$val){
					$count++;
					$val = addslashes($val);
					$sql .= ($count != sizeof($fields) ? " $val," : " $val");
				}
			} else $sql .= " $fields";
		}
		$sql .= " FROM
			$table";
			
		$count = 0;
		if($cond){
			if(is_array($cond)){
				foreach($cond as $var=>$val){
					$count++;
					$val = addslashes($val);
					if(strstr('IN (',$val) || strstr('IN(',$val))
						$sql .= ($count != 1 ? " AND $var $val" : " WHERE $var $val");
					else
						$sql .= ($count != 1 ? " AND $var='$val'" : " WHERE $var='$val'");
				}
			} else $sql .= " WHERE $cond";
		}
		
		if($order && $dir) $sql .= " ORDER BY $order $dir";
		if($limit) $sql .= " LIMIT $limit";
		$data = false;
		if($r = $this->q($sql)){
			if(mysql_num_rows($r)){
				if(!$key){
					$sql = "SHOW INDEX FROM $table";
					if($i = $this->q($sql)){
						if(mysql_num_rows($i)) $key = mysql_result($i,0,'Column_name');
					}
				}
				while($row = mysql_fetch_assoc($r)) $data[$row[$key]] = $row;
			} else $data = array();
		}else $this->e = mysql_error();
		return $data;
	}
}
?>