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
                <th>Název</th>
                <th>Obrázek</th>
                <th>Komentář</th>
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

                $sql = "SELECT * FROM public.boty";
            
                $res = pg_query($conn, $sql);
              


                while ($row = pg_fetch_assoc($res)) {
                    echo "<tr>";
                    echo "<td style='font-size: 200%;'>" . $row['název'] . "</td>";
                    echo "<td><img src=\"" . $row['image'] . "\" style='width: 50%;'></td>";
                    echo "<td>";
                    echo "<form method='POST' action='//localhost/comments.php'>";
                    echo "<input type='text' name='comment'>";
                    echo "<input type='hidden' name='název' value='" . $row['název'] . "'>";
                    echo "<input type='submit' value='Submit'>";
                    echo "</form>";
                    echo "</td>";
                    echo "<td>";
                    echo "<form method='POST' action='//localhost/comshow.php'>";
                    echo "<input type='submit' placeholder='komentáře'";
                    echo "<input type='hidden' name='název' value='" . $row['název'] . "'>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }

                pg_free_result($res);
                pg_close($conn);
            ?>
        </tbody>
    </table>
</body>
</html>