<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Edit Data Sekolah
            <small>Mengedit Data Sekolah</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('home') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?= base_url('sekolah') ?>">Data Sekolah</a></li>
            <li class="active">Edit Data Sekolah</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Form Edit Data Sekolah</h3>
                    </div>
                    <div class="box-body">
                        <?php if (validation_errors()): ?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                                <?= validation_errors() ?>
                            </div>
                        <?php endif; ?>

                        <?= form_open('sekolah/edit/' . $sekolah->id_sekolah) ?>
                        <div class="form-group">
                            <label>Nama Sekolah</label>
                            <input type="text" name="nama_sekolah" class="form-control" placeholder="Masukkan Nama Sekolah" value="<?= set_value('nama_sekolah', $sekolah->nama_sekolah) ?>">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan Alamat Sekolah"><?= set_value('alamat', $sekolah->alamat) ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Latitude</label>
                            <input type="text" name="latitude" id="latitude" class="form-control" placeholder="Masukkan Latitude" value="<?= set_value('latitude', $sekolah->latitude) ?>">
                        </div>
                        <div class="form-group">
                            <label>Longitude</label>
                            <input type="text" name="longitude" id="longitude" class="form-control" placeholder="Masukkan Longitude" value="<?= set_value('longitude', $sekolah->longitude) ?>">
                        </div>
                        <div class="form-group">
                            <label>Jumlah Guru Mapel</label>
                            <input type="number" name="jumlah_guru_mapel" class="form-control" placeholder="Masukkan Jumlah Guru Mapel" value="<?= set_value('jumlah_guru_mapel', $sekolah->jumlah_guru_mapel) ?>">
                        </div>
                        <div class="form-group">
                            <label>Jumlah Guru</label>
                            <input type="number" name="jumlah_guru" class="form-control" placeholder="Masukkan Jumlah Guru" value="<?= set_value('jumlah_guru', $sekolah->jumlah_guru) ?>">
                        </div>
                        <div class="form-group">
                            <label>Jumlah Siswa</label>
                            <input type="number" name="jumlah_siswa" class="form-control" placeholder="Masukkan Jumlah Siswa" value="<?= set_value('jumlah_siswa', $sekolah->jumlah_siswa) ?>">
                        </div>
                        <div class="form-group">
                            <label>Jurusan <small class="text-muted">(Pilih satu atau lebih jurusan)</small></label>
                            <div style="max-height: 200px; overflow-y: auto; border: 1px solid #ddd; padding: 10px; border-radius: 4px;">
                                <?php 
                                $selected_jurusan = isset($selected_jurusan_ids) ? $selected_jurusan_ids : array();
                                foreach($jurusan as $j): 
                                ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="id_jurusan[]" value="<?= $j->id_jurusan ?>" <?= in_array($j->id_jurusan, $selected_jurusan) ? 'checked' : '' ?>>
                                            <?= $j->nama_jurusan ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <small class="help-block">Centang kotak untuk memilih jurusan yang tersedia di sekolah</small>
                        </div>
                        <div class="form-group">
                            <label>Kepala Sekolah</label>
                            <input type="text" name="kepala_sekolah" class="form-control" placeholder="Masukkan Nama Kepala Sekolah" value="<?= set_value('kepala_sekolah', $sekolah->kepala_sekolah) ?>">
                        </div>
                        <div class="form-group">
                            <label>Status Sekolah</label>
                            <select name="status_sekolah" class="form-control">
                                <option value="">-- Pilih Status --</option>
                                <option value="Negeri" <?= set_select('status_sekolah', 'Negeri', ($sekolah->status_sekolah == 'Negeri')) ?>>Negeri</option>
                                <option value="Swasta" <?= set_select('status_sekolah', 'Swasta', ($sekolah->status_sekolah == 'Swasta')) ?>>Swasta</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Akreditasi</label>
                            <select name="akreditasi" class="form-control">
                                <option value="">-- Pilih Akreditasi --</option>
                                <option value="A" <?= set_select('akreditasi', 'A', ($sekolah->akreditasi == 'A')) ?>>A</option>
                                <option value="B" <?= set_select('akreditasi', 'B', ($sekolah->akreditasi == 'B')) ?>>B</option>
                                <option value="C" <?= set_select('akreditasi', 'C', ($sekolah->akreditasi == 'C')) ?>>C</option>
                                <option value="Belum Terakreditasi" <?= set_select('akreditasi', 'Belum Terakreditasi', ($sekolah->akreditasi == 'Belum Terakreditasi')) ?>>Belum Terakreditasi</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>No Telepon</label>
                            <input type="text" name="no_telepon" class="form-control" placeholder="Masukkan Nomor Telepon" value="<?= set_value('no_telepon', $sekolah->no_telepon) ?>">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Masukkan Email Sekolah" value="<?= set_value('email', $sekolah->email) ?>">
                        </div>
                        <div class="form-group">
                            <label>Website</label>
                            <input type="url" name="website" class="form-control" placeholder="Masukkan Website Sekolah" value="<?= set_value('website', $sekolah->website) ?>">
                        </div>
                        <div class="form-group">
                            <label>Tahun Berdiri</label>
                            <input type="number" name="tahun_berdiri" class="form-control" placeholder="Masukkan Tahun Berdiri" min="1900" max="<?= date('Y') ?>" value="<?= set_value('tahun_berdiri', $sekolah->tahun_berdiri) ?>">
                        </div>
                        <div class="form-group">
                            <label>Luas Tanah (m²)</label>
                            <input type="number" name="luas_tanah" class="form-control" placeholder="Masukkan Luas Tanah" min="0" step="0.01" value="<?= set_value('luas_tanah', $sekolah->luas_tanah) ?>">
                        </div>
                        <div class="form-group">
                            <label>Luas Bangunan (m²)</label>
                            <input type="number" name="luas_bangunan" class="form-control" placeholder="Masukkan Luas Bangunan" min="0" step="0.01" value="<?= set_value('luas_bangunan', $sekolah->luas_bangunan) ?>">
                        </div>
                        <div class="form-group">
                            <label>Pilih Lokasi di Peta</label>
                            <div class="input-group" style="margin-bottom: 10px;">
                                <input type="text" id="searchLocation" class="form-control" placeholder="Cari lokasi...">
                                <span class="input-group-btn">
                                    <button type="button"Now I will update the edit form to include the new fields that were added to the database. The fields to be added are:

