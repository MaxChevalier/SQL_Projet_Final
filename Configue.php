    <?php
    $servername = "localhost";
    $username = "me";
    $password = "amande49510";
    $dbname = "db-entreprise";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM `employes`";
    ?>
