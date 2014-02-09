module IprHarmonyDef
  def self.definitions (ch)
     case ch['def']
         when  "major"
             if(ch['tensions']['degree-alter'] ==  "0" && ch['tensions']['degree-type'] == "add")
                 ch['def']="add" + ch['tensions']['degree-value']
                 ch.delete('tensions'])
             else
                 ch['def']=""
             end
         when  "major-seventh"
             ch['def']="Maj7"
             
         when "major-sixth"
             ch['def']="6"
             
         when "augmented"
             ch['def']="aug"
             
     
         when "major-ninth"
             ch['def']="Maj7"
         
             ch['tensions']=  add_tensions(ch, "9")
             
         # when is_array(ch['def']):
#              ch['def']="7alt"
             
         when "dominant"
         
             ch['def']="7"
             
         when "dominant-ninth"
         
             ch['def']="7"
             ch['tensions']=add_tensions(ch, "9")
             #convert_tensions= False
             
         when "dominant-13th"
             ch['def']="7"
             ch['tensions']=  add_tensions(ch, "9")
             ch['tensions']=  add_tensions(ch, "13")
             
         when "dominant-11th"
             ch['def']="7sus"
             
         when "minor-seventh"
             if(ch['tensions']['degree-value'].to_s=="5" && ch['tensions']['degree-alter'].to_s=="-1" && ch['tensions']['degree-type']==="alter")
                     ch['def']="-7b5"
                     ch.delete('tensions')
                     
             else        
             ch['def']="-7"
             end
     
         when "suspended-fourth"
             if(ch['tensions']['degree-value'].to_s =="7"  && ch['tensions']['degree-alter'].to_s =="0" && ch['tensions']['degree-type'] == "add")
                 ch['def']="7sus"
                 ch.delete('tensions')
             else 
                 ch['def']= "NOT FOUND"
             end
         when "minor":
             ch['def']="-"
             
         when "minor-ninth":
             ch['def']="-7"
             ch['tensions']=  add_tensions(ch, "9")    
             
         when "minor-sixth":
             ch['def']="-6"
             
         when "diminished":
             ch['def']="dim"
             
         when "diminished-seventh":
             ch['def']="dim7"
             
         else
     
        end
        return ch
  end # end of definitions
end