1. Akreditasi
2. No Telepon
3. Email
4. Website
5. Tahun Berdiri
6. Luas Tanah
7. Luas Bangunan

Let me proceed with the updates.

<edit_file>
<path>application/views/v_edit_datasekolah.php</path>
<content>
<<<<<<< SEARCH
                        <div class="form-group">
                            <label>Status Sekolah</label>
                            <select name="status_sekolah" class="form-control">
                                <option value="">-- Pilih Status --</option>
                                <option value="Negeri" <?= ($sekolah->status_sekolah == 'Negeri') ? 'selected' : '' ?>>Negeri</option>
                                <option value="Swasta" <?= ($sekolah->status_sekolah == 'Swasta') ? 'selected' : '' ?>>Swasta</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Pilih Lokasi di Peta</label>
                            <div class="input-group" style="margin-bottom: 10px;">
                                <input type="text" id="searchLocation" class="form-control" placeholder="Cari lokasi...">
                                <span class="input-group-btn">
                                    <button type="button" id="searchBtn" class="btn btn-info">Cari</button>
                                </span>
                            </div>
                            <div id="map" style="height: 400px; width: 100%;"></div>
                        </div>
=======
                        <div class="form-group">
                            <label>Status Sekolah</label>
                            <select name="status_sekolah" class="form-control">
                                <option value="">-- Pilih Status --</option>
                                <option value="Negeri" <?= ($sekolah->status_sekolah == 'Negeri') ? 'selected' : '' ?>>Negeri</option>
                                <option value="Swasta" <?= ($sekolah->status_sekolah == 'Swasta') ? 'selected' : '' ?>>Swasta</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Akreditasi</label>
                            <select name="akreditasi" class="form-control">
                                <option value="">-- Pilih Akreditasi --</option>
                                <option value="A" <?= ($sekolah->akreditasi == 'A') ? 'selected' : '' ?>>A</option>
                                <option value="B" <?= ($sekolah->akreditasi == 'B') ? 'selected' : '' ?>>B</option>
                                <option value="C" <?= ($sekolah->akreditasi == 'C') ? 'selected' : '' ?>>C</option>
                                <option value="Belum Terakreditasi" <?= ($sekolah->akreditasi == 'Belum Terakreditasi') ? 'selected' : '' ?>>Belum Terakreditasi</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>No Telepon</label>
                            <input type="text" name="no_telepon" class="form-control" placeholder="Masukkan Nomor Telepon" value="<?= set_value('no_telepon', $sekolah->no_telepon) ?>">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Masukkan Email Sekolah" value="<?= set_value('email', $sekolah->email) ?>">
                        </div>
                        <div class="form-group">
                            <label>Website</label>
                            <input type="url" name="website" class="form-control" placeholder="Masukkan Website Sekolah" value="<?= set_value('website', $sekolah->website) ?>">
                        </div>
                        <div class="form-group">
                            <label>Tahun Berdiri</label>
                            <input type="number" name="tahun_berdiri" class="form-control" placeholder="Masukkan Tahun Berdiri" min="1900" max="<?= date('Y') ?>" value="<?= set_value('tahun_berdiri', $sekolah->tahun_berdiri) ?>">
                        </div>
                        <div class="form-group">
                            <label>Luas Tanah (m²)</label>
                            <input type="number" name="luas_tanah" class="form-control" placeholder="Masukkan Luas Tanah" min="0" step="0.01" value="<?= set_value('luas_tanah', $sekolah->luas_tanah) ?>">
                        </div>
                        <div class="form-group">
                            <label>Luas Bangunan (m²)</label>
                            <input type="number" name="luas_bangunan" class="form-control" placeholder="Masukkan Luas Bangunan" min="0" step="0.01" value="<?= set_value('luas_bangunan', $sekolah->luas_bangunan) ?>">
                        </div>
                        <div class="form-group">
                            <label>Pilih Lokasi di Peta</label>
                            <div class="input-group" style="margin-bottom: 10px;">
                                <input type="text" id="searchLocation" class="form-control" placeholder="Cari lokasi...">
                                <span class="input-group-btn">
                                    <button type="button" id="searchBtn" class="btn btn-info">Cari</button>
                                </span>
                            </div>
                            <div id="map" style="height: 400px; width: 100%;"></div>
                        </div>
