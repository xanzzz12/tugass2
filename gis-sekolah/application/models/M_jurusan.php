<?php

class M_jurusan extends CI_Model {

    public function simpan($data)
    {
        $this->db->insert('tbl_jurusan', $data);
    }

    public function tampil()
    {
        $this->db->select('*');
        $this->db->from('tbl_jurusan');
        $this->db->order_by('nama_jurusan', 'asc');
        return $this->db->get()->result();
    }

    public function detail($id_jurusan)
    {
        $this->db->select('*');
        $this->db->from('tbl_jurusan');
        $this->db->where('id_jurusan', $id_jurusan);
        return $this->db->get()->row();
    }

    public function edit($data)
    {
        $this->db->where('id_jurusan', $data['id_jurusan']);
        $this->db->update('tbl_jurusan', $data);
    }

    public function hapus($data)
    {
        $this->db->where('id_jurusan', $data['id_jurusan']);
        $this->db->delete('tbl_jurusan', $data);
    }

    public function get_jurusan_by_sekolah($id_sekolah)
    {
        $this->db->select('tbl_jurusan.*');
        $this->db->from('tbl_jurusan');
        $this->db->join('tbl_sekolah_jurusan', 'tbl_sekolah_jurusan.id_jurusan = tbl_jurusan.id_jurusan');
        $this->db->where('tbl_sekolah_jurusan.id_sekolah', $id_sekolah);
        return $this->db->get()->result();
    }

    public function simpan_jurusan_sekolah($id_sekolah, $jurusan_ids)
    {
        // Hapus relasi lama
        $this->db->where('id_sekolah', $id_sekolah);
        $this->db->delete('tbl_sekolah_jurusan');

        // Tambah relasi baru
        if (!empty($jurusan_ids)) {
            foreach ($jurusan_ids as $id_jurusan) {
                $data = array(
                    'id_sekolah' => $id_sekolah,
                    'id_jurusan' => $id_jurusan
                );
                $this->db->insert('tbl_sekolah_jurusan', $data);
            }
        }
    }

    public function get_selected_jurusan($id_sekolah)
    {
        $this->db->select('id_jurusan');
        $this->db->from('tbl_sekolah_jurusan');
        $this->db->where('id_sekolah', $id_sekolah);
        $result = $this->db->get()->result();
        
        $selected = array();
        foreach ($result as $row) {
            $selected[] = $row->id_jurusan;
        }
        return $selected;
    }
}

?>
