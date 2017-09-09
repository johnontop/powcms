<?php
ini_set('display_errors', '1');
//$search_tags  = file_get_contents($item['name']."/search_vars.txt");  // for pow-scan.php
$string  = file_get_contents("search_tags.txt");  // for pow-scan.php
//$string = "one one two three two three three three three three three four";

$string = preg_replace("/([,.?!])/"," \\1",$string);
$parts = explode(" ",$string);
$unique = array_unique($parts);
$unique = implode(" ",$unique);
$unique = preg_replace("/\s([,.?!])/","\\1",$unique);
echo $unique.'<br>';
$search_tags  = fopen("search_tags.htm", "w") or die("Unable to open file!"); 
fwrite($search_tags, pack("CCC",0xef,0xbb,0xbf))
?>

    <?php    
      $Array  = explode(' ',$unique) ;

      foreach($Array  as $key => $value) {
      // print "$key: $value<br>"; 
      $tag = ' <a class="tag_word" href="http://localhost/pow-search.htm?q='.$value.'">'.$value.'</a> ';
      echo $tag ;
      file_put_contents("search_tags.htm", $tag, FILE_APPEND);	   
      }
      
;  
fwrite($search_tags, utf8_encode($tags.' '));
fclose($search_tags);       
?>      