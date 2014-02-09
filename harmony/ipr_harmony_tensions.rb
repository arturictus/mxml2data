module IprHarmonyTensions
  def self.swi_add_tens(tens)
    ary = case tens
      when "b9" then
        {'degree-value'=>"9",
          'degree-alter'=>"-1",
          'degree-type'=>"add"}
    
      when "9" then
        {'degree-value'=>"9",
          'degree-alter'=>"0",
          'degree-type'=>"add"}
    
      when "#9" then
        {'degree-value'=>"9",
          'degree-alter'=>"1",
          'degree-type'=>"add"}
    
      when "11" then
        {'degree-value'=>"11",
          'degree-alter'=>"0",
          'degree-type'=>"add"}
    
      when "#11" then
        {'degree-value'=>"11",
          'degree-alter'=>"1",
          'degree-type'=>"add"}
    
      when "b13" then
        {'degree-value'=>"13",
          'degree-alter'=>"-1",
          'degree-type'=>"add"}
    
       when "13" then
         {'degree-value'=>"13",
          'degree-alter'=>"0",
          'degree-type'=>"add"}
    end #end of case
    return ary
  end #end of swi_add_tens
  
  def self.add_tensions(ch,tens)
          if (ch['tensions'])
              if(ch['tensions'][0])
                 newtens=[]
                 ch['tensions'].each do |chtens|
                   newtens<<chtens
                 end
                 newtens<< swi_add_tens(tens)
                 # ch['tensions'][]
              else   
                newtens=[]
                newtens<<ch['tensions'];
                newtens<<swi_add_tens(tens)
              end
          else 
              newtens=  swi_add_tens(tens)
          end
      return newtens
  end # end of add_tensions
  
  def self.convert_tensions(tensions)
     ret = case tensions['degree-alter']
        when "0" then ""
            
        when "1" then "#"
            
        when "-1" then "b"
            
        else
            false
        end
  
     ret <<  tensions['degree-value'] 
     ret="Maj7" if ret=="#7"
     ret="sus4" if ret=="4"
    return ret
  end # end of convert_tensions
  
  
  
  def self.tensions (ch)
    if ch['tensions'] # && convert_tensions!= false
        if(ch['tensions'][0])
          more= []
          ch['tensions'].each do |mul_tensions|
              if(mul_tensions['degree-type']!=="subtract")
                more << convert_tensions(mul_tensions)
              end
          end
          ch['tensions']=more
        
        else
            if(mul_tensions['degree-type']!=="subtract")
              ch['tensions']=  convert_tensions(ch['tensions'])
            end
        end
    end
    return ch
  end
  
    
end # End of Module