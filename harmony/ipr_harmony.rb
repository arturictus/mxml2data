module IprHarmony
  include IpmHarmonyDef
  include IpmHarmonyRoot
  include IpmHarmonyTensions
  def extract_chords
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
    
  end
  def self.convert_chord(ch){
  
      #_____ROOT alterator
      ch = root_alterator(ch)
      
      # Changed Bass_____________________
      ch = changed_bass(ch)
  
      #DEFs_____________________________
      ch = definitions(ch)
      
      #tensions
      ch = tensions(ch)
      return ch
  
  end #end of convert_chord
end