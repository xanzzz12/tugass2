<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Detail Sekolah
            <small>Informasi Detail Sekolah</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('home') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?= base_url('sekolah') ?>">Data Sekolah</a></li>
            <li class="active">Detail Sekolah</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Informasi Sekolah</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Nama Sekolah</th>
                                <td><?= $sekolah->nama_sekolah ?></td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td><?= $sekolah->alamat ?></td>
                            </tr>
                            <tr>
                                <th>Latitude</th>
                                <td><?= $sekolah->latitude ?></td>
                            </tr>
                            <tr>
                                <th>Longitude</th>
                                <td><?= $sekolah->longitude ?></td>
                            </tr>
                            <tr>
                                <th>Jumlah Guru Mapel</th>
                                <td><?= $sekolah->jumlah_guru_mapel ?></td>
                            </tr>
                            <tr>
                                <th>Jumlah Guru</th>
                                <td><?= $sekolah->jumlah_guru ?></td>
                            </tr>
                            <tr>
                                <th>Jumlah Siswa</th>
                                <td><?= $sekolah->jumlah_siswa ?></td>
                            </tr>
                            <tr>
                                <th>Jurusan</th>
                                <td><?= isset($sekolah->nama_jurusan) ? $sekolah->nama_jurusan : '-' ?></td>
                            </tr>
                            <tr>
                                <th>Kepala Sekolah</th>
                                <td><?= $sekolah->kepala_sekolah ?></td>
                            </tr>
                            <tr>
                                <th>Status Sekolah</th>
                                <td><?= $sekolah->status_sekolah ?></td>
                            </tr>
                        </table>
                        <a href="<?= base_url('sekolah') ?>" class="btn btn-warning">Kembali</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Peta Lokasi</h3>
                    </div>
                    <div class="box-body">
                        <div id="map" style="height: 400px;"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">Jurusan yang Tersedia</h3>
                    </div>
                    <div class="box-body">
                        <?php if (!empty($jurusan)): ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Jurusan</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach ($jurusan as $j): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $j->nama_jurusan ?></td>
                                        <td><?= isset($j->keterangan) ? $j->keterangan : '-' ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p class="text-center">Tidak ada jurusan yang tersedia untuk sekolah ini.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    // Map initialization moved to custom.js for consistency
</script>
