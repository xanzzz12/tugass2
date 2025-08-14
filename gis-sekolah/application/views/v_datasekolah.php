<?php
// Cek role untuk menentukan tampilan
$is_admin = $this->session->userdata('role') == 'admin';
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Data Sekolah
            <small>Daftar Sekolah</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('home') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Data Sekolah</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Daftar Sekolah</h3>
                        <?php if ($is_admin): ?>
                            <div class="pull-right">
                                <a href="<?= base_url('sekolah/input') ?>" class="btn btn-primary">
                                    <i class="fa fa-plus"></i> Tambah Sekolah
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="box-body">
                        <?php if ($this->session->flashdata('pesan')): ?>
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="icon fa fa-check"></i> <?= $this->session->flashdata('pesan') ?>
                            </div>
                        <?php endif; ?>

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Sekolah</th>
                                    <th>Alamat</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>Jumlah Guru Mapel</th>
                                    <th>Jumlah Guru</th>
                                    <th>Jumlah Siswa</th>
                                    <th>Kepala Sekolah</th>
                                    <th>Status Sekolah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($sekolah as $key => $value): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $value->nama_sekolah ?></td>
                                    <td><?= $value->alamat ?></td>
                                    <td><?= $value->latitude ?></td>
                                    <td><?= $value->longitude ?></td>
                                    <td><?= $value->jumlah_guru_mapel ?></td>
                                    <td><?= $value->jumlah_guru ?></td>
                                    <td><?= $value->jumlah_siswa ?></td>
                                    <td><?= $value->kepala_sekolah ?></td>
                                    <td><?= $value->status_sekolah ?></td>
                                    <td>
                                        <a href="<?= base_url('sekolah/detail/' . $value->id_sekolah) ?>" class="btn btn-info btn-sm">
                                            <i class="fa fa-eye"></i> Detail
                                        </a>
                                        <?php if ($is_admin): ?>
                                            <a href="<?= base_url('sekolah/edit/' . $value->id_sekolah) ?>" class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                            <a href="<?= base_url('sekolah/hapus/' . $value->id_sekolah) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="fa fa-trash"></i> Hapus
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
