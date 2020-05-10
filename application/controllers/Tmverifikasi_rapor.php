<?php

/*developed by ismarianto putra
  you can visit my site in ismarianto.com
  for more complain anda more information.  
*/

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tmverifikasi_rapor extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tmverifikasi_rapor_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
        if ($this->session->userdata('admin') != TRUE) {
            redirect(base_url());
            exit();
        }
    }

    public function index()
    {
        $x['judul'] = 'list data verifikasi';
        return admin_tpl('tmverifikasi_rapor/tmverifikasi_rapor_list', $x);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Tmverifikasi_rapor_model->json();
    }

    public function detail($id)
    {
        $row = $this->Tmverifikasi_rapor_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'mapel_uji' => $row->mapel_uji,
                'kkm' => $row->kkm,
                'create_at' => $row->create_at,
                'user_id' => $row->user_id,
                'judul' => 'master data verifikasi rapor',
            );
            admin_tpl('tmverifikasi_rapor/tmverifikasi_rapor_read', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warniing fade-in">Data Tidak Di Temukan.</div>');
            redirect(site_url('tmverifikasi_rapor'));
        }
    }

    public function tambah()
    {
        $data = array(
            'judul' => 'Tambah Tmverifikasi rapor',
            'button' => 'Create',
            'action' => site_url('tmverifikasi_rapor/tambah_data'),
            'id' => set_value('id'),
            'mapel_uji' => set_value('mapel_uji'),
            'kkm' => set_value('kkm'),
            'create_at' => set_value('create_at'),
            'user_id' => set_value('user_id'),
        );
        admin_tpl('tmverifikasi_rapor/tmverifikasi_rapor_form', $data);
    }

    public function tambah_data()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
        } else {
            $data = array(
                'mapel_uji' => $this->input->post('mapel_uji', TRUE),
                'kkm' => $this->input->post('kkm', TRUE),
                'create_at' => date('Y-m-d'),
                'user_id' => $this->session->userdata('id_admin'),
            );

            $this->Tmverifikasi_rapor_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success fade-in"><i class="fa fa-check"></i>Data Berhasil Di Tambahkan.</div>');
            redirect(site_url('tmverifikasi_rapor'));
        }
    }

    public function edit($id)
    {
        $row = $this->Tmverifikasi_rapor_model->get_by_id($id);

        if ($row) {
            $data = array(
                'judul' => 'Edit master verifikasi lapor',
                'button' => 'Update',
                'action' => site_url('tmverifikasi_rapor/edit_data'),
                'id' => set_value('id', $row->id),
                'mapel_uji' => set_value('mapel_uji', $row->mapel_uji),
                'kkm' => set_value('kkm', $row->kkm),
                'create_at' => set_value('create_at', $row->create_at),
                'user_id' => set_value('user_id', $row->user_id),
            );
            admin_tpl('tmverifikasi_rapor/tmverifikasi_rapor_form', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-info fade-in">Data Tidak Di Temukan.</div>');
            redirect(site_url('tmverifikasi_rapor'));
        }
    }

    public function edit_data()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('id', TRUE));
        } else {
            $data = array(
                'mapel_uji' => $this->input->post('mapel_uji', TRUE),
                'kkm' => $this->input->post('kkm', TRUE),
                'create_at' => date('Y-m-d'),
                'user_id' => $this->session->userdata('id_admin'),
            );

            $this->Tmverifikasi_rapor_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success fade-in"><i class="fa fa-check"></i>Edit Data Berhasil.</div>');
            redirect(site_url('tmverifikasi_rapor'));
        }
    }

    public function hapus($id)
    {
        $row = $this->Tmverifikasi_rapor_model->get_by_id($id);

        if ($row) {
            $this->Tmverifikasi_rapor_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert alert-danger fade-in"><i class="fa fa-check"></i>Data Berhasil Di Hapus</div>');
            redirect(site_url('tmverifikasi_rapor'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warniing fade-in">Ops Something Went Wrong Please Contact Administrator.</div>');
            redirect(site_url('tmverifikasi_rapor'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('mapel_uji', 'mapel uji', 'trim|required');
        $this->form_validation->set_rules('kkm', 'kkm', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
