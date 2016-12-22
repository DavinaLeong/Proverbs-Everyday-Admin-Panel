<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: Verse_passage.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 22 Dec 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
class Verse_passage extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->load->model('Verse_passage_model');
	}

    public function browse_verse_passage()
    {
        $this->User_log_model->validate_access();
        $this->load->helper('text');
        $data = array(
            'verse_passages' => $this->Verse_passage_model->get_all_with_chapter_translation()
        );
        $this->load->view('verse_passage/browse_page', $data);
    }

    public function new_verse_passage()
    {
        $this->User_log_model->validate_access();

        $this->load->model('Translation_model');
        $this->load->model('Chapter_model');
        $this->load->library('form_validation');

        $this->_set_rules_new_verse_passage();
        if($this->form_validation->run())
        {
            if($vp_id = $this->Verse_passage_model->insert($this->_prepare_new_verse_passage_array()))
            {
                $this->User_log_model->log_message('Verse Passage created. | vp_id: ' . $vp_id);
                $this->session->set_userdata('message', 'Verse Passage created. <a href="' . site_url('verse_passage/new_verse_passage') . '">Create another</a>.');
                redirect('verse_passage/view_verse_passage/' . $vp_id);
            }
            else
            {
                $this->User_log_model->log_message('Unable to create Verse Passage.');
                $this->session->set_userdata('message', 'Unable to create Verse Passage.');
            }
        }

        $data = array(
            'translations' => $this->Translation_model->get_all_published(),
            'chapters' => $this->Chapter_model->get_all_published(),
            'status_options' => $this->Verse_passage_model->_status_array()
        );
        $this->load->view('verse_passage/new_page', $data);
    }

    private function _set_rules_new_verse_passage()
    {
        $this->load->model('Translation_model');
        $translation_ids = implode(',', $this->Translation_model->get_published_translation_ids());
        $this->form_validation->set_rules('translation_id', 'Translation',
            'trim|required|in_list[' . $translation_ids . ']|greater_than[0]|less_than_equal_to[9999]|is_natural_no_zero');

        $this->load->model('Chapter_model');
        $chapter_ids = implode(',', $this->Chapter_model->get_published_chapter_ids());
        $this->form_validation->set_rules('chapter_id', 'Chapter',
            'trim|required|in_list[' . $chapter_ids . ']|greater_than[0]|less_than_equal_to[9999]|is_natural_no_zero');

        $this->form_validation->set_rules('verse_no', 'Verse Number',
            'trim|required|is_natural_no_zero|greater_than[0]|less_than_equal_to[999999]');

        $this->form_validation->set_rules('passage', 'Passage', 'trim|required');

        $status_str = implode(',', $this->Verse_passage_model->_status_array());
        $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[' . $status_str . ']');
    }

    private function _prepare_new_verse_passage_array()
    {
        $verse_passage = array();
        $verse_passage['translation_id'] = $this->input->post('translation_id');
        $verse_passage['chapter_id'] = $this->input->post('chapter_id');
        $verse_passage['verse_no'] = $this->input->post('verse_no');
        $verse_passage['passage'] = $this->input->post('passage');
        $verse_passage['status'] = $this->input->post('status');
        return $verse_passage;
    }

    public function view_verse_passage($vp_id)
    {
        $this->User_log_model->validate_access();
        $verse_passage = $this->Verse_passage_model->get_by_vp_id_with_chapter_translation($vp_id);
        if($verse_passage)
        {
            $data = array(
                'verse_passage' => $this->Verse_passage_model->get_by_vp_id_with_chapter_translation($vp_id),
                'record_name' => 'Verse Passage',
                'delete_url' => site_url('verse_passage/delete_verse_passage/' . $vp_id)
            );
            $this->load->view('verse_passage/view_page', $data);
        }
        else
        {
            $this->_record_not_found();
        }
    }

    public function edit_verse_passage($vp_id)
    {
        $this->User_log_model->validate_access();
        $verse_passage = $this->Verse_passage_model->get_by_vp_id($vp_id);
        if($verse_passage)
        {
            $this->load->model('Translation_model');
            $this->load->model('Chapter_model');
            $this->load->library('form_validation');

            $this->_set_rules_edit_verse_passage($verse_passage);
            if($this->form_validation->run())
            {
                if($this->Verse_passage_model->update($this->_prepare_edit_verse_passage_array($verse_passage)))
                {
                    $this->User_log_model->log_message('Verse Passage updated. | vp_id: ' . $vp_id);
                    $this->session->set_userdata('message', 'Verse Passage updated.');
                    redirect('verse_passage/view_verse_passage/' . $vp_id);
                }
                else
                {
                    $this->User_log_model->log_message('Unable to update Verse Passage. | vp_id: ' . $vp_id);
                    $this->session->set_userdata('message', 'Unable to update Verse Passage.');
                }
            }

            $data = array(
                'verse_passage' => $verse_passage,
                'chapters' => $this->Chapter_model->get_all_published(),
                'translations' => $this->Translation_model->get_all_published(),
                'status_options' => $this->Verse_passage_model->_status_array()
            );
            $this->load->view('verse_passage/edit_page', $data);
        }
        else
        {
            $this->_record_not_found();
        }
    }

    private function _set_rules_edit_verse_passage($verse_passage)
    {
        $this->load->model('Translation_model');
        $translation_ids = implode(',', $this->Translation_model->get_published_translation_ids());
        $this->form_validation->set_rules('translation_id', 'Translation',
            'trim|required|in_list[' . $translation_ids . ']|greater_than[0]|less_than_equal_to[9999]|is_natural_no_zero');

        $this->load->model('Chapter_model');
        $chapter_ids = implode(',', $this->Chapter_model->get_published_chapter_ids());
        $this->form_validation->set_rules('chapter_id', 'Chapter',
            'trim|required|in_list[' . $chapter_ids . ']|greater_than[0]|less_than_equal_to[9999]|is_natural_no_zero');

        $this->form_validation->set_rules('verse_no', 'Verse Number',
            'trim|required|is_natural_no_zero|greater_than[0]|less_than[10000]');

        $this->form_validation->set_rules('passage', 'Passage', 'trim|required');

        $status_str = implode(',', $this->Verse_passage_model->_status_array());
        $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[' . $status_str . ']');
    }

    private function _prepare_edit_verse_passage_array($verse_passage)
    {
        $verse_passage['translation_id'] = $this->input->post('translation_id');
        $verse_passage['chapter_id'] = $this->input->post('chapter_id');
        $verse_passage['verse_no'] = $this->input->post('verse_no');
        $verse_passage['passage'] = $this->input->post('passage');
        $verse_passage['status'] = $this->input->post('status');
        return $verse_passage;
    }

    public function delete_verse_passage($vp_id)
    {
        $this->User_log_model->validate_access();
        if($this->Verse_passage_model->get_by_vp_id($vp_id))
        {
            if($this->Verse_passage_model->delete_by_vp_id($vp_id))
            {
                $this->User_log_model->log_message('Verse Passage deleted. | vp_id: ' . $vp_id);
                $this->session->set_userdata('message', 'Verse Passage deleted.');
                redirect('verse_passage/browse_verse_passage');
            }
            else
            {
                $this->User_log_model->log_message('Unable to delete Verse Passage. | vp_id: ' . $vp_id);
                $this->session->set_userdata('message', 'Unable to delete Verse Passage.');
                redirect('verse_passage/view_verse_passage/' . $vp_id);
            }
        }
        else
        {
            $this->_record_not_found();
        }
    }

    public function export_verse_passage()
    {
        $this->User_log_model->validate_access();
        $data = array(
            'table_name' => TABLE_VERSE_PASSAGE,
            'id_field_name' => 'vp_id',
            'records' => $this->Verse_passage_model->get_all(),
            'fields_list' => $this->Verse_passage_model->_fields_list()
        );
        $this->load->view('export/export_template', $data);
    }

    private function _record_not_found()
    {
        $this->session->set_userdata('message', 'Verse Passage not found');
        redirect('verse_passage/browse_verse_passage');
    }
	
} // end Verse_passage controller class