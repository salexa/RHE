<html>
<head>
<title>Rug Hooking Exchange Browse</title>
<link REL="StyleSheet" TYPE="text/css" HREF="rhe.css">
<link href="RHEdefault.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
    <div id="header" class="container">
        <div id="logo">
            <h1>Rug Hooking Exchange</h1>
        </div>
        <div id="menu">
            <ul>    
                <li><a href="rughookingExchange.html" accesskey="1" title="">Home</a></li>
                <li class="active"><a href="browseItem.php">Browse Items</a></li>
                <li><a href="postItem.php">Post Item</a></li>
                <li><a href="#" accesskey="4" title="">About This Site</a></li>
                <li><a href="#" accesskey="5" title="">FAQ</a></li>
            </ul>
        </div>
    </div>


<?php 
include_once 'functions_rhe.php';
    
echo "<div id='content' class='container'>";  
//echo "<h3>Browse Rug Hooking Items</h3>";  
   
$result = queryMysql("SELECT * FROM ItemsForSale WHERE status = 'posted' ORDER BY `postdate` DESC");
        //$row_cnt = mysql_num_rows($result);
        //printf("Result set has %d rows.\n", $row_cnt);
//variables created for readability in html
$itemDateTime = formatdate($row[6]);
$category = $row[8];
$locationString = $row[4].", ".$row[5];  //city, state
$itemPhoto = $row[9];
$itemTitle = $row[1];
$itemPrice = $row[3];
$itemDescription = $row[2];      echo"<br></br>";  

while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
   // printf("itemid %s  itemname: %s what: %s", $row[0], $row[1], $row[9]); 
    $temp = formatdate($row[6]);
    echo "<div class='img'>";

    echo "<a href='viewItem.php?cur_id=$row[0]'> <img src = 'photos/$row[9]' ></a>";
    if ($row[8] == 'wanted')  
     {$dispString = "    (Wanted)";}  //want to display wanted for item category wanted
    if ($row[8] == 'equipment')
        {$dispString = $row[3];} //want to display price for items that should price
    echo "<div class='img_title'> $row[1]    $dispString</div>";
    echo "<div class='img_location'> Location: $row[4],$row[5]</div>";
    echo "<div class='img_location'> Date Posted: $temp</div>";


   /* echo "<div class='item_desc'> category: $row[8]</div>"; */
    echo "</div>";

}

 echo "</div>"; 
?>
    <div id="footer" class="container">
            <p>For questions, comments, suggestions contact <a href="mailto:sheryl@rughookingexchange.com">Sheryl@RughookingExchange.com</a></p>
    </div>
</body></html>
