class IprTune < IprExtractxml
  include IpmHelpful
  
 
  def get_headers
    get_all
    get_tune_ary
    # head={}
#     head['title'] =  
#     head['composer'] = 
#     head['style'] = 
    #return @xml.inspect
    @tune
  end
end