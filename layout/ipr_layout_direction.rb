module IprLayoutDirection
  def check_direction
    if($check_direction===true){
    if (isset($mesure['direction'])){
        $num_compas=$mesure['@attributes']['number'];
        
            $af_mes=$num_compas;
        $et['layout']['affec_mes'][]=$af_mes;
        $et['layout']['elements'][$num_compas]['direction']=$cl_lay->clean_direction($mesure['direction']);
        
    }
    }
  end
end
  