module IprLayoutNewSystem
  def check_new_system
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
  end
end