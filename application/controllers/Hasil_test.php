<?php 

 /**
  * 
  */
 class Hasil_test extends CI_controller
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 		if ($this->session->userdata('admin') != TRUE) {
 			redirect(base_url());
 			exit();
 		} 
 		$this->load->model('madmin');
 	}

 	function index(){

 		ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

 		$t_akad = trim(tahun_akademik('id_gelombang'));
 		$data=$this->madmin->data_test($t_akad);
 		
 		// print_r($_POST);
 		// exit();   
 		$get_info = $this->madmin->nilai_seleksi($this->input->post('id_pendaftaran'),$t_akad);
 		$get_db = $this->db->get_where('test',array('id_gelombang'=>$t_akad)); 
 		$no=1;
 		foreach ($get_db->result() as $key) { 
 			$insert = [ 
 				'id_siswa'=>$this->input->post('id_pendaftaran'),
 				'id_test'=>$this->input->post('test_id'.$key->id_test),
 				'nilai_test'=>$this->input->post('v_test'.$key->id_test),
 				'tanggal'=>date('Y-m-d'),
 				'id_gelombang'=>$t_akad,
 			];  
 			if($get_info->num_rows() == 0){  
 				$cek=$this->db->insert('rank',$insert);  
 			}else{
 				$where = array('id_test'=>$this->input->post('test_id'.$key->id_test),'id_siswa'=>$this->input->post('id_pendaftaran'));
 				$cek=$this->db->update('rank',$insert,$where);  
 			} 
 			$no++;
 		 } 		

 		// foreach($data->result_array() as $s):
 		// 	$cek_smua = $this->db->get_where('rn_daftar',array('ta_akademik'=>$t_akad));
 		// 	$rk_smua = $this->db->select('*')
 		// 	->from('rank')
 		// 	->where('id_siswa',$this->input->post('id_pendaftaran'))
 		// 	->group_by('id_siswa')
 		// 	->get(); 
 		// 	$jsm = $cek_smua->num_rows(); 
 		// 	if ($jsm == $rk_smua) {  
 		// 		$this->session->set_flashdata('pesan','<div class="alert alert-danger">semua sudah di ranking</div>');
 		// 		redirect(base_url('admin/pendaftar'));
 		// 	}else{ 

 		// 		$id_test = $this->input->post('tes'.$s['id_test']);
 		// 		$get_info = $this->madmin->nilai_seleksi($this->input->post('id_pendaftaran'),$t_akad);

 		// 		$insert = [ 
 		// 			'id_siswa'=>$this->input->post('id_pendaftaran'),
 		// 			'id_test'=>$this->input->post('test'.$s['id_test'].''),
 		// 			'nilai_test'=>$this->input->post('nilai_test'.$s['id_test'].''),
 		// 			'tanggal'=>date('Y-m-d'),
 		// 			'id_gelombang'=>tahun_akademik('id_gelombang'),
 		// 		];  
 		// 		if($get_info == ''){  
 		// 			$cek=$this->db->insert('rank',$insert);  
 		// 		}else{
 		// 			$cek=$this->db->update('rank',$insert,array('id_siswa'=>$this->input->post('id_pendaftaran')));  

 		// 		}
 				$this->session->set_flashdata('pesan','<div class="callout callout-info">Data berhasil update</div>');
 				redirect(base_url('admin/pendaftar'));
 		// 	}
 		// endforeach;        
 	}
 }