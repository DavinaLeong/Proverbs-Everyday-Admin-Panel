<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: Translation.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 20 Dec 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
class Translation extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->load->model('Translation_model');
	}

    public function browse_translation()
    {
        $this->User_log_model->validate_access();
        $data = array(
            'translations' => $this->Translation_model->get_all()
        );
        $this->load->view('translation/browse_translation_page', $data);
    }

    public function new_translation()
    {
        $this->User_log_model->validate_access();
        $this->load->library('form_validation');

        $this->_set_rules_new_translation();
        if($this->form_validation->run())
        {
            if($translation_id = $this->Translation_model->insert($this->_prepare_new_translation_array()))
            {
                $this->User_log_model->log_message('Translation record created. | translation_id: ' . $translation_id);
                $this->session->set_userdata('message', 'Translation record created.');
                redirect('translation/view_translation/' . $translation_id);
            }
            else
            {
                $this->User_log_model->log_message('Unable to create new Translation record.');
                $this->session->set_userdata('message', 'Unable to create new Translation record.');
            }
        }

        $this->load->view('translation/new_translation_page');
    }

    private function _set_rules_new_translation()
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[512]');
        $this->form_validation->set_rules('abbr', 'Abbr.', 'trim|required|max_length[512]');
        $this->form_validation->set_rules('copyright', 'Copyright', 'trim|max_length[512]');
    }

    private function _prepare_new_translation_array()
    {
        $translation = array();
        $translation['name'] = $this->input->post('name');
        $translation['abbr'] = $this->input->post('abbr');
        $translation['copyright'] = $this->input->post('copyright');
        $translation['status'] = 'Active';
        return $translation;
    }

    public function view_translation($translation_id)
    {
        $this->User_log_model->validate_access();
        $translation = $this->Translation_model->get_by_translation_id($translation_id);
        if($translation)
        {
            $data = array(
                'translation' => $translation,
                'record_name' => 'Translation',
                'delete_url' => site_url('translation/delete_translation/' . $translation_id)
            );
            $this->load->view('translation/view_translation_page', $data);
        }
        else
        {
            $this->session->set_userdata('message', 'Translation record not found.');
            redirect('translation/browse_translation');
        }
    }
	
} // end Translation controller class