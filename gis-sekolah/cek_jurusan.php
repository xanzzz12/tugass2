<?php
// File untuk mengecek data jurusan di database
// Akses via browser: http://localhost/gis-sekolah/cek_jurusan.php

// Koneksi database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'gis-sekolah';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<h2>🔍 CEK STATUS DATABASE GIS-SEKOLAH</h2>";
    
    // Cek apakah tabel tbl_jurusan ada
    $stmt = $pdo->query("SHOW TABLES LIKE 'tbl_jurusan'");
    if ($stmt->rowCount() > 0) {
        echo "✅ Tabel tbl_jurusan: <strong>ADA</strong><br>";
        
        // Cek jumlah data jurusan
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM tbl_jurusan");
        $result = $stmt->fetch();
        echo "📊 Jumlah data jurusan: <strong>{$result['total']}</strong><br><br>";
        
        if ($result['total'] > 0) {
            echo "<h3>📋 DAFTAR JURUSAN:</h3>";
            $stmt = $pdo->query("SELECT id_jurusan, nama_jurusan FROM tbl_jurusan ORDER BY id_jurusan");
            echo "<ol>";
            while ($row = $stmt->fetch()) {
                echo "<li>ID: {$row['id_jurusan']} - {$row['nama_jurusan']}</li>";
            }
            echo "</ol>";
        } else {
            echo "<h3>❌ MASALAH: Data jurusan kosong!</h3>";
            echo "<p><strong>SOLUSI:</strong> Jalankan file <code>insert_jurusan_data.sql</code> di phpMyAdmin</p>";
        }
    } else {
        echo "❌ Tabel tbl_jurusan: <strong>TIDAK ADA</strong><br>";
        echo "<p><strong>SOLUSI:</strong> Jalankan file <code>insert_jurusan_data.sql</code> di phpMyAdmin</p>";
    }
    
    // Cek tabel tbl_sekolah_jurusan
    echo "<br><hr>";
    $stmt = $pdo->query("SHOW TABLES LIKE 'tbl_sekolah_jurusan'");
    if ($stmt->rowCount() > 0) {
        echo "✅ Tabel tbl_sekolah_jurusan: <strong>ADA</strong><br>";
        
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM tbl_sekolah_jurusan");
        $result = $stmt->fetch();
        echo "📊 Jumlah relasi sekolah-jurusan: <strong>{$result['total']}</strong><br>";
    } else {
        echo "❌ Tabel tbl_sekolah_jurusan: <strong>TIDAK ADA</strong><br>";
        echo "<p><strong>SOLUSI:</strong> Jalankan file <code>insert_jurusan_data.sql</code> di phpMyAdmin</p>";
    }
    
    // Cek struktur tbl_sekolah
    echo "<br><hr>";
    $stmt = $pdo->query("DESCRIBE tbl_sekolah");
    $columns = $stmt->fetchAll();
    echo "<h3>📋 STRUKTUR TABEL tbl_sekolah:</h3>";
    echo "<ul>";
    foreach ($columns as $column) {
        echo "<li>{$column['Field']} - {$column['Type']}</li>";
    }
    echo "</ul>";
    
    // Cek apakah kolom id_jurusan masih ada (seharusnya sudah dihapus)
    $hasIdJurusan = false;
    foreach ($columns as $column) {
        if ($column['Field'] == 'id_jurusan') {
            $hasIdJurusan = true;
            break;
        }
    }
    
    if ($hasIdJurusan) {
        echo "<p>⚠️ <strong>PERINGATAN:</strong> Kolom <code>id_jurusan</code> masih ada di tbl_sekolah. Seharusnya sudah dihapus!</p>";
    } else {
        echo "<p>✅ Kolom <code>id_jurusan</code> sudah dihapus dari tbl_sekolah (benar!)</p>";
    }
    
} catch (PDOException $e) {
    echo "<h3>❌ ERROR KONEKSI DATABASE:</h3>";
    echo "<p>" . $e->getMessage() . "</p>";
    echo "<p><strong>SOLUSI:</strong></p>";
    echo "<ul>";
    echo "<li>Pastikan XAMPP/MySQL sudah running</li>";
    echo "<li>Pastikan database 'gis-sekolah' sudah dibuat</li>";
    echo "<li>Periksa username/password database di file ini</li>";
    echo "</ul>";
}
?>

<style>
body { font-family: Arial, sans-serif; margin: 20px; }
h2 { color: #2c3e50; }
h3 { color: #34495e; }
code { background: #f8f9fa; padding: 2px 4px; border-radius: 3px; }
hr { margin: 20px 0; }
</style>
