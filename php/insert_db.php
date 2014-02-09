<?php
require_once 'extractxml.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of insert_db
 *
 * @author artur
 */
class insert_db extends extract_xml{
  const admin_user=550;  
  const prefix="lhkvr_";
  private $database="xmltry";
  //private $database="impromastering_mdb0030";
  public $autors_table="impromastering_lickautors";
  public $title_table='impromastering_titletemas';
  
  
  public function Set_prefix($table){
      $prefix_table=self::prefix.$table;
      return $prefix_table;
  }
    

public function insert_compositores(){
    
    $table=$this->Set_prefix($this->autors_table);
    
    $this->get_all_compositors();
   // connect to the "tests" database
        $conn = new mysqli("localhost","artur","5BaG4WhZi1");

        // check connection
        if (mysqli_connect_errno()) {
          exit('Connect failed: '. mysqli_connect_error());
        }
/////DROP TABLE--------------------------------------------------------        
            $drop="DROP TABLE IF EXISTS `$this->database`.`$table`";
            if ($conn->query($drop) === TRUE) {
                  echo  "DROP table <strong>OK</strong><br/>";
                }
            else{
            echo "DROP table has <strong>FAIL</strong><br/>";
            exit;
            }
        
//CREATE TABLE________________________________________________________
//
       $create=" CREATE TABLE IF NOT EXISTS `$this->database`.`$table` (
	`id` int(11) NOT NULL auto_increment,
	`params` text NOT NULL DEFAULT '',
	`autor` VARCHAR(255) NOT NULL ,
	`instrumento` INT(11) ,
	`hits` INT(11) NOT NULL DEFAULT 0 ,
	`created_by` INT(11) ,

	PRIMARY KEY  (`id`),
	UNIQUE(autor)
        )";
       
       if ($conn->query($create) === TRUE) {
                  echo  "CREATE table <strong>OK</strong><br/>";
                }
            else{
            echo "CREATE table has <strong>FAIL</strong><br/>";
            exit;
            }
        // sql query for INSERT INTO users
        foreach($this->compositores as $value){
        $sql="INSERT INTO `$this->database`.`$table` 
            (`id`, `params`, `autor`, `instrumento`, `hits`, `created_by`) 
            VALUES (NULL, '', '".
                $conn->escape_string($value)
                ."', NULL, '0', '".self::admin_user."')";

            // Performs the $sql query on the server to insert the values
            if ($conn->query($sql) === TRUE) {
              echo $value.' saved successfully <br/>';
            }
            else {
             echo $value.'Error: '. $conn->error.'<br/>';
            }
        }
        $conn->close();
    }
    
public function insert_titles(){
    
   // $this->insert_compositores();
    $table=$this->Set_prefix($this->title_table);
    $this->get_all_compositors();
    $this->get_all_titles();
   // connect to the "tests" database
        $conn = new mysqli("localhost","artur","5BaG4WhZi1");

        // check connection
        if (mysqli_connect_errno()) {
          exit('Connect failed: '. mysqli_connect_error());
        }
/////DROP TABLE--------------------------------------------------------        
            $drop="DROP TABLE IF EXISTS `$this->database`.`$table`";
            if ($conn->query($drop) === TRUE) {
                  echo  "DROP table <strong>OK</strong><br/>";
                }
            else{
            echo "DROP table has <strong>FAIL</strong><br/>";
            exit;
            }
        
//CREATE TABLE________________________________________________________
//
       
       $create=" CREATE TABLE IF NOT EXISTS `$this->database`.`$table` (
	`id` int(11) NOT NULL auto_increment,
	`params` text NOT NULL DEFAULT '',
	`titulo` VARCHAR(255) NOT NULL ,
	`compositor` INT(11) ,

	PRIMARY KEY  (`id`),
	UNIQUE(titulo)
        )";
       
