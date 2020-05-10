<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
class Home extends CI_Controller
{


  function ___construct()
  {
    parent::__construct();
    $this->load->model('mpendaftar');
  }

  function get_wilayah($params)
  {
    //Get Data Kabupaten
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "http://api.rajaongkir.com/starter/city",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "key: diisi dengan api key milik sobat"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    echo "<label>Kota Asal</label><br>";
    echo "<select name='asal' id='asal'>";
    echo "<option>Pilih Kota Asal</option>";
    $data = json_decode($response, true);
    for ($i = 0; $i < count($data['rajaongkir']['results']); $i++) {
      echo "<option value='" . $data['rajaongkir']['results'][$i]['city_id'] . "'>" . $data['rajaongkir']['results'][$i]['city_name'] . "</option>";
    }
    echo "</select><br><br><br>";
    //Get Data Kabupaten


    //-----------------------------------------------------------------------------

    //Get Data Provinsi
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "key: diisi dengan api key milik sobat"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    echo "Provinsi Tujuan<br>";
    echo "<select name='provinsi' id='provinsi'>";
    echo "<option>Pilih Provinsi Tujuan</option>";
    $data = json_decode($response, true);
    for ($i = 0; $i < count($data['rajaongkir']['results']); $i++) {
      echo "<option value='" . $data['rajaongkir']['results'][$i]['province_id'] . "'>" . $data['rajaongkir']['results'][$i]['province'] . "</option>";
    }
    echo "</select><br><br>";
    //Get Data Provinsi

  }

  public function index()
  {
    $x['artikel'] = $this->mlogin->limit_depan();
    $x['judul'] = strip_tags(cari('judul'));
    $x['content'] = "depan";
    $this->load->view('home', $x);
  }

  public function pendaftaran()
  {
    $data = $this->mpendaftar->no_daftar();
    $no_pendaftaran = $data->row()->no_daftar;
    $no_pendaftaran++;

    $tahun = substr(date('Y-m-d'), -3);
    if ($no_pendaftaran == 1) {
      $nomor = 1;
    } else {
      $nomor = $no_pendaftaran + 1;
    }
    $no_daftar_h = 'PSB' . $tahun . '-' . $nomor;

    $data = $this->db->get('rn_pdb');
    $x['sekarang'] = date("Y");
    $x['sampai']   = date("Y");
    $x['tutup']    = $data->row()->keterangan;
    $x['no_pendaftaran'] = $no_daftar_h;
    $x['nilai_rapor'] = $this->db->get('tmverifikasi_rapor');
    $x['judul'] = 'PPDB-' . cari('nama');
    $x['content'] = "daftar";
    $this->load->view('home', $x);
  }


