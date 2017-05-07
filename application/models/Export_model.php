<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: Export_model.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 19 Apr 2017

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/

class Export_model extends CI_Model
{
    public function get_translation_by_ids($array=FALSE)
    {
        if($array && count($array) > 0)
        {
            $this->db->select('translation_id, name, abbr, copyright');
            $this->db->from(TABLE_TRANSLATION);
            $this->db->where_in('translation_id', $array);
            $this->db->order_by('name', 'ASC');

            $query = $this->db->get();
            return $query->result_array();
        }
        else
        {
            return FALSE;
        }
    }

    public function get_translation_by_abbrs($array=FALSE)
    {
        if($array && count($array) > 0)
        {
            $this->db->select('translation_id, name, abbr, copyright');
            $this->db->from(TABLE_TRANSLATION);
            $this->db->where_in('abbr', $array);
            $this->db->order_by('name', 'ASC');

            $query = $this->db->get();
            return $query->result_array();
        }
        else
        {
            return FALSE;
        }
    }

    public function get_chapter_passage_text_by_translation_id_chapter_id($translation_id=FALSE, $chapter_id=FALSE)
    {
        if($translation_id && $chapter_id)
        {
            $this->db->select('translation_id, chapter_id, passage');
            $this->db->from(TABLE_CHAPTER_PASSAGE);
            $this->db->where('translation_id = ', $translation_id);
            $this->db->where('chapter_id = ', $chapter_id);
            $this->db->order_by('chapter_id', 'ASC');

            $query = $this->db->get();
            if($query->row_array() && array_key_exists('passage', $query->row_array()))
            {
                return $query->row_array();
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }

    public function get_verse_passage_text_by_translation_id_chapter_id($translation_id = FALSE, $chapter_id=FALSE)
    {
        if($translation_id && $chapter_id)
        {
            $this->db->select('translation_id, chapter_id, verse_no, passage');
            $this->db->from(TABLE_VERSE_PASSAGE);
            $this->db->where('translation_id = ', $translation_id);
            $this->db->where('chapter_id = ', $chapter_id);
            $this->db->order_by('chapter_id', 'ASC');
            $this->db->order_by('verse_no', 'ASC');

            $query = $this->db->get();
            return $query->result_array();
        }
        else
        {
            return FALSE;
        }
    }

} // end Export_model class