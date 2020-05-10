<?php 
echo $this->session->flashdata('pesan');

buka_form();
buat_text_box('Username','','username',$username);
buat_text_box('Nama','','nama',$nama);
buat_text_box('Password','password','password','');
echo "<img src='".base_url('/assets/foto_admin/'.$gambar)."' class='image-responsive' style='width:120px; height:120px'  onerror=\"this.src = '".base_url('/assets/no-image.jpg')."'\">";
buat_text_box('Foto','file','admin','');
tutup_form($aksi);


?>