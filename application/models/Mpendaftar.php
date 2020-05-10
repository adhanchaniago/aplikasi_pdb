<?php
class Mpendaftar extends CI_model
{

    public function no_daftar()
    {
        return $this->db->query("SELECT max(id_pendaftaran)  as no_daftar from rn_daftar ");
    }


    //peserta detail with nilai test 

    function get_detailpeserta($no_daftar)
    {
        return $this->db->select('
                                a.id_pendaftaran,
                                a.id_jurusan,
                                a.no_pendaftaran,
                                a.nama_pendaftar,
                                a.jk,
                                a.nik,
                                a.foto,
                                a.tempat_lahir,
                                a.tanggal_lahir,
                                a.agama,
                                a.nama_ayah,
                                a.tahun_lahir_ayah,
                                a.pekerjaan_ayah,
                                a.pendidikan_ayah,
                                a.penghasilan_ayah,
                                a.nama_ibu,
                                a.tahun_lahir_ibu,
                                a.pekerjaan_ibu,
                                a.pendidikan_ibu,
                                a.penghasilan_ibu,
                                a.nama_wali,
                                a.tahun_lahir_wali,
                                a.pekerjaan_wali,
                                a.pendidikan_wali,
                                a.penghasilan_wali,
                                a.jenis_tinggal,
                                a.rt,
                                a.rw,
                                a.desa_kelurahan,
                                a.kecamatan,
                                a.kabupaten,
                                a.provinsi,
                                a.kode_pos,
                                a.tinggi_badan,
                                a.berat_badan,
                                a.nomor_telp_rumah,
                                a.no_telepon,
                                a.jurusan,
                                a.jarak_sekolah,
                                a.alat_transportasi,
                                a.prestasi,
                                a.alamat_email,
                                a.tanggal,
                                a.konfirmasi,
                                a.ta_akademik,
                                a.sekolah_asal,
                                a.alamat_sekolah_asal,
                                a.rapor_scan,
                                a.ijazah_scan,
                                a.kk_scan,
                                a.akta_scan,

                                b.id_jurusan,
                                b.nama_jurusan,
                                b.kode_jurusan,

                                trverifikasirapor.id,
                                trverifikasirapor.tmverifikasi_id,
                                trverifikasirapor.pendaftaran_id,
                                trverifikasirapor.nilai,
                                trverifikasirapor.date_create,

                                tmverifikasi_rapor.id,
                                tmverifikasi_rapor.mapel_uji,
                                tmverifikasi_rapor.kkm,
                                tmverifikasi_rapor.create_at,
                                tmverifikasi_rapor.user_id,     
        ')
            ->from('rn_daftar a')
            ->join('rn_jurusan b', 'a.id_jurusan=b.id_jurusan', 'left')
            ->join('trverifikasirapor', 'trverifikasirapor.pendaftaran_id=a.id_pendaftaran', 'left')
            ->join('tmverifikasi_rapor', 'tmverifikasi_rapor.id=trverifikasirapor.tmverifikasi_id', 'left')
            ->where('a.no_pendaftaran', $no_daftar)
            ->get();
    }


    function getMapel($no_daftar)
    {
        return $this->db->query('
                    SELECT
                    *
                    FROM
                    tmverifikasi_rapor
                    INNER JOIN
                    trverifikasirapor
                    ON 
                    tmverifikasi_rapor.id = trverifikasirapor.tmverifikasi_id
                    INNER JOIN
                    rn_daftar
                    ON 
                    trverifikasirapor.pendaftaran_id = rn_daftar.id_pendaftaran
                    where  rn_daftar.no_pendaftaran = "' . $no_daftar . '"        
        ');
    }

    function getUji($gelombang_id)
    {
        return $this->db->query(" 
                    SELECT
                    *
                    FROM
                    rn_pdb
                    INNER JOIN
                    test
                    ON 
                    rn_pdb.id_gelombang = test.id_gelombang 
                    where rn_pdb.id_gelombang = '" . $gelombang_id . "'
        ");
    }
}