  public function pendaftaran_action()
  {
    $data = $this->mpendaftar->no_daftar();
    $no_pendaftaran = $data->row()->no_daftar;
    $no_pendaftaran++;

    $tahun = substr(date('Y-m-d'), -3);
    if ($no_pendaftaran == 1) {
      $nomor = 1;
    } else {
      $nomor = $no_pendaftaran + 1;
    }
    $no_daftar_h = 'PSB' . $tahun . '-' . $nomor;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      $sql = $this->db->get('rn_pdb');
      $sql_pendaftar = $this->db->get('rn_pdb', array('ta_akademik' => tahun_akademik('id_gelombang')));
      $kuota = $this->db->get_where('rn_pdb', array('id_gelombang' => tahun_akademik('id_gelombang')))->row_array();
      if ($sql_pendaftar->num_rows() == $kuota['kuota']) {
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Maaf Kuota pendaftaran sudah melebihi batas silahkan hubungi panitian penerimaan siswa baru</div>');
        exit();
      };
      $cek = $sql->row()->keterangan;
      if ($cek == "N") {
        redirect(base_url('404'));
        exit();
        $this->db->close();
      }


      $config = array(
        array(
          'field'   => 'no_pendaftaran',
          'label'   => 'Nomor Pendaftaran',
          'rules'   => 'required|is_unique[rn_daftar.no_pendaftaran]',
        ),

        array(
          'field'   => 'nama_pendaftar',
          'label'   => 'Nama Pendaftar',
          'rules'   => 'required'
        ),

        array(
          'field'   => 'jk',
          'label'   => 'Jenis Kelamin',
          'rules'   => 'required'
        )
      );

      //  $session_captcha=$this->session->userdata('mycaptcha');
      //  $kode_keamanan=$this->input->post('kode_rahasia');
      $this->form_validation->set_rules($config);
      if ($this->form_validation->run() == TRUE) {
        // if($kode_keamanan != $session_captcha){
        //   $this->session->set_flashdata('pesan','<div class="alert alert-danger">Kode Keamanan Tidak Cocok.</div>');
        //   redirect(base_url('pendaftaran.jsp'));
        // // }else{ 
        // if (empty($_FILES['rapor_scan'])  and empty($_FILES['ijazah_scan']) and empty($_FILES['kk_scan']) and empty($_FILES['akta_scan'])) {
        //   $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Berkash Pdf Harus Di isi.</div>');
        //   redirect(base_url('pendaftaran.jsp'));
        // } else {  
        $sebelum = date("Y");
        $sekarang = date("Y");
        $t_sekarang = tahun_akademik('id_gelombang');
        $this->db->trans_start();

        $Datasql = array(
          'no_pendaftaran' => $no_daftar_h,
          'nama_pendaftar' => $this->input->post('nama_pendaftar'),
          'jk' => $this->input->post('jk'),

          'tempat_lahir' => $this->input->post('tempat_lahir'),
          'tanggal_lahir' => $this->input->post('tanggal_lahir'),
          'agama' => $this->input->post('agama'),
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
          'id_jurusan' => $this->input->post('id_jurusan'),
          'penghasilan_wali' => $this->input->post('penghasilan_wali'),
          'jenis_tinggal' => $this->input->post('jenis_tinggal'),
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
          'tanggal' => date('Y-m-d'),
          'ta_akademik' => $t_sekarang,
          'konfirmasi' => 'EMPTY'
        );

        $cek = $this->db->insert('rn_daftar', $Datasql);
        $insert_id = $this->db->insert_id();
        $tmverifikasi = $this->db->get('tmverifikasi_rapor');
        foreach ($tmverifikasi->result() as $key) {
          $nilai = $this->input->post(str_replace(' ', '_', strtolower($key->mapel_uji)));
          $data = array('tmverifikasi_id' => $key->id, 'nilai' => $nilai, 'pendaftaran_id' => $insert_id);
          $this->db->insert('trverifikasirapor', $data);
        }
        $this->db->trans_complete();
        if ($cek) {
          $json =  array('status' => 1, 'msg' => 'pendaftaran berhasil', 'no_daftar' => $no_daftar_h, 'md' => sha1(md5($no_daftar_h)));
          echo json_encode($json);
        }
      } else {
        $json =  array('status' => 2, 'msg' => strip_tags(validation_errors()));
        echo json_encode($json);
      }
    } else {
    }
  }

  private function get_data_c($no_pendaftaran)
  {
    $this->db->select('*');
    $this->db->from('rn_daftar a');
    $this->db->join('rn_jurusan b', 'a.id_jurusan=b.id_jurusan', 'left');
    $this->db->where('a.no_pendaftaran', $no_pendaftaran);
    $this->db->group_by('a.id_pendaftaran');
    return $this->db->get();
  }
  public function cek_lulus()
  {
    if (isset($_POST['periksa'])) {
      $no_pendaftaran = barasiah($this->input->post('no_pendaftaran'));
      $cek = self::get_data_c($no_pendaftaran);

      if ($cek->num_rows() > 0 and $cek->row()->konfirmasi != "P") {
        $x['id']    = $no_pendaftaran;
        $x['judul'] = "Cek Kelulusan";
        $x['content'] = "hasil";
        $x['data'] = $this->mpendaftar->get_detailpeserta($no_pendaftaran);
        $this->load->view('home', $x);
      } elseif ($cek->row()->konfirmasi == "P") {
        $this->session->set_flashdata('pesan', '<div class="alert alert-info">Maaf Nomor Pendaftaran Akan Segera Diaktifkan</div>');
        redirect(base_url('cek-lulus.jsp'));
      } else {
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Maaf Nomor Pendaftaran Tidak Terdaftar Pada Sistem Kami</div>');
        redirect(base_url('cek-lulus.jsp'));
      }
    } else {
      $x['judul'] = "Cek Data Kelulusan";
      $x['content'] = "cek_lulus";
      $this->load->view('home', $x);
    }
  }


  public function login()
  {
    $username  = barasiah($this->input->post('username'));
    $password  = barasiah($this->input->post('password'));
    $admin = $this->mlogin->login_admin($username, md5($password));
    $pendaftar = $this->mlogin->login_pendaftar($username, $password);
    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');
    if ($this->form_validation->run() == TRUE) {
      if ($admin->num_rows() > 0) {
        $session_admin = array(
          'id_admin' => $admin->row()->id_admin,
          'username' =>  $admin->row()->username,
          'nama' =>      $admin->row()->nama,
          'log' =>       date('Y-m-d h:i:s'),
          'level' =>     $admin->row()->level,
          'admin' => TRUE
        );

        $this->session->set_userdata($session_admin);

        $_SESSION['KCFINDER']              = array();
        $_SESSION['KCFINDER']['disabled']  = false;
        $_SESSION['KCFINDER']['uploadURL'] = base_url('assets/data/');


        echo "admin";
      } elseif ($pendaftar->num_rows() > 0) {
        $session_Pegawai = array(
          'id_pendaftaran' => $pendaftar->row()->id_pendaftaran,
          'no_pendaftaran' =>  $pendaftar->row()->no_pendaftaran,
          'pendaftar' => TRUE
        );

        $this->session->set_userdata($session_Pegawai);
        echo "siswa";
      } else {
      }
    } else {
      echo validation_errors('<div class="alert alert-danger">', '</div>');
    }
  }


  public function detail_p($no_daftar, $hash)
  {
    if ($no_daftar != '') {
      if (sha1(md5($no_daftar)) === $hash) {
        $x['no_daftar'] = $no_daftar;
        $x['id'] = $no_daftar;
        $x['judul'] = "Detail Pendaftaran Siswa";
        $x['content'] = "hasil";
        $x['data'] = $this->mpendaftar->get_detailpeserta($no_daftar);
        $this->load->view('home', $x);
      } else {
        $request = array('msg' => 'data tidak terparsing denagn baik');
        echo json_encode($request);
      }
    } else {
      $request = array('msg' => 'data tidak terparsing denagn baik');
      echo json_encode($request);
    }
  }

  public function cetak_data_sementara($id)
  {
    if (empty($id)) {
      redirect(base_url('/404'));
    };
    $cek = $this->db->get_where('rn_daftar', array('no_pendaftaran' => $id));
    if ($cek->num_rows() > $id) {
      $x['id'] = $id;
      $x['judul'] = "Detail Pendaftaran Siswa";
      $x['data'] = $this->mpendaftar->get_detailpeserta($id);
      $this->load->view('hasil_pdf', $x);
    } else {
      echo "BAD required";
    } # code...
  }

  /*end bagian */
  public function error_404()
  {
    $x['pesan'] = "Maaf halaman yang anda cari tidak di temukan";
    $this->load->view('404', $x);
  }


  public function tampil_artikel($posisi = '4')
  {

    $artikel = $this->mlogin->artikel_depan($posisi);
    $no = 1;
    echo ' <div class="row">
  <ul class="list-unstyled">';

    foreach ($artikel->result_array() as $data) :
      $admin = $this->db->get_where('rn_admin', array('id_admin' => $data['id_admin']));
      echo '<li class="media">
    <img class="img-responsive mr-3" src="' . base_url('./assets/gambar/' . $data['gambar']) . '" alt="' . $data['judul'] . '" onerror="this.src = ' . base_url('/assets/no-image.jpg') . '" style="width: 100px;height: 100px">
    <div class="media-body">
    <h5 class="mt-0 mb-1"><a href="" onclick="return detailArtikel(' . $data['id_informasi'] . ')">' . strip_tags(ucfirst($data['judul'])) . '</a></h5>
    ' . character_limiter(strip_tags($data['isi'], 100)) . '
    </div>
    <button onclick="return detailArtikel(' . $data['id_informasi'] . ')" class="btn btn-success">Baca Selengkapnya</button>
    </li><hr />';

      $no++;
    endforeach;
    echo "</ul></div>";
  }

  public function detail_berita($id)
  {
    if (empty($id)) {
      redirect(base_url('404'));
      exit();
    };
    $x['artikel'] = $this->mlogin->artikel();
    $x['data'] = $this->db->get_where('rn_informasi', array('id_informasi' => $id));
    $this->load->view('artikel_detail', $x);
  }

  public function pengumuman()
  {
    $x['pengumuman']  = $this->mlogin->limit_depan();
    $x['judul'] = "Data Pengumuman";
    $x['content'] = "pengumuman";
    $this->load->view('home', $x);
  }


  function webcam()
  {
    if (isset($_POST['simpan'])) {
      $img = $_POST['image'];
      $folderPath = "assets/ijazah/";

      $image_parts = explode(";base64,", $img);
      $image_type_aux = explode("image/", $image_parts[0]);
      $image_type = $image_type_aux[1];

      $image_base64 = base64_decode($image_parts[1]);
      $fileName = uniqid() . '.png';

      $file = $folderPath . $fileName;
      file_put_contents($file, $image_base64);

      print_r($fileName);
    } else {
      $this->load->view('admin/webcam');
    }
  }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
