class IprExtractxml
  include IprLayout
  def initialize(file)
    url = File.join(Rails.root, 'lib', 'importmusicxml', file)
    opened = open(url)
    @xml = Nokogiri::XML(open(url))
    hxml = Hash.from_xml(open(url))
    @score= hxml["score_partwise"]
    @tune= {}
    
  end
  
  def get_title
    @tune[:title] = @xml.xpath("//movement-title").text
   # @title = @score['movement-title']
  end
  def get_composer
    @tune[:composer]= @score["identification"]["creator"][0]
  end
  def get_style
    @tune[:style]= @score["identification"]["creator"][1]
  end
  def get_tonality
     @tune[:tonality]= [@xml.xpath("//fifths").text, @xml.xpath("//mode").text]
  end
  def get_time_signature
    @tune[:time_signature] = [@xml.xpath("//beats").text, @xml.xpath("//beat-type").text]
  end
  # def get_barlines
#     @tune[:barlines] = @xml.xpath("//barline").to_json
#   end
  
  def get_all
    get_title
    get_composer
    get_style
    get_tonality
    get_time_signature
    #get_barlines
  end
  def get_tune_ary
    master={:layout => [], :chords => []}
    @score['part']['measure'].each do |measure|
      
      get_tune_layout(measure, master)
    # 2. get_tune_harmony
    end
    # $ch=new chordsxml;
#     $chords=array();
#     $cl_lay=new layout;
#     $et['layout']['systems']=0;
# 
#     foreach ($tema_array['part']['measure'] as $mesure) {
#         $check_boxes=true;
#         $check_barline=true;
#         $check_new_system=true;
#         $check_time=true;
#         $check_direction=true;
   
  #  }
  # 
  # #$cl_lay=new layout;
  #  $et['layout']['affec_mes']= array_values(array_unique($et['layout']['affec_mes']));
  #  #$et['layout']=$cl_lay->clean_it_all($et['layout']);
  #  $et['chords']=$acordes;
  @tune << master
 
  end
  def get_tune_layout(measure, master)
    check_boxes(measure , master)
    # 2. IprLayoutBarline::check_barline
    # 3. IprLayoutNewSystem::check_new_system
    # 4. IprLayoutTimeSignature::check_t_s
    # 5. IprLayoutDirection::check_direction
    measure
  end
  def get_tune_harmony
    
  end
  
end