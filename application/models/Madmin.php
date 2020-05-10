<?php

/**
 * 
 */
class Madmin extends CI_model
{
  public function pendaftar($tahun, $jur = '')
  {
    if ($jur != '') {
      $and =  'AND id_jurusan = ' . $jur . '';
    } else {
      $and = '';
    }
    return $this->db->query("SELECT * from rn_daftar where ta_akademik ='$tahun' $and ");
  }

  public function laporan_pendaftar($dari, $sampai, $tahun)
  {
    return $this->db->query("SELECT * from rn_daftar where tanggal between '$dari' AND '$sampai' AND konfirmasi = 'Y' OR konfirmasi ='N' AND konfirmasi !='' AND ta_akademik = '$tahun'");
  }

  public function informasi()
  {
    return $this->db->query("SELECT * from rn_informasi a, rn_admin b where a.id_admin=b.id_admin group by a.id_informasi");
  }

  public function grafik()
  {

    return $this->db->query("SELECT * from rn_daftar order by id_pendaftaran desc");
  }

  public function terima()
  {
    return $this->db->query("SELECT * from rn_daftar where ");
  }

  public function tolak($value = '')
  {
    # code...
  }

  public function pending($value = '')
  {
    # code...
  }

  public function tanggal($tanggal)
  {

    return $this->db->get_where("rn_daftar", array('tanggal' => $tanggal));
  }

  function dapatkan_table($database, $table)
  {
    $this->db->select('COLUMN_NAME,COLUMN_KEY,DATA_TYPE');
    $this->db->from('INFORMATION_SCHEMA.COLUMNS');
    $this->db->where('TABLE_SCHEMA', $database);
    $this->db->where('TABLE_NAME', $table);
    return $this->db->get();
  }

  /*--bagian grafik pada web*/

  public function grafiklulus($tanggal)
  {
    return $this->db->query("SELECT * from rn_daftar where konfirmasi ='Y' and tanggal ='$tanggal'");
  }
  public function grafiktidak_lulus($tanggal)
  {
    return $this->db->query("SELECT * from rn_daftar where konfirmasi ='N' and tanggal ='$tanggal'");
  }
  public function grafikpending($tanggal)
  {
    return $this->db->query("SELECT * from rn_daftar where konfirmasi ='P' and tanggal ='$tanggal'");
  }
  public function grafikbelumkonfirmasi($tanggal)
  {
    return $this->db->query("SELECT * from rn_daftar where konfirmasi ='' and tanggal ='$tanggal'");
  }

  function calonsiswa()
  {

    $this->db->select('*');
    $this->db->from('rn_pdb a');
    $this->db->join('test b', 'a.id_gelombang=b.id_gelombang', 'left');
    $query = $this->db->get();
    return $query;
  }

  function data_test($ta_akademik)
  {
    $this->db->select('*');
    $this->db->from('test');
    $this->db->where('id_gelombang', $ta_akademik);
    $this->db->group_by('id_test');
    $data = $this->db->get();
    return $data;
  }

  function nilai_seleksi($id_pendaftaran, $id_gelombang)
  {
    $this->db->select('*');
    $this->db->from('rank a');
    $this->db->where('a.id_siswa', $id_pendaftaran);
    $this->db->where('a.id_gelombang', $id_gelombang);
    $this->db->join('test b', 'a.id_test=b.id_test', 'left');
    return $this->db->get();
  }

  function jumlah_siswa($id_gelombang)
  {
    $this->db->select('*');
    $this->db->from('rn_daftar');
    return $this->db->get()->num_rows();
  }

  function rangking($id_pendaftaran)
  {

    $this->db->select('a.id_rank,
    a.id_siswa,
    a.id_test,
    sum(a.nilai_test) as jum_nil,
    a.tanggal,
    a.id_gelombang,


    b.id_test,
    b.nama_test,
    b.kkm,
    b.tanggal,
    b.id_gelombang,

    c.id_pendaftaran,
    c.nama_pendaftar,
    c.ta_akademik  
    ');

    $this->db->from('rank a');
    $this->db->where('c.id_pendaftaran', $id_pendaftaran);
    $this->db->join('rn_daftar c', 'a.id_siswa=c.id_pendaftaran', 'left');
    $this->db->join('test b ', 'a.id_test=b.id_test', 'left');
    $this->db->order_by('sum(a.nilai_test)', 'asc');
    $data = $this->db->get();
  }
  function value_test($id_siswa)
  {

    $data = $this->db->query("
   SELECT *  from rank a join test b on a.id_test = b.id_test where a.id_siswa = " . $id_siswa . "  
  ");
    return $data;
  }
}
