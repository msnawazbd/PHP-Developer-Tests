<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "part_one_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql_table = "CREATE TABLE currencies (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  numCode INT(11) NOT NULL,
  сharCode VARCHAR(100) NOT NULL,
  name VARCHAR(100) NOT NULL,
  value INT(11) NOT NULL,
  date VARCHAR(10) NOT NULL
)";

// execute table
if ($conn->query($sql_table) === TRUE) {
    true;
} else {
    echo "Error creating table: " . $conn->error;
}

// get data from xml
$xml = simplexml_load_string(file_get_contents('http://www.cbr.ru/scripts/XML_daily.asp'));

$arr = [];

$array = json_decode(json_encode($xml), true);

if (!empty($array)) {
    foreach ($array['Valute'] as $elem) {
        $NumCode = $elem['NumCode'];
        $CharCode = $elem['CharCode'];
        $Name = $elem['Name'];
        $Value = $elem['Value'];
        $Date = strval($xml['Date']);

        //insert data
        $sql = "INSERT INTO currencies (numCode, сharCode, name, value, date)
			VALUES ('$NumCode', '$CharCode', '$Name', '$Value', '$Date')";
        if ($conn->query($sql) === TRUE) {
            true;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

echo "All records stored successfully.";
// connection close
$conn->close();
