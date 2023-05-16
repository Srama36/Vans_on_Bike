<?php
 $dbname = 'VANSonbike';
 $dbuser = 'postgres';
 $dbpass = 'bombshell';
 $dbhost = 'localhost';
 $dbport = '5432';

$conn = pg_connect("host=$dbhost port=$dbport dbname=$dbname user=$dbuser password=$dbpass");
if (!$conn) {
    echo "Failed to connect to the database!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $název = $_POST['název'];
    $comment = $_POST['comment'];
    
    $sql = "INSERT INTO comments (název, comment) VALUES ('$název', '$comment')";
    $result = pg_query($conn, $sql);
    
    if (!$result) {
        echo "Failed to insert the comment into the database!";
        exit;
    }
}

pg_close($conn);
?>