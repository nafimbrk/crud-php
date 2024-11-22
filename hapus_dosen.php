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



if(isset($_GET['id']) && isset($_GET['nidn']) && isset($_GET['nama'])) {
    $id = $_GET['id'];
    $nama = $_GET['nama'];
    $nidn = $_GET['nidn'];
    
    if($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['confirm'])) {
        echo "Apakah Anda yakin ingin menghapus data dengan:<br><br>";
        echo "ID: $id<br>";
        echo "NIDN: $nidn<br>";
        echo "NAMA: $nama<br><br>";
        echo "<form method='post'>";
        echo "<button type='submit' name='confirm' value='Yes'>Ya</button>";
        echo " ";
        echo "<button type='submit' name='cancel' value='Cancel'>Tidak</button>";
        echo "</form>";
        exit;
    }
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['cancel'])) {
            header("Location: index.php");
            exit;
        }
        
        try {
            $stmt = $pdo->prepare("DELETE FROM dosen WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            header("Location: index.php");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
} else {
    echo "Data dosen tidak lengkap.";
}
?>
