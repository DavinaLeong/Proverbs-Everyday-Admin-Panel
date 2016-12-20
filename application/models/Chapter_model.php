<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: Translation_model.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 20 Dec 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
class Chapter_model extends CI_Model
{
	public function count_all()
    {
        return $this->db->count_all(TABLE_CHAPTER);
    }

    public function get_all()
    {
        $this->db->order_by('chapter_id');
        $query = $this->db->get(TABLE_CHAPTER);
        return $query->result_array();
    }

    public function get_all_active()
    {
        $this->db->order_by('chapter_id');
        $query = $this->db->get_where(TABLE_CHAPTER, array('status' => 'Active'));
        return $query->result_array();
    }

    public function get_by_chapter_id($chapter_id=FALSE)
    {
        if($chapter_id !== FALSE)
        {
            $query = $this->db->get_where(TABLE_CHAPTER, array('chapter_id' => $chapter_id));
            return $query->result_array();
        }
        else
        {
            return FALSE;
        }
    }

    public function insert($chapter=FALSE)
    {
        if($chapter !== FALSE)
        {
            $temp_array = array(
                'total_verses' => $chapter['total_verses'],
                'status' => $chapter['status']
            );
            $this->load->library('Datetime_helper');
            $this->db->set('date_added', $this->datetime_helper->now('c'));
            $this->db->set('last_updated', $this->datetime_helper->now('c'));
            $this->db->insert(TABLE_CHAPTER, $temp_array);
            return $this->db->insert_id();
        }
        else
        {
            return FALSE;
        }
    }

    public function update($chapter=FALSE)
    {
        if($chapter !== FALSE)
        {
            $temp_array = array(
                'total_verse' => $chapter['total_verses'],
                'status' => $chapter['status']
            );
            $this->load->library('Datetime_helper');
            $this->db->set('last_updated', $this->datetime_helper->now('c'));
            $this->db->update(TABLE_CHAPTER, $temp_array, array('chapter_id' => $chapter['chapter_id']));
            return $this->db->affected_rows();
        }
        else
        {
            return FALSE;
        }
    }

    public function delete_by_chapter_id($chapter_id=FALSE)
    {
        if($chapter_id !== FALSE)
        {
            $this->db->delete(TABLE_CHAPTER, array('chapter_id' => $chapter_id));
            return $this->db->affected_rows();
        }
        else
        {
            return FALSE;
        }
    }

} // end Chapter_model class