       if ($conn->query($create) === TRUE) {
                  echo  "CREATE table <strong>OK</strong><br/>";
                }
            else{
            echo "CREATE table has <strong>FAIL</strong><br/>";
            exit;
            }
        $autors_t=  $this->Set_prefix($this->autors_table);    
        // sql query for INSERT INTO users
        foreach($this->titles as $value){
            //look for the autor id
            $search="SELECT `id`
            FROM  `$this->database`.`$autors_t` 
            WHERE  `autor` LIKE  '".
                    $conn->escape_string($value['compositor'])
                    ."'";
            $result=$conn->query($search);
            if($result===false){
                echo "<hr/><br/>".$value['compositor']."   <strong>FAIL</strong><br/><hr/>";
            continue;}
            $row = $result->fetch_array(MYSQLI_ASSOC);
            //do_dump($row);
           
            
         
        $sql="INSERT INTO `$this->database`.`$table` 
            (`id`, `params`, `titulo`, `compositor`) 
            VALUES (NULL, '', '".
               $conn->escape_string($value['title'])
                ."', '".$row['id']."')";

            // Performs the $sql query on the server to insert the values
            if ($conn->query($sql) === TRUE) {
              echo $value['title'].' saved successfully <br/>';
            }
            else {
             echo $value['title'].'Error: '. $conn->error.'<br/>';
            }
          
        }
        $conn->close();
    
    }    
    
public function insert_tonalidades(){
    $table="impromastering_tonalidades";
    
    $tonalidades=array("C",
                        "F",
                        "Bb",
                        "Eb",
                        "Ab",
                        "Db",
                        "Gb",
                        "G",
                        "D",
                        "A",
                        "E",
                        "B",
                        "F#",
                        "C#");
       $table=$this->Set_prefix($table);
    
   
   // connect to the "tests" database
        $conn = new mysqli("localhost","artur","5BaG4WhZi1");

        // check connection
        if (mysqli_connect_errno()) {
          exit('Connect failed: '. mysqli_connect_error());
        }
/////DROP TABLE--------------------------------------------------------        
            $drop="DROP TABLE IF EXISTS `$this->database`.`$table`";
            if ($conn->query($drop) === TRUE) {
                  echo  "DROP table <strong>OK</strong><br/>";
                }
            else{
            echo "DROP table has <strong>FAIL</strong><br/>";
            exit;
            }
        
//CREATE TABLE________________________________________________________
//
       $create=" CREATE TABLE IF NOT EXISTS `$this->database`.`$table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `params` text NOT NULL,
  `tonalidades` varchar(2) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tonalidades` (`tonalidades`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;";
       
       if ($conn->query($create) === TRUE) {
                  echo  "CREATE table <strong>OK</strong><br/>";
                }
            else{
            echo "CREATE table has <strong>FAIL</strong><br/>";
            exit;
            }
        // sql query for INSERT INTO users
        foreach($tonalidades as $value){
            $sql="INSERT INTO `$this->database`.`$table` 
                    (`id`, `params`, `tonalidades`, `created_by`, `hits`) 
                    VALUES (NULL, '', '".$conn->escape_string($value)."', '".self::admin_user."', '0')";

            // Performs the $sql query on the server to insert the values
            if ($conn->query($sql) === TRUE) {
              echo $value.' saved successfully <br/>';
            }
            else {
             echo $value.'Error: '. $conn->error.'<br/>';
            }
        }
        $conn->close();
    }
    
public function insert_time_sig(){
    $table="impromastering_timesignatures";
    $t_sig=$this->Get_all_time_sig();
  
       $table=$this->Set_prefix($table);
    
   
   // connect to the "tests" database
        $conn = new mysqli("localhost","artur","5BaG4WhZi1");

        // check connection
        if (mysqli_connect_errno()) {
          exit('Connect failed: '. mysqli_connect_error());
        }
/////DROP TABLE--------------------------------------------------------        
            $drop="DROP TABLE IF EXISTS `$this->database`.`$table`";
            if ($conn->query($drop) === TRUE) {
                  echo  "DROP table <strong>OK</strong><br/>";
                }
            else{
            echo "DROP table has <strong>FAIL</strong><br/>";
            exit;
            }
        
//CREATE TABLE________________________________________________________

       $create="CREATE TABLE IF NOT EXISTS `$this->database`.`$table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `params` text NOT NULL,
  `time_signature` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ";     
      
       if ($conn->query($create) === TRUE) {
                  echo  "CREATE table <strong>OK</strong><br/>";
                }
            else{
            echo "CREATE table has <strong>FAIL</strong><br/>";
            exit;
            }
        // sql query for INSERT INTO users
        foreach($t_sig as $value){
            
            $sql="INSERT INTO `$this->database`.`$table` 
                (`id`, `params`, `time_signature`) 
                VALUES (NULL, '', '".$conn->escape_string($value)."')";

            // Performs the $sql query on the server to insert the values
            if ($conn->query($sql) === TRUE) {
              echo $value.' saved successfully <br/>';
            }
            else {
             echo $value.'Error: '. $conn->error.'<br/>';
            }
        }
        $conn->close();
    
    
}

public function insert_styles(){
    
     $table=$this->Set_prefix("impromastering_estilos");
    
    $this->get_all_styles();
   // connect to the "tests" database
        $conn = new mysqli("localhost","artur","5BaG4WhZi1");

        // check connection
        if (mysqli_connect_errno()) {
          exit('Connect failed: '. mysqli_connect_error());
        }
/////DROP TABLE--------------------------------------------------------        
            $drop="DROP TABLE IF EXISTS `$this->database`.`$table`";
            if ($conn->query($drop) === TRUE) {
                  echo  "DROP table <strong>OK</strong><br/>";
                }
            else{
            echo "DROP table has <strong>FAIL</strong><br/>";
            exit;
            }
        
//CREATE TABLE________________________________________________________
//
      
       $create="CREATE TABLE IF NOT EXISTS `$this->database`.`$table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `params` text NOT NULL,
  `estilos` varchar(20) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `estilos` (`estilos`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ";
       
       if ($conn->query($create) === TRUE) {
                  echo  "CREATE table <strong>OK</strong><br/>";
                }
            else{
            echo "CREATE table has <strong>FAIL</strong><br/>";
            exit;
            }
        // sql query for INSERT INTO users
        foreach($this->styles as $value){
        
        $sql="INSERT INTO `$this->database`.`$table` 
                (`id`, `params`, `estilos`, `created_by`, `hits`) 
                VALUES (NULL, '', '".
                $conn->escape_string($value)
                ."', '".self::admin_user."', '0')";

            // Performs the $sql query on the server to insert the values
            if ($conn->query($sql) === TRUE) {
              echo $value.' saved successfully <br/>';
            }
            else {
             echo $value.'Error: '. $conn->error.'<br/>';
            }
        }
        $conn->close();
    
    
}

public function insert_modos(){
   $modos=array("major", "minor");
   // connect to the "tests" database
        $conn = new mysqli("localhost","artur","5BaG4WhZi1");

        // check connection
        if (mysqli_connect_errno()) {
          exit('Connect failed: '. mysqli_connect_error());
        }
/////DROP TABLE--------------------------------------------------------        
            $drop="DROP TABLE IF EXISTS `$this->database`.`lhkvr_impromastering_modos`";
            if ($conn->query($drop) === TRUE) {
                  echo  "DROP table <strong>OK</strong><br/>";
                }
            else{
            echo "DROP table has <strong>FAIL</strong><br/>";
            exit;
            }
        
//CREATE TABLE________________________________________________________
//
      
       $create="CREATE TABLE IF NOT EXISTS `$this->database`.`lhkvr_impromastering_modos` (
	`id` int(11) NOT NULL auto_increment,
	`params` text NOT NULL DEFAULT '',
	`modos` VARCHAR(20) NOT NULL ,
	`created_by` INT(11) ,
	`hits` INT(11) NOT NULL DEFAULT 0 ,

	PRIMARY KEY  (`id`),
	UNIQUE(modos)
); ";
       
       if ($conn->query($create) === TRUE) {
                  echo  "CREATE table <strong>OK</strong><br/>";
                }
            else{
            echo "CREATE table has <strong>FAIL</strong><br/>";
            exit;
            }
        // sql query for INSERT INTO users
        foreach($modos as $value){
        
       /* $sql="INSERT INTO `$this->database`.`$table` 
                (`id`, `params`, `estilos`, `created_by`, `hits`) 
                VALUES (NULL, '', '".
                $conn->escape_string($value)
                ."', '".self::admin_user."', '0')";*/
        $sql="INSERT INTO  `$this->database`.`lhkvr_impromastering_modos` (
            `id` ,
            `params` ,
            `modos` ,
            `created_by` ,
            `hits`
            )
            VALUES (
            NULL ,  '',  '".
                $conn->escape_string($value)
                ."', '".self::admin_user."' ,  '0'
            );";

            // Performs the $sql query on the server to insert the values
            if ($conn->query($sql) === TRUE) {
              echo $value.' saved successfully <br/>';
            }
            else {
             echo $value.'Error: '. $conn->error.'<br/>';
            }
        }
        $conn->close();
    
    
}

public function insert_tune($file){
    $errors=array();
    $errors['int']=0;
    $t=$this->generate_Array($file);
    
    $conn = new mysqli("localhost","artur","5BaG4WhZi1");

        // check connection
        if (mysqli_connect_errno()) {
          exit('Connect failed: '. mysqli_connect_error());
        }
     //buscar Título   
    $sql = "SELECT `id` FROM `$this->database`.`lhkvr_impromastering_titletemas` 
        WHERE `titulo` LIKE '".$conn->escape_string($t['title'])."' ";
   $result=$conn->query($sql);
            if($result===false){
                $errors[]= "<hr/><br/>searching  title:".$t['title']."   <strong>FAIL</strong><br/><hr/>";
                $errors['int']+=1;
            }
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $db['title']=$row['id'];
     //buscar tonalidad
        $sql = "SELECT `id` FROM `$this->database`.`lhkvr_impromastering_tonalidades` 
        WHERE `tonalidades` LIKE  '".$t['tonalidad']."' ";
   $result=$conn->query($sql);
            if($result===false){
                $errors[]= "<hr/><br/>searching  tonalidad:".$t['tonalidad']."   <strong>FAIL</strong><br/><hr/>";
                $errors['int']+=1;
            }
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $db['tonalidad']=$row['id'];
     //Modo
             $sql = "SELECT `id` FROM `$this->database`.`lhkvr_impromastering_modos` 
        WHERE `modos` LIKE  '".$t['modo']."' ";
           
   $result=$conn->query($sql);
            if($result===false){
                $errors[]= "<hr/><br/>searching  modo:".$t['modo']."   <strong>FAIL</strong><br/><hr/>";
                $errors['int']+=1;
            }
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $db['modo']=$row['id'];
     //Estilo
            $sql = "SELECT `id` FROM `$this->database`.`lhkvr_impromastering_estilos` 
        WHERE `estilos` LIKE  '".$t['estilo']."' ";
           
   $result=$conn->query($sql);
            if($result===false){
                $errors[]= "<hr/><br/>searching  estilo:".$t['estilo']."   <strong>FAIL</strong><br/><hr/>";
                $errors['int']+=1;
            }
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $db['estilo']=$row['id'];
     //TIME SIGNATURE
     $sql = "SELECT `id` FROM `$this->database`.`lhkvr_impromastering_timesignatures` 
        WHERE `time_signature` LIKE  '".$t['time_signature']."' ";
           
   $result=$conn->query($sql);
            if($result===false){
                $errors[]= "<hr/><br/>searching  estilo:".$t['time_signature']."   <strong>FAIL</strong><br/><hr/>";
                $errors['int']+=1;
            }
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $db['time_signature']=$row['id'];
    //CHORDS
   $db['chords']= json_encode($t['chords']);
   $db['layout']=json_encode($t['layout']);  
      //inseta en la base de datos
   if($errors['int']===0){
      /*  $query="    INSERT INTO  `$this->database`.`lhkvr_impromastering_temas` (
`id` ,
`params` ,
`title` ,
`compases` ,
`tonalidad` ,
`modo` ,
`estilo` ,
`tempo` ,
`created_by` ,
`chords` ,
`fecha_de_creacion` ,
`modification_date` ,
`hits`
)
VALUES (
NULL ,  '',  '".$db['title']."',  ".count($t['chords']).",  '".$db['tonalidad']
                ."',  '".$db['modo']."',  '".$db['estilo']."', NULL ,  '"
                .self::admin_user."', '"
                .$db['chords']."' , NULL , NULL ,  '0'
)";*/
        
$query="INSERT INTO `$this->database`.`lhkvr_impromastering_temas` 
    (`id`, `params`, `title`, `compases`, `tonalidad`, `modo`, `estilo`, `tempo`, `created_by`, `tune_layout`, `chords`, `fecha_de_creacion`, `modification_date`, `hits`)
    VALUES (NULL, '', '".$db['title']."', ".count($t['chords']).", '".$db['tonalidad']
                ."', '".$db['modo']."', '".$db['estilo']."', NULL, '"
                .self::admin_user."', '"
                .$db['layout']."', '"
                .$db['chords']."', NULL, NULL, '0');";
        if ($conn->query($query) === TRUE) {
              echo $t['title'].' saved successfully <br/>';
            }
            else {
             echo $t['title'].' SQL Error: '. $conn->error.'<br/>';
            }

   }     
   
   else{
       
       echo "<strong style=\"color:red;\">".$t['title']."</strong>No se ha podido introducir por los siguientes fallos<br/>";
               foreach($errors as $value){
           echo "errores= ".$value."<br/>";
               }
   }
            
     //devuelve ___________________________  
            
            $db['errors']=$errors;
            return $db;
}

public function insert_all_tunes(){
     $conn = new mysqli("localhost","artur","5BaG4WhZi1");

        // check connection
        if (mysqli_connect_errno()) {
          exit('Connect failed: '. mysqli_connect_error());
        }
        
     $drop="DROP TABLE IF EXISTS `$this->database`.`lhkvr_impromastering_temas`";
            if ($conn->query($drop) === TRUE) {
                  echo  "DROP table <strong>OK</strong><br/>";
                }
            else{
            echo "DROP table has <strong>FAIL</strong><br/>";
            exit;
            }
            
      //CREATE TABLE________________________________________________________
//
      
    
       $create="CREATE TABLE IF NOT EXISTS `$this->database`.`lhkvr_impromastering_temas` (
	`id` int(11) NOT NULL auto_increment,
	`params` text NOT NULL DEFAULT '',
	`title` INT(11) NOT NULL ,
	`compases` INT(11) NOT NULL DEFAULT 32 ,
	`tonalidad` INT(11) NOT NULL ,
	`modo` INT(11) ,
	`estilo` INT(11) ,
	`tempo` INT(11) ,
	`created_by` INT(11) ,
	`tune_layout` TEXT ,
	`chords` TEXT ,
	`fecha_de_creacion` DATE ,
	`modification_date` DATE ,
	`hits` INT(11) NOT NULL DEFAULT 0 ,

	PRIMARY KEY  (`id`)
);";
       
       if ($conn->query($create) === TRUE) {
                  echo  "CREATE table <strong>OK</strong><br/>";
                }
            else{
            echo "CREATE table has <strong>FAIL</strong><br/>";
            exit;
            }      
    foreach($this->files_array as $value){
        
        $this->insert_tune($value);
    }
   $conn->close(); 
}
}

?>
