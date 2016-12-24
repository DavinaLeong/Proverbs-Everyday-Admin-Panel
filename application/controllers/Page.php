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
		//redirect('passage/KJV/' . $this->datetime_helper->today('j'));
		redirect('passage/KJV/1');
	}

	public function passage($abbr, $chapter_no)
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
				'translations' => $this->Translation_model->get_all_published(),
				'chapter_passage' => $this->Chapter_passage_model->get_by_abbr_chapter_no_published($abbr, $chapter_no),
				'verse_passage' => $this->Verse_passage_model->get_by_abbr_chapter_no_published($abbr, $chapter_no),
			);
			$this->load->view('page/passage_page', $data);
		}
		else
		{
			show_error('Passage not found.');
		}
	}
	
} // end Page controller class