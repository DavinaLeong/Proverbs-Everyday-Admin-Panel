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

    }
	
} // end Verse_passage controller class