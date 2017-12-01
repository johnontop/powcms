<?php
//http://phpword.codeplex.com/
//http://sebsauvage.net/wiki/doku.php?id=word_document_generation

ini_set('display_errors', '1'); 

header("Content-type: application/vnd.ms-word");
header("Content-Type: application/force-download; charset=UTF-8");
header("Cache-Control: no-store, no-cache");
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");



if($_POST['submit_word']) {
$title_name = $_POST['title'];
$name = $_POST['name'];
$file_name = $_POST['file_name']; 
$text = $_POST['text'];
$date = $_POST['date'];
$category = $_POST['category'];
$image = $_POST['image']; 
$tags = $_POST['tags'];
$description = $_POST['description'];
}

$text = str_replace('ï»¿', '', $text);
          

header("Content-disposition: attachment; filename=$title_name.doc");

?>
<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'>
<head>
<!--[if gte mso 9]>
<xml>
<w:WordDocument>
<w:View>Print</w:View>
<w:Zoom>100</w:Zoom>
<w:DoNotOptimizeForBrowser/>
</w:WordDocument>
</xml>
<![endif]-->

<!-- 
@page
{
    size: 21cm 29.7cm;  /* A4 */
    margin: 1cm 1cm 1cm 1cm; /* Margins: 2 cm on each side */
    mso-page-orientation: portrait;  
}
-->

<style>
	html, body, div, span, p, blockquote, pre, a, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article {
		margin-top: 0;
    margin: 0;
		padding: 0;
		border: 0;
		font-size: 10pt;
		vertical-align: baseline; }
		
	h1, h2, h3, h4, h5, h6 {
		color: #181818;
		font-family:  Arial, sans-serif;
		font-weight: normal; }
		
	h1 { font-size: 28pt; line-height: 18pt; margin-bottom: 8px; font-family: Roboto, Arial, sans-serif; margin-bottom: 5px; }
	h2 { font-size: 16pt; line-height: 14px; margin-bottom: 6px; }
	h3 { font-size: 13pt; line-height: 16pt; font-family: Roboto, Arial, sans-serif; font-weight:500;}
	p { font-size: 11pt; line-height: 11px; font-family:  Roboto, Arial, sans-serif; margin-bottom: 5px; }
	
	td { font-size: 11pt; line-height: 11px; font-family:  Roboto, Arial, sans-serif; }
	tr { page-break-after:avoid;  }
	li { font-size: 11pt; line-height: 11px; font-family: Roboto. Arial, sans-serif; }
	hr { margin-top: 5px; margin-bottom: 5px; }

	
.image img {
	margin-top: 10px;
	margin-bottom: 30px;
	margin-left: 10px;
	max-width: 320px;
	height: auto;	
  }
</style>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">

</head>
<body>
<img src="http://localhost/theme/header-image.png" alt="Logo">

<h1 style="color:#333;"><?php echo $title_name ?></h1>

<h3><?php echo $description ;?></h3>
<hr>
<p><?php echo $text ;?></p>

<hr>

<p>This is a presentation of content in the HTML file for:</p> 
<p>Page: <?php echo $file_name ?> - Author: - Date:</p>
</body>
</html>
