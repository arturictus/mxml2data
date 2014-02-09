module IprLayoutBarline
  def check_barline
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
  end
end