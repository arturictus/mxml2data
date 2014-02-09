module IprLayoutBoxes
  def check_boxes(mesure, master )
  if (mesure['barline'][0]['ending'] rescue false)
   
      num_compas=mesure['number']
      af_mes=num_compas
      master[:layout]<< { :affec_mes => []}
      master[:layout][:affec_mes]<< "#{af_mes}"
      if (swi_if_ending(mesure['barline']))
           #layout['number']=num_compas
           layout['box']=mesure['barline'][0]['ending']['@attributes']['number']
           master['layout']['elements'][num_compas]=layout
           unset(layout)
           unset(mesure['barline'])
      end
      if (mesure['barline'][0]['bar-style'] && mesure['barline'][1]['bar-style'])
           unset(mesure['barline'][0]['ending'])
              unset(mesure['barline'][1]['ending'])
      end
      if (mesure['barline'][0]['bar-style'] || mesure['barline'][1]['bar-style'])
        if(mesure['barline'][0]['bar-style'])
          layout['box']=mesure['barline'][0]['ending']['@attributes']['number']
          master['layout']['elements'][num_compas]=layout
          unset(mesure['barline'][0]['ending'])
          unset(mesure['barline'][1]['ending'])
          if(json_encode(mesure['barline'][1])==='{"@attributes":{"location":"right"}}')
              mesure['barline']=mesure['barline'][0]
          end
        end
        if(mesure['barline'][1]['bar-style'])
          layout['box']=mesure['barline'][0]['ending']['@attributes']['number']
          master['layout']['elements'][num_compas]=layout
          unset(mesure['barline'][0]['ending'])
          unset(mesure['barline'][1]['ending'])
          if(json_encode(mesure['barline'][0])==='{"@attributes":{"location":"left"}}')
            mesure['barline']=mesure['barline'][1]
          end
        end
      end
     #if(isset(layout))unset(layout);
   end
  end# end check_boxes
  def swi_if_ending(barline)
    output = case barline.to_json
    when '[{"@attributes":{"location":"right"},"ending":{"@attributes":{"type":"discontinue","number":"1"}}},{"@attributes":{"location":"left"},"ending":{"@attributes":{"type":"start","number":"1"}}}]'
      then true
    when '[{"@attributes":{"location":"right"},"ending":{"@attributes":{"type":"discontinue","number":"2"}}},{"@attributes":{"location":"left"},"ending":{"@attributes":{"type":"start","number":"2"}}}]'
      then true
    when '[{"@attributes":{"location":"right"},"ending":{"@attributes":{"type":"discontinue","number":"3"}}},{"@attributes":{"location":"left"},"ending":{"@attributes":{"type":"start","number":"3"}}}]'
      then true
    when '[{"@attributes":{"location":"right"},"ending":{"@attributes":{"type":"discontinue","number":"4"}}},{"@attributes":{"location":"left"},"ending":{"@attributes":{"type":"start","number":"4"}}}]'
      then true
    when '[{"@attributes":{"location":"right"},"ending":{"@attributes":{"type":"discontinue","number":"5"}}},{"@attributes":{"location":"left"},"ending":{"@attributes":{"type":"start","number":"5"}}}]'
      then true
    else
      false
    end
    output
  end
end
# if($check_boxes===true){
# if (isset($mesure['barline'][0]['ending'])){
#     $num_compas=$mesure['@attributes']['number'];
#        $af_mes=$num_compas;
#        $et['layout']['affec_mes'][]=$af_mes;
#     if (json_encode($mesure['barline'])==='[{"@attributes":{"location":"right"},"ending":{"@attributes":{"type":"discontinue","number":"1"}}},{"@attributes":{"location":"left"},"ending":{"@attributes":{"type":"start","number":"1"}}}]'
#         || json_encode($mesure['barline'])==='[{"@attributes":{"location":"right"},"ending":{"@attributes":{"type":"discontinue","number":"2"}}},{"@attributes":{"location":"left"},"ending":{"@attributes":{"type":"start","number":"2"}}}]'
#         || json_encode($mesure['barline'])==='[{"@attributes":{"location":"right"},"ending":{"@attributes":{"type":"discontinue","number":"3"}}},{"@attributes":{"location":"left"},"ending":{"@attributes":{"type":"start","number":"3"}}}]'
#         || json_encode($mesure['barline'])==='[{"@attributes":{"location":"right"},"ending":{"@attributes":{"type":"discontinue","number":"4"}}},{"@attributes":{"location":"left"},"ending":{"@attributes":{"type":"start","number":"4"}}}]'
#         || json_encode($mesure['barline'])==='[{"@attributes":{"location":"right"},"ending":{"@attributes":{"type":"discontinue","number":"5"}}},{"@attributes":{"location":"left"},"ending":{"@attributes":{"type":"start","number":"5"}}}]'
#             ){
#         
#        //$layout['number']=$num_compas;
#        $layout['box']=$mesure['barline'][0]['ending']['@attributes']['number'];
#        $et['layout']['elements'][$num_compas]=$layout;
#        unset($layout);
#        unset($mesure['barline']);
#         }
#     if ($mesure['barline'][0]['bar-style'] && $mesure['barline'][1]['bar-style']){
#          unset($mesure['barline'][0]['ending']);
#             unset($mesure['barline'][1]['ending']);
#     }
#     if ($mesure['barline'][0]['bar-style'] || $mesure['barline'][1]['bar-style']){
#         if($mesure['barline'][0]['bar-style']){
#             $layout['box']=$mesure['barline'][0]['ending']['@attributes']['number'];
#             $et['layout']['elements'][$num_compas]=$layout;
#             unset($mesure['barline'][0]['ending']);
#             unset($mesure['barline'][1]['ending']);
#             if(json_encode($mesure['barline'][1])==='{"@attributes":{"location":"right"}}'){
#                 $mesure['barline']=$mesure['barline'][0];
#                 }
#             }
#         if($mesure['barline'][1]['bar-style']){
#             $layout['box']=$mesure['barline'][0]['ending']['@attributes']['number'];
#             $et['layout']['elements'][$num_compas]=$layout;
#             unset($mesure['barline'][0]['ending']);
#             unset($mesure['barline'][1]['ending']);
#             if(json_encode($mesure['barline'][0])==='{"@attributes":{"location":"left"}}'){
#                 $mesure['barline']=$mesure['barline'][1];
#                 }
#             }
#         }
#     //if(isset($layout))unset($layout);
# }}