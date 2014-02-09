<?php

/** 
 * Finds path, relative to the given root folder, of all files and directories in the given directory and its sub-directories non recursively. 
 * Will return an array of the form 
 * array( 
 *   'files' => [], 
 *   'dirs'  => [], 
 * ) 
 * @author sreekumar 
 * @param string $root 
 * @result array 
 */ 
function read_all_files($root = '.'){ 
  $files  = array('files'=>array(), 'dirs'=>array()); 
  $directories  = array(); 
  $last_letter  = $root[strlen($root)-1]; 
  $root  = ($last_letter == '\\' || $last_letter == '/') ? $root : $root.DIRECTORY_SEPARATOR; 
  
  $directories[]  = $root; 
  
  while (sizeof($directories)) { 
    $dir  = array_pop($directories); 
    if ($handle = opendir($dir)) { 
      while (false !== ($file = readdir($handle))) { 
        if ($file == '.' || $file == '..') { 
          continue; 
        } 
        $file  = $dir.$file; 
        if (is_dir($file)) { 
          $directory_path = $file.DIRECTORY_SEPARATOR; 
          array_push($directories, $directory_path); 
          $files['dirs'][]  = $directory_path; 
        } elseif (is_file($file)) { 
          $files['files'][]  = $file; 
        } 
      } 
      closedir($handle); 
    } 
  } 
  
  return $files; 
} 



function rekey( $input , $prefix )
{ 
  $out = array(); 
  foreach( $input as $i => $v )
  { 
    if ( is_numeric( $i ) ) 
    { 
       $out[$prefix . $i] = $v; 
       continue; 
    }
    $out[$i] = $v;
  }
  return $out;
}
function arrayToObject($array){

	$object = new stdClass();
	foreach ($array as $key => $value)
	{
 	   $object->$key = $value;
	}
Return $object;
}

function arrayToObject2($array) {
    if(!is_array($array)) {
        return $array;
    }
    
    $object = new stdClass();
    if (is_array($array) && count($array) > 0) {
      foreach ($array as $name=>$value) {
         $name = strtolower(trim($name));
         if (!empty($name)) {
            $object->$name = arrayToObject($value);
         }
      }
      return $object; 
    }
    else {
      return FALSE;
    }
}

function arrayToObject3($d) {
		if (is_array($d)) {
			/*
			* Return array converted to object
			* Using __FUNCTION__ (Magic constant)
			* for recursive call
			*/
			return (object) array_map(__FUNCTION__, $d);
		}
		else {
			// Return object
			return $d;
		}
	}


function do_dump(&$var, $var_name = NULL, $indent = NULL, $reference = NULL)
{
    $do_dump_indent = "<span style='color:#666666;'>|</span> &nbsp;&nbsp; ";
    $reference = $reference.$var_name;
    $keyvar = 'the_do_dump_recursion_protection_scheme'; $keyname = 'referenced_object_name';
    
    // So this is always visible and always left justified and readable
    echo "<div style='text-align:left; background-color:white; font: 100% monospace; color:black;'>";

    if (is_array($var) && isset($var[$keyvar]))
    {
        $real_var = &$var[$keyvar];
        $real_name = &$var[$keyname];
        $type = ucfirst(gettype($real_var));
        echo "$indent$var_name <span style='color:#666666'>$type</span> = <span style='color:#e87800;'>&amp;$real_name</span><br>";
    }
    else
    {
        $var = array($keyvar => $var, $keyname => $reference);
        $avar = &$var[$keyvar];

        $type = ucfirst(gettype($avar));
        if($type == "String") $type_color = "<span style='color:green'>";
        elseif($type == "Integer") $type_color = "<span style='color:red'>";
        elseif($type == "Double"){ $type_color = "<span style='color:#0099c5'>"; $type = "Float"; }
        elseif($type == "Boolean") $type_color = "<span style='color:#92008d'>";
        elseif($type == "NULL") $type_color = "<span style='color:black'>";

        if(is_array($avar))
        {
            $count = count($avar);
            echo "$indent" . ($var_name ? "$var_name => ":"") . "<span style='color:#666666'>$type ($count)</span><br>$indent(<br>";
            $keys = array_keys($avar);
            foreach($keys as $name)
            {
                $value = &$avar[$name];
                do_dump($value, "['$name']", $indent.$do_dump_indent, $reference);
            }
            echo "$indent)<br>";
        }
        elseif(is_object($avar))
        {
            echo "$indent$var_name <span style='color:#666666'>$type</span><br>$indent(<br>";
            foreach($avar as $name=>$value) do_dump($value, "$name", $indent.$do_dump_indent, $reference);
            echo "$indent)<br>";
        }
        elseif(is_int($avar)) echo "$indent$var_name = <span style='color:#666666'>$type(".strlen($avar).")</span> $type_color".htmlentities($avar)."</span><br>";
        elseif(is_string($avar)) echo "$indent$var_name = <span style='color:#666666'>$type(".strlen($avar).")</span> $type_color\"".htmlentities($avar)."\"</span><br>";
        elseif(is_float($avar)) echo "$indent$var_name = <span style='color:#666666'>$type(".strlen($avar).")</span> $type_color".htmlentities($avar)."</span><br>";
        elseif(is_bool($avar)) echo "$indent$var_name = <span style='color:#666666'>$type(".strlen($avar).")</span> $type_color".($avar == 1 ? "TRUE":"FALSE")."</span><br>";
        elseif(is_null($avar)) echo "$indent$var_name = <span style='color:#666666'>$type(".strlen($avar).")</span> {$type_color}NULL</span><br>";
        else echo "$indent$var_name = <span style='color:#666666'>$type(".strlen($avar).")</span> ".htmlentities($avar)."<br>";

        $var = $var[$keyvar];
    }
    
    echo "</div>";
}
function toArray($resultado)
{ //global $registros;
        while ($fila = mysql_fetch_array($resultado, MYSQL_NUM))
        {
                $registros[] = $fila[0];
        }
        return $registros;
}
function toArray2($resultado)
{ //global $registros;
        while ($fila = mysql_fetch_array($resultado))
        {
                $registros[] = $fila;
        }
        return $registros;
}
function db_connect ()
{
	@ $db = mysql_pconnect("localhost","root","");
if (!$db)
{
	echo "no se puede realizar la conexion a la base de datos";
	exit;
	}

$select_db = mysql_select_db ("we");
if (!$select_db)
echo "no hemos encontrado la base de datos................";
	}