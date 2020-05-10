<?php
class Pendaftar extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('mpendaftar');
    if ($this->session->userdata('pendaftar') != TRUE) {
      redirect(base_url());
      exit();
    }
  }

  public function index()
  {
    $id = $this->session->userdata('id_pendaftaran');
    $x['judul'] = "pendaftar";
    $x['pendaftar'] = $this->db->get_where('rn_daftar', array('id_pendaftaran' => $id));
    $this->db->select('*');
    $this->db->from('rn_daftar a');
    $this->db->join('rn_jurusan b', 'a.id_jurusan=b.id_jurusan', 'left');
    $this->db->where('a.id_pendaftaran', $id);
    $this->db->group_by('a.id_pendaftaran');
    $x['dat'] = $this->db->get()->result_array();
    tpl('pendaftar/home', $x);
  }
  public function profil($action = '')
  {
    if ($action == 'cetak') {
      $id = $this->session->userdata('id_pendaftaran');
      $x['cetak'] = TRUE;
      $x['judul'] = "Profil Pendaftar";
      $x['dat'] = $this->db->get_where('rn_daftar', array('id_pendaftaran' => $id))->result_array();
      $this->load->view('pendaftar/profil', $x);
    } else {
      $id = $this->session->userdata('id_pendaftaran');
      $x['cetak'] = FALSE;
      $x['judul'] = "Profil Pendaftar";
      $x['dat'] = $this->db->get_where('rn_daftar', array('id_pendaftaran' => $id))->result_array();
      tpl('pendaftar/profil', $x);
    }
  }

  public function upload_foto($value = '')
  {

    if (isset($_POST)) {

      $config['file_name'] = 'foto' . time();
      $config['upload_path'] = "./assets/file_pendaftar/";
      $config['allowed_types']        = 'gif|jpg|png';

      $data = $this->db->get_where('rn_daftar', array('id_pendaftaran' => $this->session->userdata('id_pendaftaran')));

      $this->upload->initialize($config);
      if ($this->upload->do_upload('foto') == TRUE) {
        @unlink('./assets/file_pendaftar/' . $data->row()->foto);
        $sql = array('foto' => $this->upload->file_name);
        $cek = $this->db->update('rn_daftar', $sql, array('id_pendaftaran' => $this->session->userdata('id_pendaftaran')));
        if ($cek) {
          $this->session->set_flashdata('pesan', '<div class="callout callout-info">File Berhasil Di Upload.</div>');
          redirect(base_url('pendaftar'));
        } else {
          buat_alert('Komunikasi sql GAGAL');
        }
      } else {
        $this->session->set_flashdata('pesan', $this->upload->display_errors('<div class="callout callout-danger">', '</div>'));
        redirect(base_url('pendaftar'));
      }
    } else {
      echo "BAD REQUEST";
    }
  }


  function kartu_ujian()
  {
    $gelombang_id = strip_tags(tahun_akademik('id_gelombang'));
    $data = $this->mpendaftar->getUji($gelombang_id);
    $x = [
      'data' => $data,
      'title' => 'cetak kartu ujian',
    ];
    $this->load->view('pendaftar/kartu_ujian', $x);
  }

  public function keluar()
  {

    $this->session->sess_destroy();
    session_start();
    session_destroy();

    unset($_SESSION['KCFINDER']);
    unset($_SESSION['KCFINDER']['uploadURL']);
    redirect(base_url('/?rt=YES'));
  }
}
