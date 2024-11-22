<?php
if(empty($_POST['nidn']) OR empty($_POST['nama'])){
?>
<html>
    <head>
        
    </head>
    <body>
        <form method="POST">
            <br>NIDN: <input type="text" max-length="10" name="nidn" required>
            <br>NAMA: <input type="text" max-length="100" name="nama" required>
            <br><br><input type="submit" value="Tambahkan Dosen Baru">
        </form>
    </body>
</html>
<?php
}else{
    $database = "id21790083_db";
    $username = "id21790083_db";
    $password = "Database25.";
    $host = "localhost";
    try {
    $pdo = new PDO(dsn: 'mysql:host='.$host.';dbname='.$database, username: $username, password: $password);
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $db_ok=1;
} catch (\Exception $e) {
    die($e->getMessage());
}

$nidn=$_POST['nidn'];
$nama=$_POST['nama'];
$dosens = $pdo->query("INSERT INTO dosen (nidn, nama) VALUES ('$nidn', '$nama')");
header("Location: index.php");
    
}