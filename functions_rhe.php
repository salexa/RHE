<?php // Example 21-1: functions.php
$dbhost  = 'localhost';    // Unlikely to require changing
$dbname  = 'rhedata';       // Modify these...
$dbuser  = 'sheryl';   // ...variables according
$dbpass  = 'rhepassword';   // ...to your installation
$appname = "Rug Hooking Exchange"; // ...and preference

mysql_connect($dbhost, $dbuser, $dbpass) or die(mysql_error());
mysql_select_db($dbname) or die(mysql_error());

function createTable($name, $query)
{
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
    echo "Table '$name' created or already exists.<br />";
}

function queryMysql($query)
{
    $result = mysql_query($query) or die(mysql_error());
	 return $result;
   //  echo "queryMysql called";
}

function formatdate($rawdatetime)
{
    $time = strtotime($rawdatetime);
    $my_format = date("m/d/y g:i A", $time);
    return $my_format;
}

function destroySession()
{
    $_SESSION=array();
    
    if (session_id() != "" || isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time()-2592000, '/');

    session_destroy();
}

function sanitizeString($var)
{
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return mysql_real_escape_string($var);
}

//creates random alphanumeric of length $len
function createRandom($len)
{
    $length = $len;
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $charsLen = strlen($chars);
    $random = " ";

    for ($i=0; $i<$length; $i++)
      {  $random .= substr($chars, rand(0, $charsLen-1), 1);
       }
    //echo "Random is '$random'<br />";
    return $random;
}

function showProfile($user)
{
    if (file_exists("$user.jpg"))
        echo "<img src='$user.jpg' align='left' />";

    $result = queryMysql("SELECT * FROM profiles WHERE user='$user'");

    if (mysql_num_rows($result))
    {
        $row = mysql_fetch_row($result);
        echo stripslashes($row[1]) . "<br clear=left /><br />";
    }
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

//resizes the file larger of the two dimensions passed, scales the other
//seems to work ok even if the original file is smaller than the new size
//upsizes the image, looks OK so far
function resizeImage($newW, $newH, $target_file) {
    list($width, $height, $type, $attr) = getimagesize($target_file);
  //  printf("width is: %d height is :%d\n", $width, $height);
    if($width > $height)
      { // no change to width
        $newH = $newW/$width * $height; //scale height to width
      }
    else{
        // no change to height
        $newW = $newH/$height * $width; //scale width to height
    }
       // printf("new width is: %d new height is :%d\n", $newW, $newH);
        $src = imagecreatefromjpeg($target_file);
        $tmp = imagecreatetruecolor($newW, $newH);
        imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newW, $newH, $width, $height);
        imageconvolution($tmp, array(array(-1, -1, -1),array(-1, 16, -1), array(-1, -1, -1)), 8, 0);
        imagejpeg($tmp, $target_file);  
       // printf("target file is is: %s:\n", $target_file);
    }
 
function checkSizeType($string2) {
    if ($_FILES["$string2"]["size"] > 500000) {
      global $fail; $fail= 'true';
      echo "I am inside checkSizeType if";
      $photoErr = "photo must be less than 500KB";
      echo "   inside function photoErr is : $photoErr";
      return $photoErr;
    }
    if ((!$fail) && ($_FILES["$string2"]["size"] > 0)) { //don't want to check file type if already rejected or 0
    $filetype = getimagesize($_FILES["$string2"]["tmp_name"]); 
        if (($filetype['mime']) != 'image/jpeg') {
            global $fail; $fail= 'true';
            $photoErr = "only jpeg images are accepted, please select another file";
            return $photoErr;
      //  echo "Only jpeg files are accepted";
        //echo "image/jpg is  :". $filetype['mime'];
        }
    }
}

?>
