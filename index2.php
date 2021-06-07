
<?php
include_once('parts/conn.php');
// Import data 
$filename = 'opd.sql';
import_tables('localhost','root','','opd',$filename);

function import_tables($host,$uname,$pass,$database, $filename,$tables = '*'){
    $connection = mysqli_connect($host,$uname,$pass)
    or die("Database Connection Failed");
    $selectdb = mysqli_select_db($connection, $database) or die("Database could not be selected"); 

$templine = '';
$lines = file($filename); // Read entire file

foreach ($lines as $line){
    // Skip it if it's a comment
    if (substr($line, 0, 2) == '--' || $line == '' || substr($line, 0, 2) == '/*' )
        continue;

        // Add this line to the current segment
        $templine .= $line;
        // If it has a semicolon at the end, it's the end of the query
        if (substr(trim($line), -1, 1) == ';')
        {
            mysqli_query($connection, $templine)
            or print('Error performing query \'<strong>' . $templine . '\': ' . mysqli_error($connection) . '<br /><br />');
            $templine = '';
        }
    }
    echo "Tables imported successfully";
}
?>*/
<?php
header("location:start.php");
?>