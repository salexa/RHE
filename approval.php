<?php 
include_once 'functions_rhe.php';

//******************** This executed after Submit ***********************************
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$currentCode = $_GET['code'];
   $selected_radio = $_POST['approve'];
   if ($selected_radio == 'Approve')
   	{
	echo "<br>";
   	echo "Your posting has been approved.  You will recieve an email with in structions to finalize your posting";
    echo "<br>";
    echo "your secret code will be: ". $currentCode;
    echo "<br>";
    echo "Thank-you for using Rug Hooking Exchange.";
    echo "<br>";
    queryMysql("UPDATE `ItemsForSale` SET `status` = 'email_sent' WHERE `userKey`= '$currentCode';");
//send email here to $currentCode@rughookingexchange.com
     }
   if ($selected_radio == 'Delete')
   {print "Your entry will be removed, Thank-you for using Rug Hooking Exchange.";
    queryMysql("UPDATE `ItemsForSale` SET `status` = 'delete' WHERE `userKey`= '$currentCode';");
    }
   exit;
}

//***************************** above executed after submit *********************************************
//***** first part of this section should be the same as Generic_item.php **********************
$currentCode = $_GET['code'];
printf("currentCode is :%s\n", $currentCode);
$result = queryMysql("SELECT * FROM ItemsForSale WHERE userKey = '$currentCode';");
$row = mysql_fetch_row($result);

//variables created for readability in html
//variables created for readability in html
$itemDateTime = formatdate($row[6]);
$category = $row[8];
$locationString = $row[4].", ".$row[5];  //city, state
$itemPhoto1 = $row[9];
$itemPhoto2 = $row[10];
$itemPhoto3 = $row[11];

$itemTitle = $row[1];
$itemPrice = $row[3];
$itemDescription = $row[2];

//Modify header for category
if ($category == 'wanted')
{$titleString = "Wanted: $row[1] ";}
if ($category != 'wanted')
{$titleString = $row[1];}

?>
<html>
<head>
<title>Rug Hooking Exchange Approve</title>
<link REL="StyleSheet" TYPE="text/css" HREF="rhe.css">
<link href="RHEdefault.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript">
         function swap(image) {
             document.getElementById("main").src = image.href;
         }
     </script>
</head>
<body>
<div id="header" class="container">
        <div id="logo">
            <h1 align = "center">Rug Hooking Exchange</h1>
        </div>
        <div id="menu">
            <ul>    
                <li><a href="rughookingExchange.html" accesskey="1" title="">Home</a></li>
                <li><a href="browseItem.php">Browse Items</a></li>
                <li><a href="postItem.php">Post Item</a></li>
                <li><a href="#" accesskey="4" title="">About This Site</a></li>
                <li><a href="#" accesskey="5" title="">FAQ</a></li>
            </ul>
        </div>
    </div>
    <div id='content' class='container'>
      <br>
      <h1 align = 'center'>Review and Approve Your Ad</h1>
    <div class="imgBig">
      <div class='imgBig_h1'><?php echo $titleString;?></div>
      <div class='imgBig_h1'>Price: <?php echo $itemPrice;?></div>
        <img id="main" src="photos/<?php echo $itemPhoto1;?>">
        <div class="thumb"><a href="photos/<?php echo $itemPhoto1;?>" onclick="swap(this);
                return false;"><img src="photos/<?php echo $itemPhoto1;?>"></a></div>
        <div class="thumb"><a href="photos/<?php echo $itemPhoto2;?>" onclick="swap(this);
                return false;"><img src="photos/<?php echo $itemPhoto2;?>"></a></div>
        <div class="thumb"><a href="photos/<?php echo $itemPhoto3;?>" onclick="swap(this);
                return false;"><img src="photos/<?php echo $itemPhoto3;?>"></a></div>
        <div class='imgBig_desc'><?php echo "Location:.",$locationString, "....Date Posted: ",  $itemDateTime;?></div>
        <div class="imgBig_desc"><?php echo "<br>",$itemDescription;?></div>
        <div class="contactSeller">Contact Seller: <a href="mailto:pseudoemail@rughookingexchange.com">pseudoemail@RughookingExchange.com</a></div>
    </div>
    <div id='approvalForm' class='container'>
      <p>To post this ad select approve below you will receive an email with further instructions.
      To delete this posting select delete below and your posting will be deleted.<p>
      <form Method ="Post" action="approval.php?code=<?php echo $currentCode; ?>">
        <label class="block"><input type="radio" name="approve" value="Approve" checked>Approve </label>
        <br>
        <label class="block"><input type="radio" name="approve" value="Delete">Delete </label>
        <br></br>
        <input type="submit" value="Submit">
      </form>
    </div>
  </div> 
    <div id="footer" class="container">
      <p>For questions, comments, suggestions contact <a href="mailto:sheryl@rughookingexchange.com">Sheryl@RughookingExchange.com</a></p>
    </div>
  </body>
  </html>