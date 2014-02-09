module IprHeaderTonality
  def convert_tonalidad($fiths,$modo){
    
      if($modo=="major"){
      switch ($fiths){
          case "0":
              $t="C";
          break;
          case "-1":
              $t="F";
          break;
          case "-2":
              $t="Bb";
          break;
          case "-3":
              $t="Eb";
          break;
          case "-4":
              $t="Ab";
          break;
          case "-5":
              $t="Db";
          break;
          case "-6":
              $t="Gb";
          break;
          case "-7":
              $t="Cb";
          break;
          case "1":
              $t="G";
          break;
          case "2":
              $t="D";
          break;
          case "3":
              $t="A";
          break;
          case "4":
              $t="E";
          break;
          case "5":
              $t="B";
          break;
          case "6":
              $t="F#";
          break;
          case "7":
              $t="C#";
          break;
      default :
          $t=$fiths.$modo."NOT FOUND";
          break;
      }}
      if($modo=="minor"){
          switch ($fiths){
          case "0":
              $t="A";
          break;
          case "-1":
              $t="D";
          break;
          case "-2":
              $t="G";
          break;
          case "-3":
              $t="C";
          break;
          case "-4":
              $t="F";
          break;
          case "-5":
              $t="Bb";
          break;
          case "-6":
              $t="Eb";
          break;
          case "-7":
              $t="Ab";
          break;
          case "1":
              $t="E";
          break;
          case "2":
              $t="B";
          break;
          case "3":
              $t="F#";
          break;
          case "4":
              $t="C#";
          break;
          case "5":
              $t="G#";
          break;
          case "6":
              $t="D#";
          break;
          case "7":
              $t="A#";
          break;
      default :
          $t=$fiths.$modo."NOT FOUND";
          break;
          }
        
      }
      return $t;
    
    end
end