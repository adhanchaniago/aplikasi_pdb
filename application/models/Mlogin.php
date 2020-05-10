<?php 

/**
* 
*/
class Mlogin extends CI_model
{
 
public function login_admin($username,$password)
	{
	 return $this->db->query("SELECT * FROM
	 	rn_admin where username='$username' AND password='$password'
	 	limit 1
	 	");
	}

	public function login_pendaftar($username,$password)
	{
	 return $this->db->query("SELECT * from rn_daftar  where no_pendaftaran ='$username' AND tanggal_lahir ='$password' AND konfirmasi ='Y' limit 1");
	}


	public function artikel_depan($limit='')
	{
	 return $this->db->query("SELECT * from rn_informasi order by id_informasi desc limit $limit",4);
	}

	public function artikel()
	{
	 return $this->db->query("SELECT * from rn_informasi order by rand() desc limit 6");
	}

	public function limit_depan()
	{
	return $this->db->query('SELECT * from rn_informasi order by id_informasi desc limit 3');
	}


}