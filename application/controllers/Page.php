<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: Page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 19 Dec 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
class Page extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		redirect('passage/KJV/' . $this->datetime_helper->today('j') . '/paragraph');
	}

	public function passage($abbr, $chapter_no, $display_type='paragraph')
	{
		$this->load->model('Translation_model');
		$this->load->model('Chapter_model');
		$this->load->library('form_validation');

		if($this->Translation_model->get_by_abbr_published($abbr) &&
			$this->Chapter_model->get_by_chapter_no_published($chapter_no))
		{
			$this->load->model('Chapter_passage_model');
			$this->load->model('Verse_passage_model');
			$data = array(
				'abbr' => $abbr,
				'chapter_no' => $chapter_no,
                'display_type' => $display_type,
				'translations' => $this->Translation_model->get_all_published(),
				'chapter_passage' => $this->Chapter_passage_model->get_by_abbr_chapter_no_published($abbr, $chapter_no),
				'verse_passages' => $this->Verse_passage_model->get_by_abbr_chapter_no_published($abbr, $chapter_no),
                'displays' => $this->_displays()
			);
			$this->load->view('page/passage_page', $data);
		}
		else
		{
			show_error('Passage not found.');
		}
	}

	public function process_search_form()
	{
		$this->load->model('Translation_model');
		$this->load->model('Chapter_model');
		$this->load->library('form_validation');
		$this->_set_rules_search_form();

		if($this->form_validation->run())
		{
			redirect('passage/' . $this->input->post('abbr') . '/' . $this->input->post('chapter_no') . '/' . $this->input->post('display_type'));
		}
		else
		{
			$this->load->view('page/validation_errors_page');
		}
	}

	private function _set_rules_search_form()
	{
		$this->form_validation->set_rules('chapter_no', 'Chapter',
			'trim|required|is_natural_no_zero|greater_than_equal_to[1]|less_than_equal_to[31]');

		$abbr_str = implode(',', $this->Translation_model->get_all_published_abbr());
		$this->form_validation->set_rules('abbr', 'Translation',
			'trim|required|in_list[' . $abbr_str . ']|max_length[512]');

		$display_str = implode(',', $this->_displays());
		$this->form_validation->set_rules('display_type', 'View',
			'trim|required|in_list[' . $display_str . ']|max_length[512]');
	}

    private function _displays()
    {
        return array(
            'paragraph',
            'grid'
        );
    }
	
} // end Page controller class