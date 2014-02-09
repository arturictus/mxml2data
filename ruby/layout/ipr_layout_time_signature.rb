module IprLayoutTimeSignature
  def check_t_s
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
  end
end