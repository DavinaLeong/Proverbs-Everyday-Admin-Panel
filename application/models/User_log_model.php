<?php
defined("BASEPATH") OR exit("No direct script access allowed");
/**********************************************************************************
	- File Info -
		File name		: User_log_model.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 28th Sep 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/

class User_log_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
    }

    public function get_all()
    {
        $query = $this->db->get(TABLE_USER_LOG);
        return $query->result_array();
    }

    public function log_message($message)
    {
        $temp_array = array(
            "user_id" => $this->session->userdata("user_id"),
            "message" => $message
        );

        $this->db->set("timestamp", $this->datetime_helper->now("c"));
        $this->db->insert(TABLE_USER_LOG, $temp_array);
        return $this->db->insert_id();
    }

    public function validate_access_custom($requiredAccess, $userAccess)
    {
        $valid = false;

        for ($i = 0; $i < strlen($userAccess); $i++)
        {
            if (strpos($requiredAccess, substr($userAccess, $i, 1)) !== false)
            {
                $valid = true;
                break;
            }
        }
        return $valid;
    }

    public function validate_access()
    {
        if( ! $this->validate_access_custom("AMU", $this->session->userdata('access')))
        {
            $this->session->set_userdata('message', 'This user has invalid access rights.');
            redirect('authenticate/login');
        }
    }

    public function validate_access_admin()
    {
        if( ! $this->validate_access_custom("A", $this->session->userdata('access')))
        {
            $this->session->set_userdata('message', 'This user has invalid access rights.');
            redirect('authenticate/login');
        }
    }

} //end User_log_model class