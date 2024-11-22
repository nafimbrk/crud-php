<?php

$database = "id21790083_db";
$username = "id21790083_db";
$password = "Database25.";
$host = "localhost";

try {
    $pdo = new PDO('mysql:host='.$host.';dbname='.$database, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
     die($e->getMessage());
}

echo "<p><a href='tambah_dosen.php'>Tambah Dosen Baru</p>";
$dosens = $pdo->query("SELECT * FROM dosen");
echo "<table border=1>";
echo "<tr><th>NAMA DOSEN</th><th>NIDN</th><th>AKSI</th><tr>";
foreach ($dosens as $dosen){
    echo "<tr><td>$dosen[nama]</td><td>$dosen[nidn]</td><td><a href='ubah_dosen.php?id=$dosen[id]'>-UBAH-</a><a href='hapus_dosen.php?id=$dosen[id]&nama=$dosen[nama]&nidn=$dosen[nidn]'>-HAPUS-</a></td></tr>";
}
echo "<table border=1>";



