<div id="map" style="width: 1150px; height: 500px;"></div>

<script>
    // 1. Inisialisasi peta
    const map = L.map('map').setView([-3.792113, 102.265092], 13);

    // 2. Tambahkan tile layer OpenStreetMap
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    // 3. Marker dari data sekolah (PHP loop)
    <?php foreach ($sekolah as $value) { ?>
        L.marker([<?= $value->latitude ?>, <?= $value->longitude ?>])
         .addTo(map)
         .bindPopup('<?= htmlspecialchars($value->nama_sekolah) ?>');
    <?php } ?>
</script>
