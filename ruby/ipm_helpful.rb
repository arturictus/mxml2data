module IpmHelpful
  def self.distri_ary (methodname, ary)
    output=[]
    ary.each do |h|
      if h.kind_of?(Array) && h[0]
        mul=[]
        h.each do |j|
         mul <<  send(methodname.to_sym, j)
        end
        output<< mul
      else
        output << send(methodname.to_sym, h)
      end
    end
    output
  end
end