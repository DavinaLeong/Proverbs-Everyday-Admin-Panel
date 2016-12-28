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
        $this->load->model('Chapter_model');
	}

    public function index()
    {
        redirect('translation/browse_translation');
    }

    public function browse_translation()
    {
        $this->User_log_model->validate_access();
        $data = array(
            'translations' => $this->Translation_model->get_all()
        );
        $this->load->view('translation/browse_page', $data);
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

        $data = array(
            'status_options' => $this->Translation_model->_status_array()
        );
        $this->load->view('translation/new_page', $data);
    }

    private function _set_rules_new_translation()
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[512]');
        $this->form_validation->set_rules('abbr', 'Abbr.', 'trim|required|max_length[512]|is_unique[translation.abbr]');
        $this->form_validation->set_rules('copyright', 'Copyright', 'trim|max_length[512]');
        $status_str = implode(',', $this->Translation_model->_status_array());
        $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[' . $status_str .']');
    }

    private function _prepare_new_translation_array()
    {
        $translation = array();
        $translation['name'] = $this->input->post('name');
        $translation['abbr'] = strtoupper($this->input->post('abbr'));
        $translation['copyright'] = $this->input->post('copyright');
        $translation['status'] = $this->input->post('status');
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
            $this->load->view('translation/view_page', $data);
        }
        else
        {
            $this->_record_not_found();
        }
    }

    public function edit_translation($translation_id)
    {
        $this->User_log_model->validate_access();
        $translation = $this->Translation_model->get_by_translation_id($translation_id);
        if($translation)
        {
            $this->load->library('form_validation');
            $this->_set_rules_edit_translation($translation);

            if($this->form_validation->run())
            {
                if($this->Translation_model->update($this->_prepare_edit_translation_array($translation)))
                {
                    $this->User_log_model->log_message('Translation record updated. | translation_id: ' . $translation_id);
                    $this->session->set_userdata('message', 'Translation record updated.');
                    redirect('translation/view_translation/' . $translation_id);
                }
                else
                {
                    $this->User_log_model->log_message('Unable to update Translation record. | translation_id: ' . $translation_id);
                    $this->session->set_userdata('message', 'Unable to update Translation record');
                }
            }

            $data = array(
                'translation' => $translation,
                'status_options' => $this->Translation_model->_status_array()
            );
            $this->load->view('translation/edit_page', $data);
        }
        else
        {
            $this->_record_not_found();
        }
    }

    private function _set_rules_edit_translation($translation)
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[512]');
        if($translation['abbr'] == $this->input->post('abbr'))
        {
            $this->form_validation->set_rules('abbr', 'Abbr.', 'trim|required|max_length[512]');
        }
        else
        {
            $this->form_validation->set_rules('abbr', 'Abbr.', 'trim|required|max_length[512]|is_unique[translation.abbr]');
        }
        $this->form_validation->set_rules('copyright', 'Copyright', 'trim|max_length[512]');
        $status_str = implode(',', $this->Translation_model->_status_array());
        $this->form_validation->set_rules('status', 'Status'. 'trim|required|in_list[' . $status_str . ']|max_length[512]');
    }

    private function _prepare_edit_translation_array($translation)
    {
        $translation['name'] = $this->input->post('name');
        $translation['abbr'] = strtoupper($this->input->post('abbr'));
        $translation['copyright'] = $this->input->post('copyright');
        $translation['status'] = $this->input->post('status');
        return $translation;
    }

    public function delete_translation($translation_id)
    {
        $this->User_log_model->validate_access();
        if($this->Translation_model->get_by_translation_id($translation_id))
        {
            if($this->Translation_model->delete_by_translation_id($translation_id))
            {
                $this->User_log_model->log_message('Translation record deleted. | translation_id: ' . $translation_id);
                $this->session->set_userdata('message', 'Translation record deleted.');
                redirect('translation/browse_translation');
            }
            else
            {
                $this->User_log_model->log_message('Unable to delete Translation record. | translation_id: ' . $translation_id);
                $this->session->set_userdata('message', 'Unable to delete Translation record.');
                redirect('translation/view_translation/' . $translation_id);
            }
        }
        else
        {
            $this->_record_not_found();
        }
    }

    public function export_translation()
    {
        $this->User_log_model->validate_access();
        $data = array(
            'table_name' => TABLE_TRANSLATION,
            'id_field_name' => 'translation_id',
            'records' => $this->Translation_model->get_all('translation_id'),
            'fields_list' => $this->Translation_model->_fields_list()
        );
        $this->load->view('export/export_template', $data);
    }

    private function _record_not_found()
    {
        $this->session->set_userdata('message', 'Translation record not found');
        redirect('translation/browse_translation');
    }

} // end Translation controller class
