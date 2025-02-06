<?php
// Database connection parameters
$host = 'localhost';
$dbname = 'cweb1131';
$username = 'root';
$password = '';

// create a PDO object
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//echo"Connected to $dbname at $host successfully.";


//retrieve data
function getData($conn){
    $data = 'SELECT * FROM customerinfo';
    $stmt = $conn -> query($data);
    return $stmt-> fetchAll(PDO::FETCH_ASSOC);
}
echo"<pre>";
print_r(getData($conn));
echo"</pre>";
?>