<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: Find_passage.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 26 Jul 2017

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/

class Find_passage extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Translation_model');
        $this->load->model('Chapter_model');
        $this->load->model('Chapter_passage_model');
        $this->load->model('Verse_passage_model');
    }

    public function index()
    {
        $this->User_log_model->validate_access();
        $this->load->library('form_validation');
        $this->_set_rules_find_passage();

        if($this->form_validation->run())
        {
            $this->session->set_userdata('SEARCHED_TRANSLATION_ID_KEY', $this->input->post('translation_id'));
            $this->session->set_userdata('SEARCHED_CHAPTER_ID_KEY', $this->input->post('chapter_id'));
        }

        $chapter_passage = $this->Chapter_passage_model->get_by_chapter_id_and_translation_id(
            $this->session->userdata('SEARCHED_CHAPTER_ID_KEY'), $this->session->userdata('SEARCHED_TRANSLATION_ID_KEY'));
        $verse_passages = $this->Verse_passage_model->get_by_chapter_id_and_translation_id(
            $this->session->userdata('SEARCHED_CHAPTER_ID_KEY'), $this->session->userdata('SEARCHED_TRANSLATION_ID_KEY'));

        $data = array(
            'translations' => $this->Translation_model->get_all(),
            'chapters' => $this->Chapter_model->get_all(),
            'searched_translation' => $this->Translation_model->get_by_translation_id($this->session->userdata('SEARCHED_TRANSLATION_ID_KEY')),
            'searched_chapter' => $this->Chapter_model->get_by_chapter_id($this->session->userdata('SEARCHED_CHAPTER_ID_KEY')),
            'chapter_passage' => $chapter_passage,
            'verse_passages' => $verse_passages
        );

        $this->load->view('find_passage/index_page', $data);
    }

    private function _set_rules_find_passage()
    {
        $translation_ids_str = implode(',', $this->Translation_model->get_all_translation_ids());
        $this->form_validation->set_rules('translation_id', 'Select Translation', 'trim|required|in_list[' . $translation_ids_str . ']|is_natural_no_zero');
        $chapter_ids_str = implode(',', $this->Chapter_model->get_all_chapter_ids());
        $this->form_validation->set_rules('chapter_id', 'Select Chapter', 'trim|required|in_list[' . $chapter_ids_str . ']|is_natural_no_zero');
    }

} //end Find_passage controller class