<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: Chapter_passage_model.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 22 Dec 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
class Chapter_passage_model extends CI_Model
{
	public function count_all()
    {
        return $this->db->count_all(TABLE_CHAPTER_PASSAGE);
    }

    public function get_all()
    {
        $this->db->order_by('chapter_id');
        $query = $this->db->get(TABLE_CHAPTER_PASSAGE);
        return $query->result_array();
    }

    public function get_all_published()
    {
        $this->db->order_by('chapter_id');
        $query = $this->db->get_where(TABLE_CHAPTER_PASSAGE, array('status' => 'Published'));
        return $query->result_array();
    }

    public function get_all_with_chapter_translation()
    {
        $this->db->select('chapter_passage.*, chapter.chapter_no, translation.name, translation.abbr');
        $this->db->from(TABLE_CHAPTER_PASSAGE);
        $this->db->join('translation', 'translation.translation_id = chapter_passage.translation_id', 'left');
        $this->db->join('chapter', 'chapter.chapter_id = chapter_passage.chapter_id', 'left');
        $this->db->order_by('chapter_id');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all_published_with_chapter_translation()
    {
        $this->db->select('chapter_passage.*, chapter.chapter_no, translation.name, translation.abbr');
        $this->db->from(TABLE_CHAPTER_PASSAGE);
        $this->db->join('translation', 'translation.translation_id = chapter_passage.translation_id', 'left');
        $this->db->join('chapter', 'chapter.chapter_id = chapter_passage.chapter_id', 'left');
        $this->db->where('status = ', 'Published');
        $this->db->order_by('chapter_id');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_by_cp_id($cp_id=FALSE)
    {
        if($cp_id !== FALSE)
        {
            $query = $this->db->get_where(TABLE_CHAPTER_PASSAGE, array('cp_id' => $cp_id));
            return $query->row_array();
        }
        else
        {
            return FALSE;
        }
    }

    public function get_by_cp_id_with_chapter_translation($cp_id=FALSE)
    {
        if($cp_id !== FALSE)
        {
            $this->db->select('chapter_passage.*, chapter.chapter_no, translation.name, translation.abbr');
            $this->db->from(TABLE_CHAPTER_PASSAGE);
            $this->db->join('translation', 'translation.translation_id = chapter_passage.translation_id', 'left');
            $this->db->join('chapter', 'chapter.chapter_id = chapter_passage.chapter_id', 'left');
            $this->db->where('chapter_passage.cp_id = ' . $cp_id);

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
            $this->db->order_by('chapter_id');
            $query = $this->db->get_where(TABLE_CHAPTER_PASSAGE,
                array(
                    'chapter_id' => $chapter_id,
                    'translation_id' => $translation_id
                ));
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
            $this->db->select('chapter_passage.*, chapter.chapter_no, translation.name, translation.abbr');
            $this->db->from(TABLE_CHAPTER_PASSAGE);
            $this->db->join('translation', 'translation.translation_id = chapter_passage.translation_id', 'left');
            $this->db->join('chapter', 'chapter.chapter_id = chapter_passage.chapter_id', 'left');
            $this->db->where('translation.abbr = ', $abbr);
            $this->db->where('chapter.chapter_no = ', $chapter_no);
            $this->db->where('chapter_passage.status = ', 'Published');

            $query = $this->db->get();
            return $query->row_array();
        }
        else
        {
            return FALSE;
        }
    }

    public function insert($chapter_passage=FALSE)
    {
        if($chapter_passage !== FALSE)
        {
            $temp_array = array(
                'translation_id' => $chapter_passage['translation_id'],
                'chapter_id' => $chapter_passage['chapter_id'],
                'passage' => $chapter_passage['passage'],
                'status' => $chapter_passage['status'],
            );
            $this->db->set('date_added', $this->datetime_helper->now('c'));
            $this->db->set('last_updated', $this->datetime_helper->now('c'));
            $this->db->insert(TABLE_CHAPTER_PASSAGE, $temp_array);
            return $this->db->insert_id();
        }
        else
        {
            return FALSE;
        }
    }

    public function update($chapter_passage=FALSE)
    {
        if($chapter_passage !== FALSE)
        {
            $temp_array = array(
                'translation_id' => $chapter_passage['translation_id'],
                'chapter_id' => $chapter_passage['chapter_id'],
                'passage' => $chapter_passage['passage'],
                'status' => $chapter_passage['status'],
                //'date_added' => $chapter_passage['date_added']
            );
            $this->db->set('last_updated', $this->datetime_helper->now('c'));
            $this->db->update(TABLE_CHAPTER_PASSAGE, $temp_array, array('cp_id' => $chapter_passage['cp_id']));
            return $this->db->affected_rows();
        }
        else
        {
            return FALSE;
        }
    }

    public function delete_by_cp_id($cp_id=FALSE)
    {
        if($cp_id !== FALSE)
        {
            $this->db->delete(TABLE_CHAPTER_PASSAGE, array('cp_id' => $cp_id));
            return $this->db->affected_rows();
        }
        else
        {
            return FALSE;
        }
    }

    public function _fields_list()
    {
        return $this->db->list_fields(TABLE_CHAPTER_PASSAGE);
    }

    public function _status_array()
    {
        return array(
            'Published',
            'Draft'
        );
    }

} // end Chapter_passage_model class