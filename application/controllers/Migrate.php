<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: Migrate.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 11 Dec 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/

class Migrate extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('migration');
		$this->load->model('Migration_model');
		$this->load->model('User_log_model');
	}

	public function index()
	{
        if ($this->migration->current() === FALSE)
        {
            show_error($this->migration->error_string());
        }
        else
        {
            echo "Migration succeeded<br/>";
            echo "Migration version: " . $this->Migration_model->get_version_from_db() . "<br/>";

            $this->load->view('migrate/result_page');
        }
	}

    public function reset()
    {
        $this->load->model("Migration_model");
        $this->Migration_model->reset();
    }

} // end Migrate controller class
