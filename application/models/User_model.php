<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: User_model.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 28th Sep 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/

class User_model extends CI_Model
{
    public function get_all()
    {
        $query = $this->db->get(TABLE_USER);
        return $query->result_array();
    }

    public function get_by_username($username = FALSE)
    {
        $query = $this->db->get_where(TABLE_USER, array('username' => $username));
        return $query->row_array();
    }

    public function get_by_id($user_id = FALSE)
    {
        $query = $this->db->get_where(TABLE_USER, array('user_id' => $user_id));
        return $query->row_array();
    }

    public function get_all_limit_offset($limit, $offset)
    {
        $this->db->order_by('user_id');
        $query = $this->db->get(TABLE_USER, $limit, $offset);
        return $query->result_array();
    }

    public function count_all()
    {
        return $this->db->count_all(TABLE_USER);
    }

    public function insert($user)
    {
        $temp_array = array(
            'username' => $user['username'],
            'password_hash' => $user['password_hash'],
            'name' => $user['name'],
            'access' => $user['access'],
            'status' => $user['status']
        );

        $this->db->set('last_updated', $this->datetime_helper->now('c'));
        $this->db->insert(TABLE_USER, $temp_array);
        return $this->db->insert_id();
    }

} //end User_model class