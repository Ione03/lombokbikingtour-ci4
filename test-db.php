<?php
$host = 'localhost';
$user = 'lombokbi';
$pass = 'Iwanantri03';
$db = 'lombokbi_dblombokbiking';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

echo "✅ Database connection successful!<br>";
echo "Database: " . $db . "<br>";
echo "User: " . $user . "<br>";

$result = $conn->query("SHOW TABLES");
echo "<br>Tables in database:<br>";
while($row = $result->fetch_array()) {
    echo "- " . $row[0] . "<br>";
}

$conn->close();
?>