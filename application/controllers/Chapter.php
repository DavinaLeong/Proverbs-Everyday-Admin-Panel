<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: Chapter.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 21 Dec 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/

class Chapter extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->load->model('Chapter_model');
	}

    public function browse_chapter()
    {
        $this->User_log_model->validate_access();
        $data = array(
            'chapters' => $this->Chapter_model->get_all()
        );
        $this->load->view('chapter/browse_page', $data);
    }

    public function new_chapter()
    {
        $this->User_log_model->validate_access();
        $this->load->library('form_validation');
        $this->_set_rules_new_chapter();

        if($this->form_validation->run())
        {
            if($chapter_id = $this->Chapter_model->insert($this->_prepare_new_chapter_array()))
            {
                $this->User_log_model->log_message('Chapter record created. | chapter_id: ' . $chapter_id);
                $this->session->set_userdata('message', 'Chapter record created.');
                redirect('chapter/view_chapter/' . $chapter_id);
            }
            else
            {
                $this->User_log_model->log_message('Unable to create Chapter record.');
                $this->session->set_userdata('message', 'Unable to create Chapter record');
            }
        }

        $this->load->view('chapter/new_page');
    }

    private function _set_rules_new_chapter()
    {
        $this->form_validation->set_rules('chapter_no', 'Chapter Number',
            'trim|required|is_unique[chapter.chapter_no]|is_natural_no_zero');
        $this->form_validation->set_rules('total_verses', 'Total Verses',
            'trim|required|is_natural_no_zero');
    }

    private function _prepare_new_chapter_array()
    {
        $chapter = array();
        $chapter['chapter_no'] = $this->input->post('chapter_no');
        $chapter['total_verses'] = $this->input->post('total_verses');
        $chapter['status'] = 'Draft';
        return $chapter;
    }
	
} // end Chapter controller class