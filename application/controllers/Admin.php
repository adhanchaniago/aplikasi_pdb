<?php


/**
 * aplikasi ini di buat sepenuhnya oleh ismarianto pada 20-08-2018
 */

class Admin extends CI_controller
{
  function __construct()
  {
    parent::__construct();
    error_reporting(0);
    $this->load->model('mpendaftar');
    //  $this->load->library('Mpdf/Mpdf');
    if ($this->session->userdata('admin') != TRUE) {
      redirect(base_url());
      exit();
    }
  }
  public function index()
  {
    $x['id']   = $this->session->userdata('id_admin');
    $x['peserta'] = $this->db->get('rn_daftar')->num_rows();
    $x['terima'] = $this->db->get_where('rn_daftar', array('konfirmasi' => 'Y'))->num_rows();
    $x['ditolak'] = $this->db->get_where('rn_daftar', array('konfirmasi' => 'N'))->num_rows();
    $x['informasi'] = $this->db->get('rn_informasi')->num_rows();
    $x['judul'] = "Administrator";
    $x['admin'] = $this->db->get_where('rn_admin', array('id_admin' => $x['id']));
    $x['grafik'] = $this->madmin->grafik();
    admin_tpl('admin/home', $x);
  }

  public function pendaftar($action = "", $id = "")
  {

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if ($action == "terima") {
      if (empty($id)) {
        echo "BAD REQUEST";
        exit();
      };

      $sql = $this->db->get_where('rn_daftar', array('id_pendaftaran' => $id));
      @unlink('./assets/ijazah/' . $sql->row()->ijazah_scan);
      @unlink('./assets/kk/' . $sql->row()->kk_scan);
      @unlink('./assets/raport/' . $sql->row()->rapor_scan);
      @unlink('./assets/akta/' . $sql->row()->akta_scan);

      $data = array(
        'id_pendaftaran' => $id,
        'konfirmasi' => "Y"
      );
      $hasil = $this->db->update('rn_daftar', $data, array('id_pendaftaran' => $id));
      if ($hasil) {
        $this->session->set_flashdata('pesan', '<div class="callout callout-info">Data Berhasil Di Terima</div>');
        redirect(base_url('admin/pendaftar'));
      }
    } elseif ($action == "pending") {
      if (empty($id)) {
        echo "BAD REQUEST";
        exit();
      };
      $sql = $this->db->get_where('rn_daftar', array('id_pendaftaran' => $id));
      if ($sql->row()->konfirmasi == "Y") {
        $this->session->set_flashdata('pesan', '<div class="callout callout-warning">Perintah pending tidak bisa di Lakukan karna anda telah mengkonfirmasi lulus calon Anggota Pelatihan ini sebelumnya.</div>');
        redirect(base_url('admin/pendaftar'));
      } else {

        @unlink('./assets/ijazah/' . $sql->row()->ijazah_scan);
        @unlink('./assets/kk/' . $sql->row()->kk_scan);
        @unlink('./assets/raport/' . $sql->row()->rapor_scan);
        @unlink('./assets/akta/' . $sql->row()->akta_scan);

        $data = array(
          'id_pendaftaran' => $id,
          'konfirmasi' => "P"
        );
        $hasil = $this->db->update('rn_daftar', $data, array('id_pendaftaran' => $id));
        if ($hasil) {
          $this->session->set_flashdata('pesan', '<div class="callout callout-warning">Data Berhasil Di Pending</div>');
          redirect(base_url('admin/pendaftar'));
        }
      }
    } elseif ($action == "tolak") {
      if (empty($id)) {
        echo "BAD REQUEST";
        exit();
      };


      $data = array(
        'id_pendaftaran' => $id,
        'konfirmasi' => "N"
      );
      $hasil = $this->db->update('rn_daftar', $data, array('id_pendaftaran' => $id));
      if ($hasil) {
        $this->session->set_flashdata('pesan', '<div class="callout callout-danger">Data Berhasil Di Tolak</div>');
        redirect(base_url('admin/pendaftar'));
      }
    } elseif ($action == "delete") {

      if ($this->session->userdata('level') != "admin") {
        show_404();
        exit();
        $this->db->close();
      };

      if (empty($id)) {
        echo "BAD REQUEST";
        exit();
      };

      $sql = $this->db->get_where('rn_daftar', array('id_pendaftaran' => $id));
      @unlink('./assets/file_pendaftar/' . $sql->row()->foto);
      /*file pdf unlink*/
      @unlink('./assets/ijazah/' . $sql->row()->ijazah_scan);
      @unlink('./assets/kk/' . $sql->row()->kk_scan);
      @unlink('./assets/raport/' . $sql->row()->rapor_scan);
      @unlink('./assets/akta/' . $sql->row()->akta_scan);
      $this->db->delete('rn_daftar', array('id_pendaftaran' => $id));
      $this->session->set_flashdata('pesan', '<div class="callout callout-danger">Data Berhasil Di Hapus</div>');
      redirect(base_url('admin/pendaftar'));
    } elseif ($action == "cetak") {
      // error_reporting(0);
      if (empty($id)) {
        echo "BAD REQUEST";
        exit();
      };
      $data = $this->db->get_where('rn_daftar', array('id_pendaftaran' => $id));
      if ($data->num_rows() > 0) {

        if ($data->row()->konfirmasi == "N") {
          buat_alert('Data Belum Bisa Di Cetak Pastikan Siswa Sudah Di Terima');
        } else {
          error_reporting(0);
          $this->load->library('Mpdf/Mpdf');
          $pdf = new Mpdf();
          $pdf->AddPage('P');
          $no = $this->db->get_where('rn_daftar', array('id_pendaftaran' => $id))->row_array();
          $x['data'] = $this->mpendaftar->get_detailpeserta($no['no_pendaftaran']);
          $html = $this->load->view('admin/cetak_data_pmb', $x, TRUE);
          $pdf->SetTitle('Detail pendaftar PPDB');
          $pdf->WriteHTML($html);
          $pdf->Output('Surat teguran ' . date('Y-m-d H:i:s') . '.pdf', 'I');
        }
      } else {
        redirect(base_url('admin/404'));
        exit();
      }
    } else {
      $tahun_sekarang = tahun_akademik('id_gelombang');

      $jur = isset($_GET['jur']) ? $_GET['jur'] : '';
      if ($jur != '') {
        $x['data']  = $this->madmin->pendaftar($tahun_sekarang, $jur);
      } else {
        $x['data']  = $this->madmin->pendaftar($tahun_sekarang);
      }

      $x['judul'] = "Data Penerimaan Siswa Baru.";
      admin_tpl('admin/pendaftar', $x);
    }
  }



