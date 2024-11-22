<?php
$database = "id21790083_db";
$username = "id21790083_db";
$password = "Database25.";
$host = "localhost";

try {
    $pdo = new PDO('mysql:host='.$host.';dbname='.$database, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}



if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM dosen WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $dosen = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if(!$dosen) {
        echo "ID dosen tidak ditemukan.";
        exit;
    }
} else {
    echo "ID dosen tidak ditemukan.";
    exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $nidn = $_POST['nidn'];
    
    try {
        $stmt = $pdo->prepare("UPDATE dosen SET nama = :nama, nidn = :nidn WHERE id = :id");
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':nidn', $nidn);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        header("Location: index.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Dosen</title>
</head>
<body>
    <h2>Ubah Data Dosen</h2>
    <p>Mengubah data dosen dengan ID: <?= $id; ?></p>
    <form method="POST">
        <label for="nama">NAMA:</label><br>
        <input type="text" id="nama" name="nama" value="<?= $dosen['nama']; ?>"><br>
        <label for="nidn">NIDN:</label><br>
        <input type="text" id="nidn" name="nidn" value="<?= $dosen['nidn']; ?>"><br><br>
        <input type="submit" value="Simpan Perubahan">
        <a href="index.php"><button type="button">Batal</button></a>
    </form>
</body>
</html>
