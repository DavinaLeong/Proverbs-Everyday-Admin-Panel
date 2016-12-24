<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: Chapter_passage.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 22 Dec 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
class Chapter_passage extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->load->model('Chapter_passage_model');
	}

    public function index()
    {
        redirect('chapter_passage/browse_chapter_passage');
    }

    public function browse_chapter_passage()
    {
        $this->User_log_model->validate_access();
        $this->load->helper('text');
        $data = array(
            'chapter_passages' => $this->Chapter_passage_model->get_all_with_chapter_translation()
        );
        $this->load->view('chapter_passage/browse_page', $data);
    }

    public function new_chapter_passage()
    {
        $this->User_log_model->validate_access();
        $this->load->model('Translation_model');
        $this->load->model('Chapter_model');
        $this->load->library('form_validation');

        $this->_set_rules_new_chapter_passage();
        if($this->form_validation->run())
        {
            if($cp_id = $this->Chapter_passage_model->insert($this->_prepare_new_chapter_passage_array()))
            {
                $this->User_log_model->log_message('Chapter Passage created. | cp_id: ' . $cp_id);
                $this->session->set_userdata('message', 'Chapter Passage created. <a href="' . site_url('chapter_passage/new_chapter_passage') . '">Create another</a>.');
                redirect('chapter_passage/view_chapter_passage/' . $cp_id);
            }
            else
            {
                $this->User_log_model->log_message('Unable to create Chapter Passage.');
                $this->session->set_userdata('message', 'Unable to create Chapter Passage.');
            }
        }

        $data = array(
            'translations' => $this->Translation_model->get_all_published(),
            'chapters' => $this->Chapter_model->get_all_published(),
            'status_options' => $this->Chapter_passage_model->_status_array()
        );
        $this->load->view('chapter_passage/new_page', $data);
    }

    private function _set_rules_new_chapter_passage()
    {
        $this->load->model('Translation_model');
        $translation_ids = implode(',', $this->Translation_model->get_published_translation_ids());
        $this->form_validation->set_rules('translation_id', 'Translation',
            'trim|required|in_list[' . $translation_ids . ']|greater_than[0]|less_than_equal_to[9999]|is_natural_no_zero');

        $this->load->model('Chapter_model');
        $chapter_ids = implode(',', $this->Chapter_model->get_published_chapter_ids());
        $this->form_validation->set_rules('chapter_id', 'Chapter',
            'trim|required|in_list[' . $chapter_ids . ']|greater_than[0]|less_than_equal_to[9999]|is_natural_no_zero|callback_check_chapter_id');

        $this->form_validation->set_rules('passage', 'Passage', 'trim|required');

        $status_str = implode(',', $this->Chapter_passage_model->_status_array());
        $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[' . $status_str . ']');
    }

    private function _prepare_new_chapter_passage_array()
    {
        $chapter_passage = array();
        $chapter_passage['translation_id'] = $this->input->post('translation_id');
        $chapter_passage['chapter_id'] = $this->input->post('chapter_id');
        $chapter_passage['passage'] = $this->input->post('passage');
        $chapter_passage['status'] = $this->input->post('status');
        return $chapter_passage;
    }

    public function view_chapter_passage($cp_id)
    {
        $this->User_log_model->validate_access();
        $chapter_passage = $this->Chapter_passage_model->get_by_cp_id_with_chapter_translation($cp_id);
        if($chapter_passage)
        {
            $data = array(
                'chapter_passage' => $chapter_passage,
                'record_name' => 'Chapter Passage',
                'delete_url' => site_url('chapter_passage/delete_chapter_passage/' . $cp_id)
            );
            $this->load->view('chapter_passage/view_page', $data);
        }
        else
        {
            $this->_record_not_found();
        }
    }

    public function edit_chapter_passage($cp_id)
    {
        $this->User_log_model->validate_access();
        $chapter_passage = $this->Chapter_passage_model->get_by_cp_id($cp_id);
        if($chapter_passage)
        {
            $this->load->model('Translation_model');
            $this->load->model('Chapter_model');
            $this->load->library('form_validation');

            $this->_set_rules_edit_chapter_passage($chapter_passage);
            if($this->form_validation->run())
            {
                if($this->Chapter_passage_model->update($this->_prepare_edit_chapter_passage_array($chapter_passage)))
                {
                    $this->User_log_model->log_message('Chapter Passage updated. | cp_id: ' . $cp_id);
                    $this->session->set_userdata('message', 'Chapter Passage updated.');
                    redirect('chapter_passage/view_chapter_passage/' . $cp_id);
                }
                else
                {
                    $this->User_log_model->log_message('Unable to update Chapter Passage. | cp_id: ' . $cp_id);
                    $this->session->set_userdata('message', 'Unable to update Chapter Passage.');
                }
            }

            $data = array(
                'chapter_passage' => $chapter_passage,
                'translations' => $this->Translation_model->get_all_published(),
                'chapters' => $this->Chapter_model->get_all_published(),
                'status_options' => $this->Chapter_passage_model->_status_array()
            );
            $this->load->view('chapter_passage/edit_page', $data);
        }
        else
        {
            $this->_record_not_found();
        }
    }

    private function _set_rules_edit_chapter_passage($chapter_passage)
    {
        $this->load->model('Translation_model');
        $translation_ids = implode(',', $this->Translation_model->get_published_translation_ids());
        $this->form_validation->set_rules('translation_id', 'Translation',
            'trim|required|in_list[' . $translation_ids . ']|greater_than[0]|less_than_equal_to[9999]|is_natural_no_zero');

        $this->load->model('Chapter_model');
        $chapter_ids = implode(',', $this->Chapter_model->get_published_chapter_ids());
        if($chapter_passage['chapter_id'] == $this->input->post('chapter_id'))
        {
            $this->form_validation->set_rules('chapter_id', 'Chapter',
                'trim|required|in_list[' . $chapter_ids . ']|greater_than[0]|less_than_equal_to[9999]|is_natural_no_zero');
        }
        else
        {
            $this->form_validation->set_rules('chapter_id', 'Chapter',
                'trim|required|in_list[' . $chapter_ids . ']|greater_than[0]|less_than_equal_to[9999]|is_natural_no_zero|callback_check_chapter_id');
        }

        $this->form_validation->set_rules('passage', 'Passage', 'trim|required');

        $status_str = implode(',', $this->Chapter_passage_model->_status_array());
        $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[' . $status_str . ']');
    }

    private function _prepare_edit_chapter_passage_array($chapter_passage)
    {
        $chapter_passage['translation_id'] = $this->input->post('translation_id');
        $chapter_passage['chapter_id'] = $this->input->post('chapter_id');
        $chapter_passage['passage'] = $this->input->post('passage');
        $chapter_passage['status'] = $this->input->post('status');
        return $chapter_passage;
    }

    public function delete_chapter_passage($cp_id)
    {
        if($this->Chapter_passage_model->get_by_cp_id($cp_id))
        {
            if($this->Chapter_passage_model->delete_by_cp_id($cp_id))
            {
                $this->User_log_model->log_message('Chapter Passage deleted. | cp_id: ' . $cp_id);
                $this->session->set_userdata('message', 'Chapter Passage deleted.');
                redirect('chapter_passage/browse_chapter_passage');
            }
            else
            {
                $this->User_log_model->log_message('Unable to delete Chapter Passage. | cp_id: ' . $cp_id);
                $this->session->set_userdata('message', 'Unable to delete Chapte Passage.');
                redirect('chapter_passage/view_chapter_passage/' . $cp_id);
            }
        }
        else
        {
            $this->_record_not_found();
        }
    }

    public function export_chapter_passage()
    {
        $this->User_log_model->validate_access();
        $data = array(
            'table_name' => TABLE_CHAPTER_PASSAGE,
            'id_field_name' => 'cp_id',
            'records' => $this->Chapter_passage_model->get_all(),
            'fields_list' => $this->Chapter_passage_model->_fields_list()
        );
        $this->load->view('export/export_template', $data);
    }

    public function check_chapter_id($chapter_id)
    {
        if($this->Chapter_passage_model->get_by_chapter_id_and_translation_id($chapter_id,
            $this->input->post('translation_id')))
        {
            $this->form_validation->set_message('check_chapter_id', 'Selected {field} is taken for this Translation. Pick another value.');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    private function _record_not_found()
    {
        $this->session->set_userdata('message', 'Chapter Passage record not found');
        redirect('chapter_passage/browse_chapter_passage');
    }
	
} // end Chapter_passage controller class