  public function laporan_pendaftar()
  {
    if (isset($_POST['kirim'])) {
      $t_akademik = $this->input->post('tahun_akademik');
      $x['dari'] = $this->input->post('dari');
      $x['sampai'] = $this->input->post('sampai');
      $x['tahun_akademik'] = $this->input->post('tahun_akademik');
      $x['data']  = $this->madmin->laporan_pendaftar($x['dari'], $x['sampai'], $t_akademik);
      $x['judul'] = "Laporan Pendaftaran";
      admin_tpl('admin/pendaftar_l', $x);
    } else {
      $x['judul'] = "Cari Data Psb";
      admin_tpl('admin/cari_psb', $x);
    }
  }

  public function cetak_pendaftar($action = '', $dari = '', $sampai = '', $tahun_akademik = '')
  {
    if (empty($tahun_akademik)) {
      # code...
      echo "silahkan ulangi pencarian data .";
    } else {
      if ($action == 'excel') {
        $x['judul'] = 'Rekap Hasil Kelulusan Peserta Didik Baru.';
        $x['data'] = $this->madmin->laporan_pendaftar($dari, $sampai, $tahun_akademik);
        $this->load->view('admin/kelulusan_excel', $x);
      } elseif ($action == "pdf") {
        $x['data']  = $this->madmin->laporan_pendaftar($dari, $sampai, $tahun_akademik);
        $this->load->view('admin/cetak_p_out', $x);
      } else {
        show_404('');
        exit();
      }
    }
  }


