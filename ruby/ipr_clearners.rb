module IprCleaners
  def self.clean_barline(barline){
     # this->bars[]=  json_encode(barline)
      eso=true #bypass the function
      recursive=true #use recursively
      half=[]
      if(eso===true)
          if (barline[0])
              barline.each do |arbar|
             
                # if(recursive===false)
    #                 if(json_encode(arbar)==='{"@attributes":{"location":"left"},"bar-style":"heavy-light","repeat":{"@attributes":{"direction":"forward"}}}')
    #                     half['forward']="forward"
    #                     unset(arbar['repeat'])
    #                     unset(arbar['bar-style'])
    #                     unset(arbar['@attributes'])
    #                 end
    #                 if(json_encode(arbar)==='{"@attributes":{"location":"right"},"bar-style":"light-heavy","repeat":{"@attributes":{"direction":"backward"}}}')
    #                     half['backward']="backward"
    #                     unset(arbar['repeat'])
    #                     unset(arbar['bar-style'])
    #                     unset(arbar['@attributes'])
    #                 end
    #                 if(json_encode(arbar)==='{"@attributes":{"location":"left"},"bar-style":"light-light"}')
    #                     half['light-light_left']="light-light"
    #                     #barline.delete('repeat'])
    #                     unset(arbar['bar-style'])
    #                     unset(arbar['@attributes'])
    #                 end
    #                 if(json_encode(arbar)==='{"@attributes":{"location":"right"},"bar-style":"light-light"}')
    #                     half['light-light_right']="light-light"
    #                     #barline.delete('repeat'])
    #                     unset(arbar['bar-style'])
    #                     unset(arbar['@attributes'])
    #                 end
    #                 if(json_encode(arbar)==='{"@attributes":{"location":"right"},"bar-style":"light-heavy"}')
    #                     half['light-heavy']="light-heavy"
    #                     #barline.delete('repeat'])
    #                     unset(arbar['bar-style'])
    #                     unset(arbar['@attributes'])
    #                 end
    #               end
                if(recursive===true)
                  half << clean_barline(arbar)
                end
              end #end of barline.each
              #unset(barline)
              barline=half
              #unset(half)
          else
            case barline.to_json
              when '{"@attributes":{"location":"left"},"bar-style":"heavy-light","repeat":{"@attributes":{"direction":"forward"}}}'
                  barline['forward']="forward"
                  barline.delete('repeat')
                  barline.delete('bar-style')
                  barline.delete('@attributes')
              when'{"@attributes":{"location":"right"},"bar-style":"light-heavy","repeat":{"@attributes":{"direction":"backward"}}}'
                  barline['backward']="backward"
                  barline.delete('repeat')
                  barline.delete('bar-style')
                  barline.delete('@attributes')
              when'{"@attributes":{"location":"left"},"bar-style":"light-light"}'
                  barline['light-light_left']="light-light"
                  #barline.delete('repeat')
                  barline.delete('bar-style')
                  barline.delete('@attributes')

              when'{"@attributes":{"location":"right"},"bar-style":"light-light"}'
                  barline['light-light_right']="light-light"
                  #barline.delete('repeat')
                  barline.delete('bar-style')
                  barline.delete('@attributes')
              when'{"@attributes":{"location":"right"},"bar-style":"light-heavy"}'
                  barline['light-heavy']="light-heavy"
                  #barline.delete('repeat'])
                  barline.delete('bar-style'])
                  barline.delete('@attributes'])

            end #end of case
         end #end of if(barline[0])
      
      end #end of if eso==true
      return barline
  end #end of clean_barline
  
  def self.clean_direction(direction) {
      do=true;
      if(do===true)
        if(direction[0])
            direction.each do |ardir|
              if(isset(ardir['direction-type']['coda']))
                coda="coda"
                unset(ardir['direction-type'])
                unset(ardir['@attributes'])
                #return coda['coda']="yes"
              end
              if (isset(ardir['direction-type']['rehearsal']))
                rehearsal=ardir['direction-type']['rehearsal']
                unset(ardir['direction-type'])
                unset(ardir['@attributes'])
              end
              if (isset(ardir['direction-type']['words']))
                words=ardir['direction-type']['words']
                unset(ardir['direction-type'])
                unset(ardir['@attributes'])
              end
              if (isset(ardir['direction-type']['segno']))
                ardir['segno']="segno" 
                unset(ardir['direction-type'])
                unset(ardir['@attributes'])
              end
            end #end direction.each
            direction=ardir
            unset(ardir)
            unset(half)
        else
          if(isset(ardir['direction-type']['coda']))
            coda="coda"
            unset(ardir['direction-type'])
            unset(ardir['@attributes'])
            #return coda['coda']="yes"
          end
          if (isset(ardir['direction-type']['rehearsal']))
            rehearsal=ardir['direction-type']['rehearsal']
            unset(ardir['direction-type'])
            unset(ardir['@attributes'])
          end
          if (isset(ardir['direction-type']['words']))
            words=ardir['direction-type']['words']
            unset(ardir['direction-type'])
            unset(ardir['@attributes'])
          end
          if (isset(ardir['direction-type']['segno']))
            ardir['segno']="segno" 
            unset(ardir['direction-type'])
            unset(ardir['@attributes'])
          end
        
        end# if direction[0]
      direction['coda']=coda if(coda)
      direction['rehearsal']=rehearsal  if(rehearsal) 
      direction['words']=words if(words) 
    end # end of it do===true
         
      return direction;
    end #end of clean direction
end