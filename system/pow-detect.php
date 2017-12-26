
<?php
ini_set('display_errors', '1'); 
/*
function mysql_one_value($query) {
	$result = mysqli_query($link,$query);
	$row = mysqli_fetch_row($result);
	return($row[0]);
}
*/

$user_ip = $_SERVER['REMOTE_ADDR'] ; 
//$user_ip = 'aa.bb.cc.dd' ;
include("res/geo-ip/geoipcity.inc");
include("res/geo-ip/geoipregionvars.php");
$gi = geoip_open("res/geo-ip/GeoLiteCity.dat",GEOIP_STANDARD);
$record = geoip_record_by_addr($gi,"$user_ip");
$country_code = $record->country_code ;
$country_name = $record->country_name ;
$city =  $record->city ;
$region = $record->region . " " . $GEOIP_REGION_NAME[$record->country_code][$record->region] ;
$latitude =  $record->latitude ;
$longitude =  $record->longitude ;
geoip_close($gi);

// Get MAC adress
// Turn on output buffering
ob_start();
//Get the ipconfig details using system commond
system('ipconfig /all');
 
// Capture the output into a variable
$mycom=ob_get_contents();
// Clean (erase) the output buffer
ob_clean();
 
$findme = "Physical";
//Search the "Physical" | Find the position of Physical text
$pmac = strpos($mycom, $findme);
 
// Get Physical Address
$mac=substr($mycom,($pmac+36),17);
//Display Mac Address
// echo $mac;
// Get MAC adress

echo '<p class="text-dark"><b>We have detected info from your browser and IP address:</b></p>';

echo '<p class="text-dark">Browsers IP address is: <font size="2" color="blue">'. $user_ip .'</font></p>';
echo '<p class="text-dark">Country code from IP address: <font size="2" color="blue">'. $country_code .'</font> <img src=/res/flags/small/'.$country_code.'.png style="height:16px; width:25px; border:0px;"/></p>' ;
echo '<p class="text-dark">Country name from IP address: <font size="2" color="blue">'. $country_name .'</font></p>';
echo '<p class="text-dark">City from IP address: <font size="2" color="blue">'. $city .'</font></p>';
echo '<p class="text-dark">Coordinates from IP address. <font size="2" color="blue">Lat: '. $latitude .'  Long: '.$longitude .'</font></p>';

$lang_codes = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
$lang_code = strtoupper(substr(chop($lang_codes[0]),0,2));
$language = strtolower(substr(chop($lang_codes[0]),0,2));

echo '<p class="text-dark">Browsers language code is: '. $lang_code .'</p>';
//echo $name = mysql_one_value("SELECT language_name FROM language WHERE iso_639_1='$language");
$sql=@mysqli_query($link,"SELECT language_name FROM language WHERE iso_639_1='$language' ");
while($row=mysqli_fetch_assoc($sql))
{
echo '<p class="text-dark">Your language is:<font size="2" color="blue">'.$row['language_name'].'</font>';
}
?>
 <img src="/res/flags/language-small/<?php echo $language ;?>.png" style="height:16px; width:25px; border:0px;" />  </p>

<p class="text-dark">Your Network cards Mac address is:<?php echo $remember_me ?> </p>
        			                                                                 
            <div class="row">	
             <hr style="border-bottom:1px solid #aaa; margin-right:20px; margin-top:10px" />	
				    	<div class="col-xs-3 col-sm-5 col-md-3">
				  		<i class="fa fa-flag text-dark"></i>
				  		<a href="grid-language.php"><?php echo Language ;?></a>
				  	 </div>	
				    	<div class="col-xs-3 col-sm-5 col-md-3">
				  		<i class="fa fa-globe text-dark"></i>
				  		<a href="grid-country.php"><?php echo Country ;?></a>
				  	 </div>					  	 
              <div class="col-xs-3 col-sm-4 col-md-3">						                                                                                     
              <i class="fa fa-male text-dark"></i>						                                                                                     
              <a href="register.php"> <?php echo Register ?> </a>					                                                                           
              </div>                         			                                                                           
				    	<div class="col-xs-3 col-sm-4 col-md-3">
				  		<i class="fa  fa-sign-in text-dark"></i>
				  		<a href="login.php"><?php echo Login ;?></a>
				  	 </div>					 					                                                                           				                                                                 
            </div>			                                                       
      			 