  public function hak_akses($action = '', $id = '')
  {

    if ($this->session->userdata('level') != "admin") {
      show_404();
      exit();
      $this->db->close();
    };

    if ($action == "add") {
      if (isset($_POST['kirim'])) {

        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[rn_admin.username]');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('level', 'Level / Hak Akses', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        if ($this->form_validation->run() == TRUE) {

          $config['file_name'] = 'foto' . time();
          $config['upload_path'] = "./assets/foto_admin/";
          $config['allowed_types']        = 'gif|jpg|png';
          $this->upload->initialize($config);
          if ($this->upload->do_upload('foto') == TRUE) {
            $sql = array(
              'username' => $this->input->post('username'),
              'password' => md5($this->input->post('password')),
              'email' => $this->input->post('email'),
              'level' => $this->input->post('level'),
              'foto' => $this->upload->file_name,
              'nama' => $this->input->post('nama'),
            );
            $db = $this->db->insert('rn_admin', $sql);
            if ($db) {
              if ($this->session->userdata('id_admin') == $id) {
                $this->session->set_flashdata('pesan', '<div class="callout callout-info">Data Berhasil Di Tambah</div>');
                redirect(base_url('admin/hak_akses'));
              } else {
                $this->session->set_flashdata('pesan', '<div class="callout callout-danger">Data Berhasil Di Tambah</div>');
                redirect(base_url('admin/hak_akses/add'));
              }
            }
          } else {
            $this->session->set_flashdata('pesan', $this->upload->display_errors('<div class="callout callout-info">', '</div>'));
            redirect(base_url('admin/hak_akses/add'));
          }
        } else {
          $this->session->set_flashdata('pesan', validation_errors('<div class="callout callout-danger">', '</div>'));
          redirect(base_url('admin/hak_akses/add'));
        }
      } else {
        $x['form'] = 'y';
        $x['username'] = "";
        $x['nama'] = "";
        $x['gambar'] = "";
        $x['jk'] = "";
        $x['judul'] = "Hak Akses";
        $x['aksi'] = "add";
        admin_tpl('admin/hak_akses', $x);
      }
    } elseif ($action == "edit") {

      /*$id=$this->session->userdata('id_admin');*/
      $data = $this->db->get_where('rn_admin', array('id_admin' => $id));
      if (isset($_POST['kirim'])) {

        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[rn_admin.username]');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('level', 'Level / Hak Akses', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        if ($this->form_validation->run() == TRUE) {

          $config['file_name'] = 'foto' . time();
          $config['allowed_types'] = 'png|jpg';
          $config['upload_path'] = "./assets/foto_admin";
          $this->upload->initialize($config);
          if ($this->upload->do_upload('foto') == TRUE) {
            @unlink('./assets/gambar/' . $data->row()->gambar);
            $sql = array(
              'username' => $this->input->post('username'),
              'password' => md5($this->input->post('password')),
              'email' => $this->input->post('email'),
              'level' => $this->input->post('level'),
              'foto' => $this->upload->file_name,
              'nama' => $this->input->post('nama'),
            );
            $db = $this->db->update('rn_admin', $sql, array('id_admin' => $id));
            if ($db) {

              if ($this->session->userdata('id_admin') == $id) {
                $this->session->set_flashdata('pesan', '<div class="callout callout-danger">Data Berhasil Di edit password Anda Di Ubah Menjadi' . $this->input->post('password') . '</div>');
                redirect(base_url('admin/hak_akses/edit/' . $id));
              } else {
                $this->session->set_flashdata('pesan', '<div class="callout callout-danger">Data Berhasil Di edit</div>');
                redirect(base_url('admin/hak_akses/'));
              }
            } else {
              buat_alert('sql ERROR');
            }
          } else {
            $this->session->set_flashdata('pesan', $this->upload->display_errors('<div class="callout callout-info">', '</div>'));
            redirect(base_url('admin/hak_akses/edit/' . $id));
          }
        } else {
          $this->session->set_flashdata('pesan', validation_errors('<div class="callout callout-danger">', '</div>'));
          redirect(base_url('admin/hak_akses/edit/' . $id));
        }
      } else {
        $x['form'] = 'y';
        $x['username'] = $data->row()->username;
        $x['nama'] = $data->row()->nama;
        $x['gambar'] = $data->row()->foto;
        $x['judul'] = "Hak Akses";
        $x['aksi'] = "add";
        admin_tpl('admin/hak_akses', $x);
      }
    } elseif ($action == "delete") {
      if ($this->session->userdata('id_admin') == $id) {
        $this->session->set_flashdata('pesan', '<div class="callout callout-danger">Anda Tidak Dapat Menghapus Anda Sendiri</div>');
        redirect(base_url('admin/hak_akses'));
      } else {
        $data = $this->db->get_where('admin', array('id_admin' => $id));
        @unlink('assets/foto_admin/' . $data->row()->gambar);
        $this->db->delete('admin', array('id_admin' => $id));
        $this->session->set_flashdata('pesan', '<div class="callout callout-danger">Berhasil Di Hapus</div>');
        redirect(base_url('admin/hak_akses'));
      }
    } else {
      $x['form'] = 'n';
      $x['judul'] = "Hak Akses";
      $x['data'] = $this->db->get('rn_admin');
      admin_tpl('admin/hak_akses', $x);
    }
  }

  /*bagian artikel*/

  public function informasi($aksi = '', $id = '')
  {
    if ($aksi == "add") {
      $x['judul']   = "Informasi";
      $x['id']      = "";
      $x['judul_i']   = "";
      $x['isi']     = "";
      $x['id_admin'] = "";
      $x['tanggal'] = "";
      $x['aksi']    = "add";

      if (isset($_POST['kirim'])) {

        $config['allowed_types'] = "jpg|png|bmp";
        $config['file_name'] = time();
        $config['upload_path'] = "./assets/gambar";

        $this->upload->initialize($config);
        if ($this->upload->do_upload('gambar') == TRUE) {
          $sql = array(

            'judul' => $this->input->post('judul_i'),
            'isi'   => $this->input->post('isi'),
            'gambar'   => $this->upload->file_name,
            'id_admin' => $this->session->userdata('id_admin'),
            'tanggal' => date('Y-m-d')
          );

          $cek = $this->db->insert('rn_informasi', $sql);
          if ($cek) {
            $this->session->set_flashdata('pesan', '<div class="callout callout-info">Informasi berhasil di tambahkan</div>');
            redirect(base_url('admin/informasi'));
          } else {
            buat_alert("Error");
          }
        } else {
          $this->session->set_flashdata('pesan', $this->upload->display_errors('<div class="callout callout-danger">', '</div>'));
          redirect(base_url('admin/informasi'));
        }
      } else {
        admin_tpl('admin/informasi_form', $x);
      }
      //batas codingan ..

    } elseif ($aksi == "edit") {
      if (empty($id)) {
        show_404();
        $this->db->close();
      };

      $x['sql']    = $this->db->get_where('rn_informasi', array('id_informasi' => $id));
      $admin       = $this->db->get_where('rn_admin', array('id_admin' => $x['sql']->row()->id_admin));
      $x['aksi']    = "edit";
      $x['judul']   = "Informasi";
      $x['gambar']   = $x['sql']->row()->gambar;
      $x['id']      = $x['sql']->row()->id_admin;
      $x['judul_i'] = $x['sql']->row()->judul;
      $x['isi']     = $x['sql']->row()->isi;
      $x['id_admin'] = strip_tags($admin->row()->nama);
      $x['tanggal'] = $x['sql']->row()->tanggal;

      if (isset($_POST['kirim'])) {

        if (empty($_FILES['gambar']['name'])) {

          $sql = array(
            'judul' => $this->input->post('judul_i'),
            'isi'   => $this->input->post('isi'),
            'id_admin' => $this->session->userdata('id_admin'),
            'tanggal' => date('Y-m-d')
          );

          $cek = $this->db->update('rn_informasi', $sql, array('id_informasi' => $id));
          if ($cek) {
            $this->session->set_flashdata('pesan', '<div class="callout callout-info">Informasi berhasil di tambahkan</div>');
            redirect(base_url('admin/informasi'));
          } else {
            buat_alert("Error");
          }
        } else {
          $config['allowed_types'] = "jpg|png|bmp";
          $config['file_name'] = time();
          $config['upload_path'] = "./assets/gambar";

          $this->upload->initialize($config);
          if ($this->upload->do_upload('gambar') == TRUE) {
            @unlink('./assets/gambar/' . $x['gambar']);
            $sql = array(

              'judul' => $this->input->post('judul_i'),
              'isi'   => $this->input->post('isi'),
              'gambar'   => $this->upload->file_name,
              'id_admin' => $this->session->userdata('id_admin'),
              'tanggal' => date('Y-m-d')
            );

            $cek = $this->db->update('rn_informasi', $sql, array('id_informasi' => $id));
            if ($cek) {
              $this->session->set_flashdata('pesan', '<div class="callout callout-info">Informasi berhasil di tambahkan</div>');
              redirect(base_url('admin/informasi'));
            } else {
              buat_alert("Error");
            }
          } else {
            $this->session->set_flashdata('pesan', $this->upload->display_errors('<div class="callout callout-danger">', '</div>'));
            redirect(base_url('admin/informasi'));
          }
        }
      } else {
        admin_tpl('admin/informasi_form', $x);
      }
      /*batas akhir kodingan*/
    } elseif ($aksi == "delete") {

      if ($this->session->userdata('level') != "admin") {
        show_404();
        exit();
        $this->db->close();
      };


      if (empty($id)) {
        show_404();
        $this->db->close();
      };
      $data = $this->db->get_where('rn_informasi', array('id_informasi' => $id));
      @unlink('./assets/gambar/' . $data->row()->gambar);
      $cek = $this->db->delete('rn_informasi', array('id_informasi' => $id));
      $this->session->set_flashdata('pesan', '<div class="callout callout-danger">Informasi berhasil di Hapus</div>');
      redirect(base_url('admin/informasi'));
    } else {
      $x = array(
        'judul' => 'Informasi dan penguman',
        'info' => $this->madmin->informasi()
      );
      admin_tpl('admin/informasi', $x);
    }
  }

  /*end bagian artikel*/



  public function identitas($action = "", $id = '')
  {

    if ($this->session->userdata('level') != "admin") {
      show_404();
      exit();
      $this->db->close();
    };

    if ($action == "edit") {
      if (empty($id)) {
        redirect(base_url('admin/404'));
      };
      $cek = $this->db->get_where('rn_setting', array('parameter' => $id));
      if ($cek->num_rows() > 0) {

        if (isset($_POST['kirim'])) {
          if ($id == "favicon") {

            $config['allowed_types'] = "jpg|png|bmp";
            $config['file_name'] = time();
            $config['upload_path'] = "./assets/gambar";

            $this->upload->initialize($config);
            if ($this->upload->do_upload('nilai') == TRUE) {

              $arr = array('nilai' => $this->upload->file_name);
              $this->db->update('rn_setting', $arr, array('parameter' => $id));
              $this->session->set_flashdata('pesan', '<div class="callout callout-info">Dat Berhasil Di Perbarui</div>');
              redirect(base_url('admin/identitas'));
            } else {
              $this->session->set_flashdata('pesan', $this->upload->display_errors('<div class="callout callout-danger">', '</div>'));
              redirect(base_url('admin/identitas/edit/' . $id));
            }
          } else {

            $arr = array('nilai' => $this->input->post('nilai'));
            $this->db->update('rn_setting', $arr, array('parameter' => $id));
            $this->session->set_flashdata('pesan', '<div class="callout callout-info">Dat Berhasil Di Perbarui</div>');
            redirect(base_url('admin/identitas'));
          }
        } else {
          $x['data']   = $this->db->get_where('rn_setting', array('parameter' => $id));
          $x['form']  =  "edit";
          $x['id']    = $id;
          $x['judul'] = "Indentitas";
          admin_tpl('admin/identitas', $x);
        }
      } else {
        show_404();
        $this->db->close();
        exit();
      }
    } else {

      $x['data']   = $this->db->get('rn_setting');
      $x['form']  =  "n";
      $x['judul'] = "Indentitas";
      admin_tpl('admin/identitas', $x);
    }
  }


  public function setting_app($action = '', $id = '')
  {
    if ($this->session->userdata('level') != "admin") {
      show_404();
      exit();
      $this->db->close();
    };


    if ($id) {
      $q = $this->db->get_where('rn_pdb', array('id_gelombang' => $id));
      if ($q->num_rows() > 0) {
        $x['keterangan'] = $q->row()->keterangan;
        $x['t_mulai'] = $q->row()->tgl_mulai;
        $x['t_selesai'] = $q->row()->tgl_selesai;
        $x['kuota'] = $q->row()->kuota;
        $x['ta_akademik'] = $q->row()->ta_akademik;
      } else {
        redirect(base_url('admin/setting_app'));
      }
    } else {
      $x['keterangan'] = '';
      $x['t_mulai'] = '';
      $x['t_selesai'] = '';
      $x['kuota'] = '';
      $x['ta_akademik'] = '';
    }

    if ($action == 'add') {
      if (isset($_POST['kirim'])) {
        $this->form_validation->set_rules('ta_akademik', 'Tahun Akademik', 'is_unique[rn_pdb.ta_akademik]|required');
        $this->form_validation->set_rules('keterangan', 'gelombang aktif', 'is_unique[rn_pdb.keterangan]|required');
        if ($this->form_validation->run()) {

          $insert = [
            'keterangan' => $this->input->post("keterangan"),
            'tgl_mulai' => $this->input->post("t_mulai"),
            'tgl_selesai' => $this->input->post("t_selesai"),
            'kuota' => $this->input->post("kuota"),
            'ta_akademik' => $this->input->post("ta_akademik"),
          ];
          $this->db->insert('rn_pdb', $insert);
          $this->session->set_flashdata('pesan', '<div class="callout callout-info">Berhasil di tambahkan.</div>');
          redirect(base_url('admin/setting_app'));
        } else {
          $this->session->set_flashdata('pesan', validation_errors('<div class="callout callout-info">Berhasil di tambahkan.</div>'));
          redirect(base_url('admin/setting_app'));
        }
      } else {
        $x['action'] = 'form';
        $x['sekarang'] = date("Y");
        $x['berikutnya'] = date("Y");
        $x['judul'] = "Setting Penerimaan Anggota Baru Pada Tahun " . $x['sekarang'] . "-" . ++$x['berikutnya'];
        admin_tpl('admin/setting_pdb', $x);
      }
    } elseif ($action == 'edit') {
      if (isset($_POST['kirim'])) {
        $this->form_validation->set_rules('keterangan', 'gelombang aktif', 'is_unique[rn_pdb.keterangan]|required');
        if ($this->form_validation->run()) {
          $update = [
            'keterangan' => $this->input->post("keterangan"),
            'tgl_mulai' => $this->input->post("t_mulai"),
            'tgl_selesai' => $this->input->post("t_selesai"),
            'kuota' => $this->input->post("kuota"),
            'ta_akademik' => $this->input->post("ta_akademik"),
          ];
          $this->db->update('rn_pdb', $update, array('id_gelombang' => $id));
          $this->session->set_flashdata('pesan', '<div class="callout callout-info">Data berhasil di edit.</div>');
          redirect(base_url('admin/setting_app'));
        } else {
          $this->session->set_flashdata('pesan', validation_errors('<div class="callout callout-info">', '</div>'));
          redirect(base_url('admin/setting_app'));
        }
      } else {
        $x['action'] = 'form';
        $x['sekarang'] = date("Y");
        $x['berikutnya'] = date("Y");
        $x['judul'] = "Setting Penerimaan Anggota Baru Pada Tahun " . $x['sekarang'] . "-" . ++$x['berikutnya'];
        admin_tpl('admin/setting_pdb', $x);
      }
    } elseif ($action == 'delete') {
      $this->db->delete('rn_pdb', array('id_gelombang' => $id));
      $this->session->set_flashdata('pesan', '<div class="callout callout-info">Data berhasil di hapus.</div>');
      redirect(base_url('admin/setting_app'));
    } else {
      $sql = $this->db->get('rn_pdb');
      $x['action'] = 'view';
      $x['sekarang'] = date("Y");
      $x['berikutnya'] = date("Y");
      $x['judul'] = "Setting Penerimaan Anggota Baru Pada Tahun " . $x['sekarang'] . "-" . ++$x['berikutnya'];
      admin_tpl('admin/setting_pdb', $x);
    }
  }



  public function profil($value = '')
  {
    $id = $this->session->userdata('id_admin');
    if (isset($_POST['kirim'])) {

      $this->form_validation->set_rules('nama', 'Nama', 'required');
      $this->form_validation->set_rules('username', 'Username', 'required|is_unique[rn_admin.username]');
      $this->form_validation->set_rules('password', 'Password', 'required');

      if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata('pesan', validation_errors('<div class="callout callout-danger">', '</div>'));
        redirect(base_url('admin/profil'));
      } else {

        $config['file_name'] = "foto_admin" . time();
        $config['upload_path'] = "./assets/foto_admin/";
        $config['allowed_types'] = "png|jpg";

        $this->upload->initialize($config);
        if ($this->upload->do_upload('admin')) {

          $sql = $this->db->get_where('rn_daftar', array('id_pendaftaran' => $this->session->userdata('id_admin')));
          @unlink('./assets/foto_admin/' . $sql->row()->foto);

          $data = array(
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password')),
            'nama' => $this->input->post('nama'),
            'foto' => $this->upload->file_name,
          );
          $cek = $this->db->update('rn_admin', $data, array('id_admin' => $id));
          if ($cek) {
            $this->session->set_flashdata('pesan', '<div class="callout callout-info">Data Berhasil Di Update</div>');
            redirect(base_url('admin/profil'));
          } else {
          }
        } else {
          $this->session->set_flashdata($this->upload->display_errors('pesan', '<div class="callout callout-info">', '</div>'));
          redirect(base_url('admin/profil'));
        }
      }
    } else {
      $x['admin'] = $this->db->get_where('rn_admin', array('id_admin' => $id));
      $x['judul'] = "Update profil";
      $x['username'] = $x['admin']->row()->username;
      $x['nama'] = $x['admin']->row()->nama;
      $x['gambar'] = $x['admin']->row()->foto;
      $x['aksi'] = "Edit Profil";
      admin_tpl('admin/profil', $x);
    }
  }
  function export($type = '')
  {

    $tahun_sekarang = tahun_akademik('id_gelombang');
    if ($type == 'word') {
      header("Content-Disposition: attachment; filename=Data-Rekap-PPDB-" . $tahun_sekarang . ".rtf");  //File name extension was wrong
      header("Expires: 0");
      header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
      header("Cache-Control: private", false);
    } else {
      header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
      header("Content-Disposition: attachment; filename=Data-Rekap-PPDB-" . $tahun_sekarang . ".xls");  //File name extension was wrong
      header("Expires: 0");
      header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
      header("Cache-Control: private", false);
    }
    $jur = isset($_GET['jur']) ? $_GET['jur'] : '';
    if ($jur != '') {
      $x['data']  = $this->madmin->pendaftar($tahun_sekarang, $jur);
    } else {
      $x['data']  = $this->madmin->pendaftar($tahun_sekarang);
    }

    $this->load->view('admin/xlsx_pendaftar', $x);
  }


  public function slider_bg($action = '', $id = '')
  {

    if ($action == "add") :
      if (isset($_POST['kirim'])) {
        $config['file_name']     = "slider" . time();
        $config['upload_path']   = "./assets/gambar/";
        $config['allowed_types'] = "png|jpeg|jpg|";
        $this->upload->initialize($config);
        if ($this->upload->do_upload('gambar')) {

          $data = array(
            'gambar' => $this->upload->file_name,
            'keterangan' => $this->input->post('keterangan'),
            'id_admin' => $this->session->userdata('id_admin'),
            'tanggal' => date("Y-m-d")
          );
          $this->db->insert('rn_slider', $data);
          $this->session->set_flashdata('pesan', '<div class="callout callout-info">Data Berhasil Tambahkan .</div>');
          redirect(base_url('admin/slider_bg'));
        } else {
          $this->session->set_flashdata('pesan', $this->upload->display_errors('<div class="callout callout-info">', '</div>'));
          redirect(base_url('admin/slider_bg/add'));
        }
      } else {
        $x['form'] = 'y';
        $x['aksi'] = "add";
        $x['judul'] = "Tambah Slide Tampilan";
        $x['gambar'] = '';
        $x['keterangan'] = "";
        admin_tpl('admin/slider', $x);
      } elseif ($action == "edit") :
      if (empty($id)) {
        redirect(base_url('404'));
      };
      $data = $this->db->get_where('rn_slider', array('id_slider' => $id));
      if (isset($_POST['kirim'])) {
        $config['file_name']     = "slider" . time();
        $config['upload_path']   = "assets/gambar/";
        $config['allowed_types'] = "png|jpeg|jpg|";
        $this->upload->initialize($config);
        if ($this->upload->do_upload('gambar')) {
          $data = array(
            'gambar' => $this->upload->file_name,
            'keterangan' => $this->input->post('keterangan'),
            'id_admin' => $this->session->userdata('id_admin'),
            'tanggal' => date("Y-m-d")
          );
          $this->db->update('rn_slider', $data, array('id_slider' => $id));
          $this->session->set_flashdata('pesan', '<div class="callout callout-warning">Data Berhasil Edit .</div>');
          redirect(base_url('admin/slider_bg/edit/' . $id));
        } else {
          $this->session->set_flashdata('pesan', $this->upload->display_errors('<div class="callout callout-info">', '</div>'));
          redirect(base_url('admin/slider_bg/edit/' . $id));
        }
      } else {
        $x['form']   = 'y';
        $x['aksi']   = "edit";
        $x['judul'] = "Edit Slide Tampilan";
        $x['gambar'] = $data->row()->gambar;
        $x['keterangan'] = $data->row()->keterangan;
        admin_tpl('admin/slider', $x);
      } elseif ($action == "delete") :
      if (empty($id)) {
        redirect(base_url('404'));
      };
      $data = $this->db->get_where('rn_slider', array('id_slider' => $id));
      @unlink('assets/gambar/' . $data->row()->gambar);
      $this->db->delete('rn_slider', array('id_slider' => $id));
      $this->session->set_flashdata('pesan', '<div class="callout callout-danger">Data Berhasil Di Hapus .</div>');
      redirect(base_url('admin/slider_bg'));
    else :
      $x['data'] = $this->db->get('rn_slider');
      $x['form'] = 'n';
      $x['gambar'] = "";
      $x['judul'] = "Slide Tampilan";
      admin_tpl('admin/slider', $x);

    endif;
  }

  public function grafik()
  {
    $x['all_siswa'] = $this->db->get('rn_daftar');
    $x['diterima'] = $this->db->get_where('rn_daftar', array('konfirmasi' => 'Y'));
    $x['ditolak'] = $this->db->get_where('rn_daftar', array('konfirmasi' => 'N'));
    $x['pending'] = $this->db->get_where('rn_daftar', array('konfirmasi' => 'P'));
    $x['kosong'] = $this->db->get_where('rn_daftar', array('konfirmasi' => ''));
    $x['judul'] = "Grafik Penerimaan Anggota Pelatihan ";
    admin_tpl('admin/grafik', $x);
  }


  function jurusan($action = '', $id = '')
  {

    if ($id) {
      $sql = $this->db->get_where('rn_jurusan', array('id_jurusan' => $id));
      $x = [
        'id_jurusan' => $sql->row()->id_jurusan,
        'nama_jurusan' => $sql->row()->nama_jurusan,
        'kode_jurusan' => $sql->row()->kode_jurusan,
      ];
    } else {
      $x = [
        'id_jurusan' => '',
        'nama_jurusan' => '',
        'kode_jurusan' => '',
      ];
    }
    if ($action == 'add') {
      if (isset($_POST['kirim'])) {
        print_r($_POST);
        $data = array(
          'nama_jurusan' => $this->input->post('nama_jurusan'),
          'kode_jurusan' => $this->input->post('kode_jurusan'),
        );
        $cek = $this->db->insert('rn_jurusan', $data);
        if ($cek) {
          $this->session->set_flashdata('pesan', '<div class="callout callout-info">Insert data jurusan berhasil.</div>');
          redirect(base_url('admin/jurusan'));
        } else {
          $this->session->set_flashdata('pesan', '<div class="callout callout-info">Gagal data jurusan.</div>');
          redirect(base_url('admin/jurusan'));
        }
      } else {
        $x['form'] = 'y';
        $x['judul'] = 'Add data jurusan';
        admin_tpl('admin/jurusan', $x);
      }
    } elseif ($action == 'edit') {
      if (isset($_POST['kirim'])) {
        $data = array(
          'nama_jurusan' => $this->input->post('nama_jurusan'),
          'kode_jurusan' => $this->input->post('kode_jurusan'),
        );
        $cek = $this->db->update('rn_jurusan', $data, array('id_jurusan' => $id));
        if ($cek) {
          $this->session->set_flashdata('pesan', '<div class="callout callout-info">Insert data jurusan berhasil.</div>');
          redirect(base_url('admin/jurusan'));
        } else {
          $this->session->set_flashdata('pesan', '<div class="callout callout-info">Gagal data jurusan.</div>');
          redirect(base_url('admin/jurusan'));
        }
      } else {
        $x['form'] = 'y';
        $x['judul'] = 'Edit data jurusan';
        admin_tpl('admin/jurusan', $x);
      }
    } elseif ($action == 'delete') {

      $cek = $this->db->delete('rn_jurusan', array('id_jurusan' => $id));
      if ($cek) {
        $this->session->set_flashdata('pesan', '<div class="callout callout-info">Insert data jurusan berhasil.</div>');
        redirect(base_url('admin/jurusan'));
      } else {
        $this->session->set_flashdata('pesan', '<div class="callout callout-info">Gagal data jurusan.</div>');
        redirect(base_url('admin/jurusan'));
      }
    } else {
      if (isset($_POST['kirim'])) {
        # code...
      } else {
        $x['judul'] = 'Data Jurusan';
        $x['form'] = 'n';
        $x['data'] = $this->db->get('rn_jurusan');
        admin_tpl('admin/jurusan', $x);
      }
    }
  }


  function rank($action = '', $id = '')
  {
    if ($this->session->userdata('level') != "admin") {
      show_404();
      exit();
      $this->db->close();
    };


    if ($id) {
      $sql = $this->db->get_where('test', array('id_test' => $id));
      if ($sql->num_rows() > 0) {
        $x['id_test'] = $sql->row()->id_test;
        $x['nama_test'] = $sql->row()->nama_test;
        $x['kkm'] = $sql->row()->kkm;
        $x['tanggal'] = $sql->row()->tanggal;
        $x['id_gelombang'] = $sql->row()->id_gelombang;
      } else {
        redirect(base_url('admin/rank'));
      }
    } else {
      $x['id_test'] = '';
      $x['nama_test'] = '';
      $x['kkm'] = '';
      $x['tanggal'] = '';
      $x['id_gelombang'] = '';
    }

    if ($action == 'add') {
      if (isset($_POST['kirim'])) {
        $this->form_validation->set_rules('nama_test', 'Nama Test', 'required');
        if ($this->form_validation->run()) {
          $insert = [
            'nama_test' => $this->input->post("nama_test"),
            'kkm' => $this->input->post("kkm"),
            'id_gelombang' => $this->input->post("t_akademik")
          ];
          $this->db->insert('test', $insert);
          $this->session->set_flashdata('pesan', '<div class="callout callout-info">Berhasil di tambahkan.</div>');
          redirect(base_url('admin/rank'));
        } else {
          $this->session->set_flashdata('pesan', validation_errors('<div class="callout callout-danger">', '</div>'));
          redirect(base_url('admin/rank'));
        }
      } else {
        $x['action'] = 'form';
        $x['sekarang'] = date("Y");
        $x['berikutnya'] = date("Y");
        $x['judul'] = "Setting Penerimaan Siswa Baru Pada Tahun " . $x['sekarang'] . "-" . ++$x['berikutnya'];
        admin_tpl('admin/rangking', $x);
      }
    } elseif ($action == 'edit') {
      if (isset($_POST['kirim'])) {
        $this->form_validation->set_rules('nama_test', 'Nama Test', 'required');
        if ($this->form_validation->run()) {
          $update = [
            'nama_test' => $this->input->post("nama_test"),
            'kkm' => $this->input->post("kkm"),
            'id_gelombang' => $this->input->post("t_akademik")
          ];
          $this->db->update('test', $update, array('id_test' => $id));
          $this->session->set_flashdata('pesan', '<div class="callout callout-info">Berhasil di tambahkan.</div>');
          redirect(base_url('admin/rank'));
        } else {
          $this->session->set_flashdata('pesan', validation_errors('<div class="callout callout-info">Berhasil di tambahkan.</div>'));
          redirect(base_url('admin/rank'));
        }
      } else {
        $x['action'] = 'form';
        $x['sekarang'] = date("Y");
        $x['berikutnya'] = date("Y");
        $x['judul'] = "Setting Penerimaan Siswa Baru Pada Tahun " . $x['sekarang'] . "-" . ++$x['berikutnya'];
        admin_tpl('admin/rangking', $x);
      }
    } elseif ($action == 'delete') {
      $this->db->delete('test', array('id_test' => $id));
      $this->session->set_flashdata('pesan', '<div class="callout callout-info">Data berhasil di hapus.</div>');
      redirect(base_url('admin/rank'));
    } else {
      $sql = $this->db->get('rank');
      $x['action'] = 'view';
      $x['judul'] = "Data rangking pendaftar";
      admin_tpl('admin/rangking', $x);
    }
  }

  function pendaftar_edit($id)
  {
    $sdata = [
      'no_pendaftaran' => $this->input->post('no_pendaftaran'),
      'nama_pendaftar' => $this->input->post('nama_pendaftar'),
      'jk' => $this->input->post('jk'),
      'nik' => $this->input->post('nik'),
      'tempat_lahir' => $this->input->post('tempat_lahir'),
      'tanggal_lahir' => $this->input->post('tanggal_lahir'),
      'agama' => $this->input->post('agama'),
      'rt' => $this->input->post('rt'),
      'rw' => $this->input->post('rw'),
      'desa_kelurahan' => $this->input->post('desa_kelurahan'),
      'kecamatan' => $this->input->post('kecamatan'),
      'kabupaten' => $this->input->post('kabupaten'),
      'provinsi' => $this->input->post('provinsi'),
      'kode_pos' => $this->input->post('kode_pos'),
      'tinggi_badan' => $this->input->post('tinggi_badan'),
      'berat_badan' => $this->input->post('berat_badan'),
      'no_telepon' => $this->input->post('no_telepon'),
      'alat_transportasi' => $this->input->post('alat_transportasi'),
      'prestasi' => $this->input->post('prestasi'),
      'nama_ayah' => $this->input->post('nama_ayah'),
      'tahun_lahir_ayah' => $this->input->post('tahun_lahir_ayah'),
      'pekerjaan_ayah' => $this->input->post('pekerjaan_ayah'),
      'pendidikan_ayah' => $this->input->post('pendidikan_ayah'),
      'penghasilan_ayah' => $this->input->post('penghasilan_ayah'),
      'nama_ibu' => $this->input->post('nama_ibu'),
      'tahun_lahir_ibu' => $this->input->post('tahun_lahir_ibu'),
      'pekerjaan_ibu' => $this->input->post('pekerjaan_ibu'),
      'pendidikan_ibu' => $this->input->post('pendidikan_ibu'),
      'penghasilan_ibu' => $this->input->post('penghasilan_ibu'),
      'nama_wali' => $this->input->post('nama_wali'),
      'tahun_lahir_wali' => $this->input->post('tahun_lahir_wali'),
      'pekerjaan_wali' => $this->input->post('pekerjaan_wali'),
      'pendidikan_wali' => $this->input->post('pendidikan_wali'),
      'penghasilan_wali' => $this->input->post('penghasilan_wali')
    ];

    if ($_FILES['gambar']['name'] != '') {
      $config['file_name'] = 'foto' . time();
      $config['upload_path'] = "./assets/file_pendaftar/";
      $config['allowed_types']        = 'gif|jpg|png';
      $data = $this->db->get_where('rn_daftar', array('id_pendaftaran' => $this->session->userdata('id_pendaftaran')));
      $this->upload->initialize($config);
      if ($this->upload->do_upload('foto') == true) {
        @unlink('./assets/file_pendaftar/' . $data->row()->foto);
        $sql = array('foto' => $this->upload->file_name);
        $merge = array_merge($sql, $sdata);
        $cek = $this->db->update('rn_daftar', $merge, array('id_pendaftaran' => $this->session->userdata('id_pendaftaran')));
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
      $this->db->update('rn_daftar', $sdata, array('id_pendaftaran' => $id));
      $this->session->set_flashdata('pesan', '<div class="callout callout-info">Data berhasil di edit.</div>');
      redirect(base_url('admin/pendaftar'));
    }
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
