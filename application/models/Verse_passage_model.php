<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: Verse_passage_model.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 20 Dec 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
class Verse_passage_model extends CI_Model
{
	public function count_all()
    {
        return $this->db->count_all(TABLE_VERSE_PASSAGE);
    }

    public function get_all()
    {
        $this->db->order_by('vp_id');
        $query = $this->db->get(TABLE_VERSE_PASSAGE);
        return $query->result_array();
    }

    public function get_all_published()
    {
        $this->db->order_by('vp_id');
        $query = $this->db->get_where(TABLE_VERSE_PASSAGE, array('status' => 'Active'));
        return $query->result_array();
    }

    public function get_all_with_chapter_translation()
    {
        $this->db->select('verse_passage.*, chapter.chapter_no, translation.name, translation.abbr');
        $this->db->from(TABLE_VERSE_PASSAGE);
        $this->db->join('chapter', 'verse_passage.chapter_id = chapter.chapter_id', 'left');
        $this->db->join('translation', 'verse_passage.translation_id = translation.translation_id', 'left');
        $this->db->order_by('verse_passage.verse_no');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all_published_with_chapter_translation()
    {
        $this->db->select('verse_passage.*, chapter.chapter_no, translation.name, translation.abbr');
        $this->db->from(TABLE_VERSE_PASSAGE);
        $this->db->join('chapter', 'verse_passage.chapter_id = chapter.chapter_id', 'left');
        $this->db->join('translation', 'verse_passage.translation_id = translation.translation_id', 'left');
        $this->db->where('verse_passage.status = ', 'Published');
        $this->db->order_by('verse_passage.verse_no');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_by_vp_id($vp_id=FALSE)
    {
        if($vp_id !== FALSE)
        {
            $query = $this->db->get_where(TABLE_VERSE_PASSAGE, array('vp_id' => $vp_id));
            return $query->row_array();
        }
        else
        {
            return FALSE;
        }
    }

    public function get_by_vp_id_with_chapter_translation($vp_id=FALSE)
    {
        if($vp_id !== FALSE)
        {
            $this->db->select('verse_passage.*, chapter.chapter_no, translation.name, translation.abbr');
            $this->db->from(TABLE_VERSE_PASSAGE);
            $this->db->join('chapter', 'verse_passage.chapter_id = chapter.chapter_id', 'left');
            $this->db->join('translation', 'verse_passage.translation_id = translation.translation_id', 'left');
            $this->db->where('verse_passage.vp_id = ' , $vp_id);

            $query = $this->db->get();
            return $query->row_array();
        }
        else
        {
            return FALSE;
        }
    }

    public function get_by_chapter_id_and_translation_id($chapter_id=FALSE, $translation_id=FALSE)
    {
        if($chapter_id !== FALSE && $translation_id !== FALSE)
        {
            $this->db->order_by('verse_no');
            $query = $this->db->get_where(TABLE_VERSE_PASSAGE, array('chapter_id' => $chapter_id, 'translation_id' => $translation_id));
            return $query->result_array();
        }
        else
        {
            return FALSE;
        }
    }

    public function get_by_verse_no_chapter_id_and_translation_id($verse_no=FALSE, $chapter_id=FALSE, $translation_id=FALSE)
    {
        if($verse_no !== FALSE && $chapter_id !== FALSE && $translation_id !== FALSE)
        {
            $this->db->order_by('verse_no');
            $query = $this->db->get_where(TABLE_VERSE_PASSAGE, array('verse_no' => $verse_no, 'chapter_id' => $chapter_id, 'translation_id' => $translation_id));
            return $query->row_array();
        }
        else
        {
            return FALSE;
        }
    }

    public function get_by_abbr_chapter_no_published($abbr=FALSE, $chapter_no=FALSE)
    {
        if($abbr !== FALSE && $chapter_no !== FALSE)
        {
            $this->db->select('verse_passage.*, chapter.chapter_no, translation.name, translation.abbr');
            $this->db->from('verse_passage');
            $this->db->join('translation', 'translation.translation_id = verse_passage.translation_id', 'left');
            $this->db->join('chapter', 'chapter.chapter_id = verse_passage.chapter_id', 'left');
            $this->db->where('translation.abbr = ', $abbr);
            $this->db->where('chapter.chapter_no = ', $chapter_no);
            $this->db->where('verse_passage.status = ', 'Published');
            $this->db->order_by('verse_passage.verse_no', 'asc');

            $query = $this->db->get();
            return $query->result_array();
        }
        else
        {
            return FALSE;
        }
    }

    public function insert($verse_passage=FALSE)
    {
        if($verse_passage !== FALSE)
        {
            $temp_array = array(
                'chapter_id' => $verse_passage['chapter_id'],
                'translation_id' => $verse_passage['translation_id'],
                'verse_no' => $verse_passage['verse_no'],
                'passage' => $verse_passage['passage'],
                'status' => $verse_passage['status']
            );

            $this->load->library('Datetime_helper');
            $this->db->set('date_added', $this->datetime_helper->now('c'));
            $this->db->set('last_updated', $this->datetime_helper->now('c'));
            $this->db->insert(TABLE_VERSE_PASSAGE, $temp_array);
            return $this->db->insert_id();
        }
        else
        {
            return FALSE;
        }
    }

    public function update($verse_passage=FALSE)
    {
        if($verse_passage !== FALSE)
        {
            $temp_array = array(
                'chapter_id' => $verse_passage['chapter_id'],
                'translation_id' => $verse_passage['translation_id'],
                'verse_no' => $verse_passage['verse_no'],
                'passage' => $verse_passage['passage'],
                'status' => $verse_passage['status']
            );

            $this->db->set('last_updated', $this->datetime_helper->now('c'));
            $this->db->update(TABLE_VERSE_PASSAGE, $temp_array, array('vp_id' => $verse_passage['vp_id']));
            return $this->db->affected_rows();
        }
        else
        {
            return FALSE;
        }
    }

    public function delete_by_vp_id($vp_id=FALSE)
    {
        if($vp_id !== FALSE)
        {
            $this->db->delete(TABLE_VERSE_PASSAGE, array('vp_id' => $vp_id));
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
            $this->db->delete(TABLE_VERSE_PASSAGE, array('chapter_no' => $chapter_no));
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
            $this->db->delete(TABLE_VERSE_PASSAGE, array('translation_id' => $translation_id));
            return $this->db->affected_rows();
        }
        else
        {
            return FALSE;
        }
    }

    public function _fields_list()
    {
        return $this->db->list_fields(TABLE_VERSE_PASSAGE);
    }

    public function _status_array()
    {
        return array(
            'Published',
            'Draft'
        );
    }

} // end Verse_model class