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
		//redirect('passage/KJV/' . $this->datetime_helper->today('j') . '/paragraph');
		redirect('passage/KJV/1/paragraph');
	}

	public function passage($abbr, $chapter_no, $display_type='Paragraph')
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

    private function _displays()
    {
        return array(
            'Paragraph',
            'Grid'
        );
    }
	
} // end Page controller class