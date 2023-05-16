<!DOCTYPE html>
<html>
<head>
    <title>Vans on bikes</title>
</head>
<body>
    <h1><a href='//localhost/index.php'><img src='//localhost/obrazky/vansonbike.png' style='width: 30%'></a></h1>
    <table>
        <thead>
            <tr>          
                <th>Komentáře</th>
            </tr>
        </thead>
        <tbody>
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
            $název = $_POST['název'];
            $sql = "SELECT comment FROM public.comments WHERE název='$název'";
            $res = pg_query($conn, $sql);
            if (!$res) {
                echo "Failed to execute the query!";
                exit;
            }

            while ($row = pg_fetch_assoc($res)) {
                $comment = $row['comment'];
                $commentAsString = strval($comment);
                echo "<tr>";
                echo "<td>" . $commentAsString . "</td>";
                echo "</tr>";
            }
            pg_free_result($res);
            pg_close($conn);
            ?>
        </tbody>
    </table>
</body>
</html>
