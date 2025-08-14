<?php

class M_sekolah extends CI_Model {

    // Method untuk menyimpan data sekolah
    public function simpan($data)
    {
        $this->db->insert('tbl_sekolah', $data);
        return $this->db->insert_id();
    }

    // Method untuk menampilkan data sekolah
    public function tampil()
    {
        $this->db->select('*');
        $this->db->from('tbl_sekolah');
        $this->db->order_by('id_sekolah', 'desc');
        return $this->db->get()->result();
    }

    // Method untuk mengambil detail data sekolah
    public function detail($id_sekolah)
    {
        $this->db->select('*');
        $this->db->from('tbl_sekolah');
        $this->db->where('id_sekolah', $id_sekolah);
        return $this->db->get()->row();
    }

    // Method untuk mengedit data sekolah
    public function edit($data)
    {
        $this->db->where('id_sekolah', $data['id_sekolah']);
        $this->db->update('tbl_sekolah', $data);
    }

    // Method untuk menghapus data sekolah
    public function hapus($data)
    {
        $this->db->where('id_sekolah', $data['id_sekolah']);
        $this->db->delete('tbl_sekolah', $data);
    }

    // Method untuk menyimpan data guru per mata pelajaran
    public function simpan_guru_mapel($data_guru_mapel)
    {
        $this->db->insert('tbl_guru_mapel', $data_guru_mapel);
    }

    // Method untuk mengambil data guru per mata pelajaran
    public function get_guru_mapel($id_sekolah)
    {
        $this->db->select('*');
        $this->db->from('tbl_guru_mapel');
        $this->db->where('id_sekolah', $id_sekolah);
        return $this->db->get()->result();
    }

    // Method untuk menghapus data guru per mata pelajaran berdasarkan id_sekolah
    public function hapus_guru_mapel_by_sekolah($id_sekolah)
    {
        $this->db->where('id_sekolah', $id_sekolah);
        $this->db->delete('tbl_guru_mapel');
    }

    // Method untuk menampilkan jurusan yang terkait dengan sekolah
    public function tampil_jurusan($id_sekolah)
    {
        $this->db->select('*');
        $this->db->from('tbl_jurusan');
        $this->db->where('id_sekolah', $id_sekolah);
        return $this->db->get()->result();
    }

    // Method untuk menyimpan data jurusan untuk sekolah
    public function simpan_jurusan($data_jurusan)
    {
        $this->db->insert('tbl_jurusan', $data_jurusan);
    }

    // Method untuk menghapus jurusan yang terkait dengan sekolah
    public function hapus_jurusan_by_sekolah($id_sekolah)
    {
        $this->db->where('id_sekolah', $id_sekolah);
        $this->db->delete('tbl_jurusan');
    }
}

?>
