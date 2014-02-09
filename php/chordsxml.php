<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of chordsxml
 *
 * @author artur
 */
class chordsxml {
    
    
    
public function convert_chord($ch){
    
    ////////ROOT aler
    switch ($ch['root_alter']){
        case "0":
            unset($ch['root_alter']);
            break;
        case "1":
            $ch['root'].="#";
            unset($ch['root_alter']);
            break;
        case "-1":
            $ch['root'].="b";
            unset($ch['root_alter']);
            break;
        default :
            $ch['root_alter'].="NOT FOUND";
            break;
    }
    
    if($ch['alter_bass']){
        
        $b_alter=$ch['alter_bass']['bass-alter'];
        switch ($b_alter){
        case "0":
            $ch['alter_bass']=$ch['alter_bass']['bass-step'];
            //unset($ch['root_alter']);
            break;
        case "1":
            $ch['alter_bass']=$ch['alter_bass']['bass-step']."#";
           // unset($ch['root_alter']);
            break;
        case "-1":
            $ch['alter_bass']=$ch['alter_bass']['bass-step']."b";
            //unset($ch['root_alter']);
            break;
        default :
            $ch['alter_bass']=$ch['alter_bass']['bass-step'];
            break;
    }
        
    }
    
    //DEFs_____________________________
     switch ($ch['def']){
        case  "major":
            if(
               $ch['tensions']['degree-alter'] ==  "0" &&
                $ch['tensions']['degree-type'] == "add"){
                $ch['def']="add".$ch['tensions']['degree-value'];
                unset($ch['tensions']);
                }
            else
                $ch['def']="";
            break;
        case  "major-seventh":
            $ch['def']="Maj7";
            break;
        case "major-sixth":
            $ch['def']="6";
            break;
        case "augmented":
            $ch['def']="aug";
            break;
        
        case "major-ninth":
            $ch['def']="Maj7";
            
            $ch['tensions']=  $this->add_tensions($ch, "9");
            break;
        case is_array($ch['def']):
            $ch['def']="7alt";
            break;
        case "dominant":
            
            $ch['def']="7";
            break;
        case "dominant-ninth":
            
            $ch['def']="7";
            $ch['tensions']=$this->add_tensions($ch, "9");
            //$convert_tensions= False;
            break;
        case "dominant-13th":
            $ch['def']="7";
            $ch['tensions']= $this-> add_tensions($ch, "9");
            $ch['tensions']= $this-> add_tensions($ch, "13");
            break;
        case "dominant-11th":
            $ch['def']="7sus";
            break;
        case "minor-seventh":
            if($ch['tensions']['degree-value']==="5"
                    &&$ch['tensions']['degree-alter']==="-1"
                    &&$ch['tensions']['degree-type']==="alter"){
                    $ch['def']="-7b5";
                    unset($ch['tensions']);
                    }
            else        
            $ch['def']="-7";
            break;
        
        case "suspended-fourth":
            if($ch['tensions']['degree-value']==="7"
                    &&$ch['tensions']['degree-alter']==="0"
                    &&$ch['tensions']['degree-type']==="add"){
                    $ch['def']="7sus";
                    unset($ch['tensions']);
                    }
            else 
                $ch['def'].="NOT FOUND";
            break;
        case "minor":
            $ch['def']="-";
            break;
        case "minor-ninth":
            $ch['def']="-7";
            $ch['tensions']= $this-> add_tensions($ch, "9");    
            break;
        case "minor-sixth":
            $ch['def']="-6";
            break;
        case "minor-11th":
            $ch['def']="-7";
            $ch['tensions']=  $this->add_tensions($ch, "9");
            $ch['tensions']=  $this->add_tensions($ch, "11");
            break;
        case "diminished":
            $ch['def']="dim";
            break;
        case "diminished-seventh":
            $ch['def']="dim7";
            break;
        default :
        
            break;
    }
    
    if ($ch['tensions']&&$convert_tensions!==False)
               {  
        if($ch['tensions'][0]){
            foreach($ch['tensions'] as $mul_tensions){
                if($mul_tensions['degree-type']!=="subtract")
                $more[]= $this->convert_tensions($mul_tensions);
                
            }
            $ch['tensions']=$more;
        }
        else{
            if($mul_tensions['degree-type']!=="subtract")
        $ch['tensions']=  $this->convert_tensions($ch['tensions']);
        
        }
        
               }
   // if(isset($convert_tensions))
  //  unset($convert_tensions);   
           
    return $ch;
    
}

public function convert_tensions($tensions){
    
    
        $ret;
        switch ($tensions['degree-alter']){
            case"0":
                break;
            case "1":
                $ret.="#";
                break;
            case"-1":
                $ret.="b";
                break;
            default :
                $ret.="NOT FOUND";
                break;
        }
        
         $ret.= $tensions['degree-value']; 
         if($ret=="#7")
    $ret="Maj7";
         if($ret=="4")
             $ret="sus4";
    return $ret;
    
    
    
}

public function add_tensions($ch,$tens){
    
        if ($ch['tensions']){
            if($ch['tensions'][0])
            {
                   $newtens=array();
                   foreach($ch['tensions']as $chtens){
                   $newtens[]=$chtens;}
            $newtens[]= $this-> swi_add_tens($tens); 
               // $ch['tensions'][]
            }
            else{    
                $newtens=array();
            $newtens[]=$ch['tensions'];
            $newtens[]= $this-> swi_add_tens($tens);
            }

        }

        else {

            $newtens=  $this->swi_add_tens($tens);
        }
    return $newtens;
    }
    
  public  function swi_add_tens($tens){
        
        
        switch ($tens){
                case "b9":
                    $ar=array('degree-value'=>"9",
                        'degree-alter'=>"-1",
                        'degree-type'=>"add");
                    break;
                case "9":
                    $ar=array('degree-value'=>"9",
                        'degree-alter'=>"0",
                        'degree-type'=>"add");
                    break;
                case "#9":
                    $ar=array('degree-value'=>"9",
                        'degree-alter'=>"1",
                        'degree-type'=>"add");
                    break;
                case "11":
                    $ar=array('degree-value'=>"11",
                        'degree-alter'=>"0",
                        'degree-type'=>"add");
                    break;
                case "#11":
                    $ar=array('degree-value'=>"11",
                        'degree-alter'=>"1",
                        'degree-type'=>"add");
                    break;
                case "b13":
                    $ar=array('degree-value'=>"13",
                        'degree-alter'=>"-1",
                        'degree-type'=>"add");
                    break;
                 case "13":
                    $ar=array('degree-value'=>"13",
                        'degree-alter'=>"0",
                        'degree-type'=>"add");
                    break;
                }
                return $ar;
        }
    
}

?>
