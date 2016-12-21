<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: Verse_model.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 20 Dec 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
class Verse_model extends CI_Model
{
	public function count_all()
    {
        return $this->db->count_all(TABLE_VERSE);
    }

    public function get_all()
    {
        $this->db->order_by('verse_id');
        $query = $this->db->get(TABLE_VERSE);
        return $query->result_array();
    }

    public function get_all_active()
    {
        $this->db->order_by('verse_id');
        $query = $this->db->get_where(TABLE_VERSE, array('status' => 'Active'));
        return $query->result_array();
    }

    public function get_by_verse_id($verse_id=FALSE)
    {
        if($verse_id !== FALSE)
        {
            $query = $this->db->get_where(TABLE_VERSE, array('verse_id' => $verse_id));
            return $query->row_array();
        }
        else
        {
            return FALSE;
        }
    }

    public function get_by_verse_no($verse_no=FALSE)
    {
        if($verse_no !== FALSE)
        {
            $query = $this->db->get_where(TABLE_VERSE, array('verse_no' => $verse_no));
            return $query->row_array();
        }
        else
        {
            return FALSE;
        }
    }

    public function get_by_chapter_no($chapter_no=FALSE)
    {
        if($chapter_no !== FALSE)
        {
            $this->db->order_by('verse_no');
            $query = $this->db->get_where(TABLE_VERSE, array('chapter_no', $chapter_no));
            return $query->result_array();
        }
        else
        {
            return FALSE;
        }
    }

    public function get_by_translation_id($translation_id=FALSE)
    {
        if($translation_id !== FALSE)
        {
            $this->db->order_by('verse_no');
            $query = $this->db->get_where(TABLE_VERSE, array('translation_id', $translation_id));
            return $query->result_array();
        }
        else
        {

        }
    }

    public function insert($verse=FALSE)
    {
        if($verse !== FALSE)
        {
            $temp_array = array(
                'chapter_id' => $verse['chapter_id'],
                'translation_id' => $verse['translation_id'],
                'verse_no' => $verse['verse_no'],
                'verse' => $verse['verse'],
                'status' => $verse['status']
            );

            $this->load->library('Datetime_helper');
            $this->db->set(TABLE_VERSE, array('date_added' => $this->datetime_helper->now('c')));
            $this->db->set(TABLE_VERSE, array('last_updated' => $this->datetime_helper->now('c')));
            $this->db->insert(TABLE_VERSE, $temp_array);
            return $this->db->insert_id();
        }
        else
        {
            return FALSE;
        }
    }

    public function update($verse=FALSE)
    {
        if($verse !== FALSE)
        {
            $temp_array = array(
                'chapter_id' => $verse['chapter_id'],
                'translation_id' => $verse['translation_id'],
                'verse_no' => $verse['verse_no'],
                'verse' => $verse['verse'],
                'status' => $verse['status']
            );

            $this->load->library('Datetime_helper');
            $this->db->set(TABLE_VERSE, array('last_updated' => $this->datetime_helper->now('c')));
            $this->db->update(TABLE_VERSE, $temp_array, array('verse_id' => $verse['verse_id']));
            return $this->db->affected_rows();
        }
        else
        {
            return FALSE;
        }
    }

    public function delete_by_verse_id($verse_id=FALSE)
    {
        if($verse_id !== FALSE)
        {
            $this->db->delete(TABLE_VERSE, array('verse_id' => $verse_id));
            return $this->db->affected_rows();
        }
        else
        {
            return FALSE;
        }
    }

    public function delete_by_chapter_no($chapter_no=FALSE)
    {
        if($chapter_no)
        {
            $this->db->delete(TABLE_VERSE, array('chapter_no' => $chapter_no));
            return $this->db->affected_rows();
        }
        else
        {
            return FALSE;
        }
    }

    public function delete_by_translation_id($translation_id=FALSE)
    {
        if($translation_id)
        {
            $this->db->delete(TABLE_VERSE, array('translation_id' => $translation_id));
            return $this->db->affected_rows();
        }
        else
        {
            return FALSE;
        }
    }

} // end Verse_model class