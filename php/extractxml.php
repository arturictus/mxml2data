<?php
require_once 'requires.php';
class extract_xml{
    public $files_array;
    public $compositores;
    public $styles;
    public $titles;
    public $chord_example;
    public $bars;
   // public $boxes;

 public function __construct(){
        
       $this->files_array= $this->get_files_array();
       //$this->get_all_compositors();
      //  $this->get_all_styles();
       // $this->get_all_titles();
    }
    
public function original_xml_array($file){
    $xml=  simplexml_load_file($file);
    
    $json= json_encode($xml);
    //$obj=json_decode($json);
    $tema_array=json_decode($json,TRUE);
    
    return $tema_array;
    
}    
public function get_files_array($folder="./xmls/"){
    $files=$this->read_all_files($folder);
    //$this->$files_array = $files['files'];
   return $files['files'];   
}    

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
public function read_all_files($root = '.'){ 
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

public function get_all_compositors(){
    
    foreach($this->files_array as $file){
        $xml=  simplexml_load_file($file);
        $json= json_encode($xml);
        $obj=json_decode($json);
        $compositores[]= $obj->identification->creator['0'];
        
    }
    
    //$unique_comp=asort($compositores);
    $this->compositores= array_unique($compositores);
            //array_unique($unique_comp);
}  

public function get_all_styles(){
    foreach($this->files_array as $file){
        $xml=  simplexml_load_file($file);
        $json= json_encode($xml);
        $obj=json_decode($json);
        $stl[]= $obj->identification->creator['1'];
        
    }
    
    $this->styles=array_unique($stl);
    
}

public function get_all_titles(){
    foreach($this->files_array as $file){
        $xml=  simplexml_load_file($file);
        $json= json_encode($xml);
        $obj=json_decode($json);
        $tema_array=json_decode($json,TRUE);
        $stl['title']= $tema_array['movement-title'];
        $stl['compositor']= $obj->identification->creator['0'];
        $allstl[]=$stl;
        
    }
    
    $this->titles=$allstl;
    
}
public function convert_tonalidad($fiths,$modo){
    
    if($modo=="major"){
    switch ($fiths){
        case "0":
            $t="C";
        break;
        case "-1":
            $t="F";
        break;
        case "-2":
            $t="Bb";
        break;
        case "-3":
            $t="Eb";
        break;
        case "-4":
            $t="Ab";
        break;
        case "-5":
            $t="Db";
        break;
        case "-6":
            $t="Gb";
        break;
        case "-7":
            $t="Cb";
        break;
        case "1":
            $t="G";
        break;
        case "2":
            $t="D";
        break;
        case "3":
            $t="A";
        break;
        case "4":
            $t="E";
        break;
        case "5":
            $t="B";
        break;
        case "6":
            $t="F#";
        break;
        case "7":
            $t="C#";
        break;
    default :
        $t=$fiths.$modo."NOT FOUND";
        break;
    }}
    if($modo=="minor"){
        switch ($fiths){
        case "0":
            $t="A";
        break;
        case "-1":
            $t="D";
        break;
        case "-2":
            $t="G";
        break;
        case "-3":
            $t="C";
        break;
        case "-4":
            $t="F";
        break;
        case "-5":
            $t="Bb";
        break;
        case "-6":
            $t="Eb";
        break;
        case "-7":
            $t="Ab";
        break;
        case "1":
            $t="E";
        break;
        case "2":
            $t="B";
        break;
        case "3":
            $t="F#";
        break;
        case "4":
            $t="C#";
        break;
        case "5":
            $t="G#";
        break;
        case "6":
            $t="D#";
        break;
        case "7":
            $t="A#";
        break;
    default :
        $t=$fiths.$modo."NOT FOUND";
        break;
        }
        
    }
    return $t;
    
}
public function get_all_tonalidad(){
    foreach($this->files_array as $file){
        $xml=  simplexml_load_file($file);
        $json= json_encode($xml);
        $obj=json_decode($json);
        //$tema_array=json_decode($json,TRUE);
        $t= $this->convert_tonalidad($obj->part->measure['0']->attributes->key->fifths,$obj->part->measure['0']->attributes->key->mode)
                .$obj->part->measure['0']->attributes->key->mode;
        $all_t[]=$t;
    }
    
    return array_unique($all_t);
    
    
}
public function Get_all_time_sig(){
    foreach($this->files_array as $file){
        $xml=  simplexml_load_file($file);
        $json= json_encode($xml);
        $obj=json_decode($json);
        $tema_array=json_decode($json,TRUE);
        $t_s= $obj->part->measure['0']->attributes->time->beats
                ."/"
                .$tema_array['part']['measure']['0']['attributes']['time']['beat-type'];
        $all_t_s[]=$t_s;
    }
    
    return array_unique($all_t_s);
    
    
}
public function Get_all_modos(){
    foreach($this->files_array as $file){
        $xml=  simplexml_load_file($file);
        $json= json_encode($xml);
        $obj=json_decode($json);
        //$tema_array=json_decode($json,TRUE);
        $m=$obj->part->measure['0']->attributes->key->mode;
                
        $all_m[]=$m;
    }
    
    return array_unique($all_m);
    
    
}

public function generate_Array ($file){
    $return_chords_w_rhythm=false;
    $xml=  simplexml_load_file($file);
    
    $json= json_encode($xml);
    $obj=json_decode($json);
    $tema_array=json_decode($json,TRUE);
    $et['title']=$tema_array['movement-title'];
    $et['compositor']= $obj->identification->creator['0'];
    $et['estilo']= $obj->identification->creator['1'];
    $et['tonalidad']= $this->convert_tonalidad($obj->part->measure['0']->attributes->key->fifths,$obj->part->measure['0']->attributes->key->mode);
    $et['modo'] =$obj->part->measure['0']->attributes->key->mode;
    $et['beats']= $obj->part->measure['0']->attributes->time->beats;
    $et['beat_type'] =$tema_array['part']['measure']['0']['attributes']['time']['beat-type'];
    $et['time_signature']=$obj->part->measure['0']->attributes->time->beats."/".$tema_array['part']['measure']['0']['attributes']['time']['beat-type'];
    $ch=new chordsxml;
    $chords=array();
    $cl_lay=new layout;
    $et['layout']['systems']=0;

    foreach ($tema_array['part']['measure'] as $mesure) {
        $check_boxes=true;
        $check_barline=true;
        $check_new_system=true;
        $check_time=true;
        $check_direction=true;
        //mas de un acorde por compas
        if($check_boxes===true){
        if (isset($mesure['barline'][0]['ending'])){
            $num_compas=$mesure['@attributes']['number'];
               $af_mes=$num_compas;
               $et['layout']['affec_mes'][]=$af_mes;
            if (json_encode($mesure['barline'])==='[{"@attributes":{"location":"right"},"ending":{"@attributes":{"type":"discontinue","number":"1"}}},{"@attributes":{"location":"left"},"ending":{"@attributes":{"type":"start","number":"1"}}}]'
                || json_encode($mesure['barline'])==='[{"@attributes":{"location":"right"},"ending":{"@attributes":{"type":"discontinue","number":"2"}}},{"@attributes":{"location":"left"},"ending":{"@attributes":{"type":"start","number":"2"}}}]'
                || json_encode($mesure['barline'])==='[{"@attributes":{"location":"right"},"ending":{"@attributes":{"type":"discontinue","number":"3"}}},{"@attributes":{"location":"left"},"ending":{"@attributes":{"type":"start","number":"3"}}}]'
                || json_encode($mesure['barline'])==='[{"@attributes":{"location":"right"},"ending":{"@attributes":{"type":"discontinue","number":"4"}}},{"@attributes":{"location":"left"},"ending":{"@attributes":{"type":"start","number":"4"}}}]'
                || json_encode($mesure['barline'])==='[{"@attributes":{"location":"right"},"ending":{"@attributes":{"type":"discontinue","number":"5"}}},{"@attributes":{"location":"left"},"ending":{"@attributes":{"type":"start","number":"5"}}}]'
                    ){
                
               //$layout['number']=$num_compas;
               $layout['box']=$mesure['barline'][0]['ending']['@attributes']['number'];
               $et['layout']['elements'][$num_compas]=$layout;
               unset($layout);
               unset($mesure['barline']);
                }
            if ($mesure['barline'][0]['bar-style'] && $mesure['barline'][1]['bar-style']){
                 unset($mesure['barline'][0]['ending']);
                    unset($mesure['barline'][1]['ending']);
            }
            if ($mesure['barline'][0]['bar-style'] || $mesure['barline'][1]['bar-style']){
                if($mesure['barline'][0]['bar-style']){
                    $layout['box']=$mesure['barline'][0]['ending']['@attributes']['number'];
                    $et['layout']['elements'][$num_compas]=$layout;
                    unset($mesure['barline'][0]['ending']);
                    unset($mesure['barline'][1]['ending']);
                    if(json_encode($mesure['barline'][1])==='{"@attributes":{"location":"right"}}'){
                        $mesure['barline']=$mesure['barline'][0];
                        }
                    }
                if($mesure['barline'][1]['bar-style']){
                    $layout['box']=$mesure['barline'][0]['ending']['@attributes']['number'];
                    $et['layout']['elements'][$num_compas]=$layout;
                    unset($mesure['barline'][0]['ending']);
                    unset($mesure['barline'][1]['ending']);
                    if(json_encode($mesure['barline'][0])==='{"@attributes":{"location":"left"}}'){
                        $mesure['barline']=$mesure['barline'][1];
                        }
                    }
                }
            //if(isset($layout))unset($layout);
        }}
        if($check_barline===true){
            if (isset($mesure['barline'])) {
                $this->bars[]=  json_encode($mesure['barline']);
                $num_compas=$mesure['@attributes']['number'];
                $af_mes=$num_compas;
                $et['layout']['affec_mes'][]=$af_mes;
                //$layout['number']=$num_compas;
                $layout['barline']=$cl_lay->clean_barline($mesure['barline']);
                $et['layout']['elements'][$num_compas]=$layout;

                }
             if (isset($layout)){unset($layout);}
        }
       if($check_new_system===true){
            if (isset($mesure['print']['@attributes']['new-system'])) {
                $et['layout']['systems']+=1;
                $num_compas=$mesure['@attributes']['number'];
                $af_mes=$num_compas;
                $et['layout']['affec_mes'][]=$af_mes;
                //$layout['number']=$num_compas;
                $layout['new-system']=$mesure['print']['@attributes']['new-system'];
                if(isset($et['layout']['elements'][$num_compas]))

                    $et['layout']['elements'][$num_compas]['new-system']=$layout['new-system'];
                else
                $et['layout']['elements'][$num_compas]=$layout;
               // $et['layout']['affec_mes'][]=$af_mes;
            }
            if (isset($layout)){unset($layout);}       
       }
       if($check_time===true){
            if(isset($mesure['attributes']['time'])){
                $num_compas=$mesure['@attributes']['number'];
                if(isset($et['layout']['elements'][$num_compas])){
                    $af_mes=$num_compas;
                $et['layout']['affec_mes'][]=$af_mes;
                $et['layout']['elements'][$num_compas]['time']=$mesure['attributes']['time']['beats']
                        ."/".$mesure['attributes']['time']['beats']['beat-type'];}
                else{
                    $af_mes=$num_compas;
                $et['layout']['affec_mes'][]=$af_mes;
                $et['layout']['elements'][$num_compas]['time']=$mesure['attributes']['time']['beats']
                        ."/".$mesure['attributes']['time']['beats']['beat-type'];}
            }
       }
       if($check_direction===true){
       if (isset($mesure['direction'])){
           $num_compas=$mesure['@attributes']['number'];
           
               $af_mes=$num_compas;
           $et['layout']['affec_mes'][]=$af_mes;
           $et['layout']['elements'][$num_compas]['direction']=$cl_lay->clean_direction($mesure['direction']);
           
       }
       }
       
       if (isset($mesure['harmony']['0']))
           {
           foreach($mesure['harmony'] as $half){
               $chords['root']= $half['root']['root-step'];
               $chords['root_alter']=$half['root']['root-alter'];
               $chords['def']= $half['kind'];
               if(isset($half['bass']))
               $chords['alter_bass']= $half['bass'];
                
                if(isset($half['degree']))
                    $chords['tensions']=$half['degree'];
                  $chords=$ch->convert_chord($chords);
                  $half_chords[]=$chords;
                  //$this->chord_example[]=$chords;
                  unset($chords);
           }
           foreach($mesure['note'] as $half_duration){
               $half_note[]=$half_duration['type'];
           }
           $et['layout']['rhythm'][]= $half_note;


           unset($half_note);
              // $et['layout']['rhythm'][]=$half_chords;
               $acordes[]=$half_chords;
           unset($pre_acordes);
           unset($duraciones);
           unset($half_chords);
       } 
     else {
            $chords['root']= $mesure['harmony']['root']['root-step'];
            $chords['root_alter']=$mesure['harmony']['root']['root-alter'];
            $chords['def']= $mesure['harmony']['kind'];
            if(isset($mesure['harmony']['bass']))
            $chords['alter_bass']= $mesure['harmony']['bass'];
            $et['layout']['rhythm'][]= $mesure['note']['type'];
             if(isset($mesure['harmony']['degree']))
                 $chords['tensions']=$mesure['harmony']['degree'];
             $chords=$ch->convert_chord($chords);
         $acordes[]=$chords;
         //$this->chord_example[]=$chords;
          unset($chords);
         }
    }
   
    
   //$cl_lay=new layout;
    $et['layout']['affec_mes']= array_values(array_unique($et['layout']['affec_mes']));
    //$et['layout']=$cl_lay->clean_it_all($et['layout']);
    $et['chords']=$acordes;
    
    return $et;

}

public function get_all_chords($file){
    
     $xml=  simplexml_load_file($file);
    
        $json= json_encode($xml);
        $obj=json_decode($json,true);
       do_dump($obj);
     //$stl[]= $obj['kind'];
    // return $stl;
     }


}
?>

