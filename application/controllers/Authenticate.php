<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: Authenticate.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 19 Dec 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/

class Authenticate extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->load->library('Debug_helper');
	}

    public function index()
    {
        redirect('authenticate/start');
    }

    public function login()
    {
        if($this->session->userdata('user_id') || $this->session->userdata('access'))
        {
            $this->User_log_model->log_message('User is logged out.');
            $this->session->unset_userdata('user_id');
            $this->session->unset_userdata('username');
            $this->session->unset_userdata('name');
            $this->session->unset_userdata('image_filename');
            $this->session->unset_userdata('access');
            $this->session->set_userdata('message', 'You have been logged out.');
        }

        $this->load->library('form_validation');
        $this->_set_rules_login();

        if($this->form_validation->run())
        {
            $this->load->model('User_model');
            if($user = $this->User_model->get_by_username($this->input->post('username')))
            {
                if($user['status'] == 'Active')
                {
                    if(password_verify($this->input->post('password'), $user['password_hash']))
                    {
                        $this->session->set_userdata('user_id', $user['user_id']);
                        $this->session->set_userdata('username', $user['username']);
                        $this->session->set_userdata('name', $user['name']);
                        $this->session->set_userdata('image_filename', $user['image_filename']);
                        $this->session->set_userdata('access', $user['access']);

                        $this->User_log_model->log_message('User logged in.');
                        $this->session->set_userdata('message', 'Login successful.');
                        redirect('authenticate/start');
                    }
                    else
                    {
                        $this->session->set_userdata('message', 'Password is <strong>incorrent</strong>.');
                    }
                }
                else
                {
                    $this->session->set_userdata('message', 'This account as been <strong>deactivated</strong>.');
                }
            }
            else
            {
                $this->session->set_userdata('message', '<strong>Invalid</strong> Username or Password.');
            }
        }

        $this->load->view('authenticate/login_page');
    }

    private function _set_rules_login()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
    }

    public function logout()
    {
        redirect('authenticate/login');
    }

    public function start()
    {
        $this->User_log_model->validate_access();
        $this->load->view('authenticate/start_page');
    }

    /**
     * A helper function to create a new user
     *
     * @param string $username
     * @param string $name
     * @param string $password
     */
    private function _create_new_user($username='user', $name='User', $password='password')
    {
        $this->load->model('User_model');
        $user = array(
            'username' => $username,
            'name' => $name,
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            'access' => 'A',
            'status' => 'Active'
        );
        $new_user_id = $this->User_model->insert($user);
        $this->User_log_model->log_message('New User record created. | ' . $new_user_id);
    }
	
} // end Authenticate controller class