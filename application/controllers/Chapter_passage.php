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

    public function browse_chapter_passage()
    {
        $this->User_log_model->validate_access();
        $data = array(
            'chapter_passages' => $this->Chapter_passage_model->get_all_with_chapter_translation()
        );
        $this->load->view('chapter_passage/browse_page', $data);
    }

    public function new_chapter_passage()
    {
        $this->User_log_model->validate_access();
        
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
            'trim|required|in_list[' . $chapter_ids . ']|greater_than[0]|less_than_equal_to[9999]|is_natural_no_zero');

        $this->form_validation->set_rules('passage', 'Passage', 'trim|required');

        $status_str = implode(',', $this->Verse_passage_model->_status_array());
        $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[' . $status_str . ']');
    }

    private function _prepare_new_chapter_passage_array()
    {
        $chapter_passage = array();

        return $chapter_passage;
    }

    public function view_chapter_passage($cp_id)
    {

    }

    public function edit_chapter_passage($cp_id)
    {

    }

    private function _set_rules_edit_chapter_passage($chapter_passage)
    {

    }

    private function _prepare_edit_chapter_passage_array($chapter_passage)
    {

        return $chapter_passage;
    }

    public function delete_chapter_passage($cp_id)
    {

    }

    public function export_chapter()
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

    private function _record_not_found()
    {
        $this->session->set_userdata('message', 'Chapter record not found');
        redirect('chapter/browse_chapter');
    }
	
} // end Chapter_passage controller class