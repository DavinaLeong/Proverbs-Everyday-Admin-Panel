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
class Translation_model extends CI_Model
{
	public function count_all()
    {
        return $this->db->count_all(TABLE_TRANSLATION);
    }

    public function get_all()
    {
        $this->db->order_by('name');
        $query = $this->db->get(TABLE_TRANSLATION);
        return $query->result_array();
    }

    public function get_by_translation_id($translation_id=FALSE)
    {
        if($translation_id !== FALSE)
        {
            $query = $this->db->get_where(TABLE_TRANSLATION, array('translation_id' => $translation_id));
            return $query->result_array();
        }
        else
        {
            return FALSE;
        }
    }

    public function insert($translation=FALSE)
    {
        if($translation !== FALSE)
        {
            $temp_array = array(
                'name' => $translation['name'],
                'abbr' => $translation['abbr'],
                'copyright' => $translation['copyright'],
                'status' => $translation['status']
            );

            $this->load->library('Datetime_helper');
            $this->db->set('date_added', $this->datetime_helper->now('c'));
            $this->db->set('last_updated', $this->datetime_helper->now('c'));
            $this->db->insert(TABLE_TRANSLATION, $temp_array);
            return $this->db->insert_id();
        }
        else
        {
            return FALSE;
        }
    }

    public function update($translation=FALSE)
    {
        if($translation !== FALSE)
        {
            $temp_array = array(
                'name' => $translation['name'],
                'abbr' => $translation['abbr'],
                'copyright' => $translation['copyright'],
                'status' => $translation['status']
            );

            $this->load->library('Datetime_helper');
            $this->db->set('last_updated', $this->datetime_helper->now('c'));
            $this->db->update(TABLE_TRANSLATION, $temp_array, array('translation_id' => $translation['translation_id']));
            return $this->db->affected_rows();
        }
        else
        {
            return FALSE;
        }
    }

    public function delete_by_translation_id($translation_id=FALSE)
    {
        if($translation_id !== FALSE)
        {
            $this->db->delete(TABLE_TRANSLATION, array('translation_id' => $translation_id));
            return $this->db->affected_rows();
        }
        else
        {
            return FALSE;
        }
    }

} // end Translation_model class