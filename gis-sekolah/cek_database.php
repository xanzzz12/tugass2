<?php
// Konfigurasi database
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'gis-sekolah';

// Membuat koneksi
$conn = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk melihat struktur tabel
$sql = "SHOW TABLES";
$result = $conn->query($sql);

echo "Tabel yang ada di database gis-sekolah:\n";
if ($result->num_rows > 0) {
    while($row = $result->fetch_row()) {
        echo "- " . $row[0] . "\n";
    }
}

// Cek struktur tabel tbl_sekolah
echo "\nStruktur tabel tbl_sekolah:\n";
$sql = "DESCRIBE tbl_sekolah";
$result = $conn->query($sql);

if ($result) {
    while($row = $result->fetch_assoc()) {
        echo $row['Field'] . " - " . $row['Type'] . " - " . $row['Null'] . "\n";
    }
} else {
    echo "Tabel tbl_sekolah tidak ditemukan\n";
}

$conn->close();
?>
