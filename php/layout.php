<?php

require_once 'requires.php';
class layout{
   
    public function clean_barline($barline){
       // $this->bars[]=  json_encode($barline);
        $eso=true;
        if($eso===true){
        if (isset($barline[0])){
            foreach($barline as $arbar){
                $recursive=false;
              if($recursive===false){
                if(json_encode($arbar)==='{"@attributes":{"location":"left"},"bar-style":"heavy-light","repeat":{"@attributes":{"direction":"forward"}}}'){
                    $half['forward']="forward";
                    unset($arbar['repeat']);
                    unset($arbar['bar-style']);
                    unset($arbar['@attributes']);
                }
                if(json_encode($arbar)==='{"@attributes":{"location":"right"},"bar-style":"light-heavy","repeat":{"@attributes":{"direction":"backward"}}}'){
                    $half['backward']="backward";
                    unset($arbar['repeat']);
                    unset($arbar['bar-style']);
                    unset($arbar['@attributes']);
                }
                if(json_encode($arbar)==='{"@attributes":{"location":"left"},"bar-style":"light-light"}'){
                    $half['light-light_left']="light-light";
                    //unset($barline['repeat']);
                    unset($arbar['bar-style']);
                    unset($arbar['@attributes']);
                }
                if(json_encode($arbar)==='{"@attributes":{"location":"right"},"bar-style":"light-light"}'){
                    $half['light-light_right']="light-light";
                    //unset($barline['repeat']);
                    unset($arbar['bar-style']);
                    unset($arbar['@attributes']);
                }
                if(json_encode($arbar)==='{"@attributes":{"location":"right"},"bar-style":"light-heavy"}'){
                    $half['light-heavy']="light-heavy";
                    //unset($barline['repeat']);
                    unset($arbar['bar-style']);
                    unset($arbar['@attributes']);
                }
            }
            if($recursive===true){
                $half[]=$this->clean_barline($arbar);
            }
                }
            //unset($barline);
            $barline=$half;
            unset($half);
        }
        else{
            
        if(json_encode($barline)==='{"@attributes":{"location":"left"},"bar-style":"heavy-light","repeat":{"@attributes":{"direction":"forward"}}}'){
            $barline['forward']="forward";
            unset($barline['repeat']);
            unset($barline['bar-style']);
            unset($barline['@attributes']);
        }
        if(json_encode($barline)==='{"@attributes":{"location":"right"},"bar-style":"light-heavy","repeat":{"@attributes":{"direction":"backward"}}}'){
            $barline['backward']="backward";
            unset($barline['repeat']);
            unset($barline['bar-style']);
            unset($barline['@attributes']);
        }
        if(json_encode($barline)==='{"@attributes":{"location":"left"},"bar-style":"light-light"}'){
            $barline['light-light_left']="light-light";
            //unset($barline['repeat']);
            unset($barline['bar-style']);
            unset($barline['@attributes']);
        }
        if(json_encode($barline)==='{"@attributes":{"location":"right"},"bar-style":"light-light"}'){
            $barline['light-light_right']="light-light";
            //unset($barline['repeat']);
            unset($barline['bar-style']);
            unset($barline['@attributes']);
        }
        if(json_encode($barline)==='{"@attributes":{"location":"right"},"bar-style":"light-heavy"}'){
            $barline['light-heavy']="light-heavy";
            //unset($barline['repeat']);
            unset($barline['bar-style']);
            unset($barline['@attributes']);
        }
        
        }
        
        }
        return $barline;
    }
    public function clean_direction($direction) {
        $do=true;
        if($do===true){
        if(isset($direction[0])){
            foreach($direction as $ardir){
                if(isset($ardir['direction-type']['coda'])){
            $coda="coda";
            unset($ardir['direction-type']);
            unset($ardir['@attributes']);
            //return $coda['coda']="yes";
            }
        if (isset($ardir['direction-type']['rehearsal'])){
            
            $rehearsal=$ardir['direction-type']['rehearsal'];
            unset($ardir['direction-type']);
            unset($ardir['@attributes']);
            }
        if (isset($ardir['direction-type']['words'])){
            
            $words=$ardir['direction-type']['words'];
            unset($ardir['direction-type']);
            unset($ardir['@attributes']);
            }
        if (isset($ardir['direction-type']['segno'])){
            
            $ardir['segno']="segno" ;
            unset($ardir['direction-type']);
            unset($ardir['@attributes']);
            }
            }
            $direction=$ardir;
            unset($ardir);
            
            unset($half);
            
        }
        else{
        if(isset($direction['direction-type']['coda'])){
            $coda="coda";
            unset($direction['direction-type']);
            unset($direction['@attributes']);
            //return $coda['coda']="yes";
            }
        if (isset($direction['direction-type']['rehearsal'])){
            
            $rehearsal=$direction['direction-type']['rehearsal'];
            unset($direction['direction-type']);
            unset($direction['@attributes']);
            }
        if (isset($direction['direction-type']['words'])){
            
            $words=$direction['direction-type']['words'];
            unset($direction['direction-type']);
            unset($direction['@attributes']);
            }
        if (isset($direction['direction-type']['segno'])){
            
            $direction['segno']="segno" ;
            unset($direction['direction-type']);
            unset($direction['@attributes']);
            }
        }
        if($coda) $direction['coda']=$coda;
         if($rehearsal) $direction['rehearsal']=$rehearsal;
          if($words) $direction['words']=$words;
        }
           
        return $direction;
    }
    
    function clean_it_all($layout){
        
        foreach($layout['elements'] as $compases){
            
            if($compases['extras']){
                if($compases['extras'][0]){
                    foreach($compases['extras'] as $half){
                        if($half['coda']){
                            $compases['coda']="yes";
                        }
                    }
                }
                else{}
            }
            $layout['elements'][]=$compases;
        }
        
        return $layout;
    }
}

?>
