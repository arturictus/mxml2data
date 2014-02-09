module IprHarmonyRoot
  def self.root_alterator (ch)
    case ch['root_alter']
      when "0"
          ch.delete('root_alter')
          
      when "1"
          ch['root']<<"#"
          ch.delete('root_alter')
          
      when "-1"
          ch['root']<<"b"
          ch.delete('root_alter')
          
      else
          ch['root_alter']<<"NOT FOUND"
    end
    return ch
  end #end of root_alterator
  def self.changed_bass (ch)
    if(ch['alter_bass'])
      b_alter=ch['alter_bass']['bass-alter']
      ch['alter_bass'] = case b_alter.to_s
        when "0" then ch['alter_bass']['bass-step'] + ""
            #ch.delete('root_alter'])
            
        when "1" then ch['alter_bass']['bass-step'] + "#"
           # ch.delete('root_alter'])
            
        when "-1" then ch['alter_bass']['bass-step'] + "b"
            #ch.delete('root_alter'])
            
        else
            ch['alter_bass']['bass-step'] + "NOT FOUND" 
        end
   end
   return ch
  end #end of changed_bass
end