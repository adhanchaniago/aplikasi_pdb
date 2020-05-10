<?php 
function barasiah($nilai='')
{
	 $filter = stripslashes(strip_tags(htmlspecialchars($nilai,ENT_QUOTES)));
    return $filter;
}

function rangking($id_pendaftaran,$id_gelombang){
  $CI =& get_instance();
  // $jum=$CI->db->get_where('rn_daftar',array('ta_akademik'=>$id_gelombang));
  // $CI->db->select('sum(a.nilai_test) / count(a.id_test) as jum_tes ,count(c.id_pendaftaran) as jum_pen,a.*');
  // $CI->db->from('rank a'); 
  // $CI->db->where('a.id_gelombang',$id_gelombang);
  // $CI->db->where('c.id_pendaftaran',$id_pendaftaran);
  // $CI->db->join('test b','a.id_test=b.id_test','left');
  // $CI->db->join('rn_daftar c','a.id_siswa=c.id_pendaftaran','left');
  // $CI->db->order_by('jum_tes','asc');
  // $hasil = $CI->db->get()->row_array(); 
  // return $hasil['jum_pen'];   

  // $CI->db->select('sum(a.nilai_test) / count(a.id_test) as jum_tes ,count(c.id_pendaftaran) as jum_pen,a.*');
  // $CI->db->from('rank a'); 
  // $CI->db->where('a.id_gelombang',$id_gelombang);
  // $CI->db->where('c.id_pendaftaran',$id_pendaftaran);
  // $CI->db->join('test b','a.id_test=b.id_test','left');
  // $CI->db->join('rn_daftar c','a.id_siswa=c.id_pendaftaran','left');
  // $CI->db->order_by('jum_tes','asc');
  // $hasil = $CI->db->get()->row_array(); 
  // print_r($hasil);
  // return $hasil['juara'];  
  
  $CI->db->select('id_siswa, SUM(nilai_test) as nilai');
  $CI->db->from('rank');
  $CI->db->where('id_gelombang',$id_gelombang);
  $CI->db->group_by('id_siswa');
  $CI->db->order_by('nilai','desc');
  $hasil = $CI->db->get()->result_array();
  $data = array();
  foreach($hasil as $key=>$res){
    $data[$res['id_siswa']] = array('nilai' => $res['nilai'], 'rangking' => $key + 1);
  }
  
  // echo "<pre>";
  // print_r($data);
  // echo "</pre>";
  return $data[$id_pendaftaran]['rangking'];
}  

function rata_rata($id_pendaftaran,$id_gelombang){
  $CI =& get_instance();
  // $jum=$CI->db->get_where('rn_daftar',array('ta_akademik'=>$id_gelombang));
  $CI->db->select('sum(a.nilai_test) as jum,count(a.id_test) as jum_tes ,a.*');
  $CI->db->from('rank a');
  $CI->db->where('a.id_siswa',$id_pendaftaran);
  $CI->db->where('a.id_gelombang',$id_gelombang);
  $CI->db->join('test b','a.id_test=b.id_test','left');
  $CI->db->order_by('a.nilai_test','desc');
  $hasil = $CI->db->get()->row_array(); 
  $chr=$hasil['jum'] / $hasil['jum_tes'];
 /*rata rata nilai*/
  return $chr;
  

}  

/*bagian form*/

function tahun_akademik($param){
 $CI =& get_instance();
 $CI->db->select('
  id_gelombang,
  keterangan,
  ta_akademik,
  tgl_mulai,
  tgl_selesai');

 $CI->db->where('ta_akademik',date("Y"));
 $CI->db->where('keterangan','Y'); 
 $CI->db->limit('1');
 $data= $CI->db->get('rn_pdb')->row_array();
 return $data[$param];
}

 
function cari($data)
{
 $CI =& get_instance();
 $sql=$CI->db->get_where("rn_setting",array('parameter'=>$data));
 return $sql->row()->nilai;
}

 

function buka_form($action='')
{
 echo '
 <form action="" method="POST" enctype="multipart/form-data">
 <table class="table table-striped">';   
}

function buat_text_box($label='',$type='text',$name='',$value='')
{
  echo "<tr><th>".$label."</th><td><input type='".$type."' name='".$name."' class='form-control' value='".$value."'></td></tr>"; 
}

function buat_select($label='',$name='',$array='')
{
  echo "<tr><th>".$label."</th><td><select class='form-control' name='".$name."'>";     
 
  foreach($array as $arr => $val):
          echo "<option value='".$arr."'>".$val."</option>";
   endforeach;
echo "</select></td></tr>";
}


function tutup_form($name='kirim',$action='Simpan Data')
{
  echo '
 <tr><td><input type="submit" name="kirim" class="btn btn-info" value="'.$action.'">
         <input type="reset" class="btn btn-danger" value="Batal"></td><td></td></tr>
 </table>';   
}



  function tpl($konten,$array)
  {
  $CI =& get_instance();
  $CI->load->view('template/header',$array);
  $CI->load->view($konten);
  $CI->load->view('template/footer');
  }

  function admin_tpl($konten,$array)
  {

  $CI =& get_instance();
  $CI->load->view('template/header_admin',$array);
  $CI->load->view($konten);
  $CI->load->view('template/footer');
  }



function buat_alert($pesan){
  echo'<script type="text/javascript">alert("'.$pesan.'");window.location.href="javascript:history.back()"; </script>'; 
  }


function tgl_indonesia($tgl){
  $nama_bulan = array(1=>"Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    
  $tanggal = substr($tgl,8,2);
  $bulan = $nama_bulan[(int)substr($tgl,5,2)];
  $tahun = substr($tgl,0,4);
  
  return $tanggal.' '.$bulan.' '.$tahun;     
} 


function notif($kalimat='',$warna='')
{
  echo '<div class="alert alert-'.$warna.' alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                 '.$kalimat.'.
                            </div>'; 
}