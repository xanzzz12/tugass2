<?php
// File untuk mengecek struktur database
try {
    $pdo = new PDO('mysql:host=localhost;dbname=gis_sekolah', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "=== STRUKTUR TABEL TBL_SEKOLAH ===\n";
    $stmt = $pdo->query('DESCRIBE tbl_sekolah');
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo $row['Field'] . ' - ' . $row['Type'] . ' - ' . ($row['Null'] == 'YES' ? 'NULL' : 'NOT NULL') . "\n";
    }
    
    echo "\n=== STRUKTUR TABEL TBL_JURUSAN ===\n";
    try {
        $stmt = $pdo->query('DESCRIBE tbl_jurusan');
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo $row['Field'] . ' - ' . $row['Type'] . "\n";
        }
    } catch(PDOException $e) {
        echo "Tabel tbl_jurusan tidak ditemukan\n";
    }
    
    echo "\n=== STRUKTUR TABEL TBL_GURU_MAPEL ===\n";
    try {
        $stmt = $pdo->query('DESCRIBE tbl_guru_mapel');
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo $row['Field'] . ' - ' . $row['Type'] . "\n";
        }
    } catch(PDOException $e) {
        echo "Tabel tbl_guru_mapel tidak ditemukan\n";
    }
    
} catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
