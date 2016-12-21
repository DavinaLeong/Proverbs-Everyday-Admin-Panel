<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: Chapter.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 21 Dec 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/

class Chapter extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->load->model('Chapter_model');
	}

    public function browse_chapter()
    {
        $this->User_log_model->validate_access();
        $data = array(
            'chapters' => $this->Chapter_model->get_all()
        );
        $this->load->view('chapter/browse_page', $data);
    }

    public function new_chapter()
    {
        $this->User_log_model->validate_access();
        $this->load->library('form_validation');
        $this->_set_rules_new_chapter();

        if($this->form_validation->run())
        {
            if($chapter_id = $this->Chapter_model->insert($this->_prepare_new_chapter_array()))
            {
                $this->User_log_model->log_message('Chapter record created. | chapter_id: ' . $chapter_id);
                $this->session->set_userdata('message', 'Chapter record created.');
                redirect('chapter/view_chapter/' . $chapter_id);
            }
            else
            {
                $this->User_log_model->log_message('Unable to create Chapter record.');
                $this->session->set_userdata('message', 'Unable to create Chapter record');
            }
        }

        $this->load->view('chapter/new_page');
    }

    private function _set_rules_new_chapter()
    {
        $this->form_validation->set_rules('chapter_no', 'Chapter Number',
            'trim|required|is_unique[chapter.chapter_no]|is_natural_no_zero');
        $this->form_validation->set_rules('total_verses', 'Total Verses',
            'trim|required|is_natural_no_zero');
    }

    private function _prepare_new_chapter_array()
    {
        $chapter = array();
        $chapter['chapter_no'] = $this->input->post('chapter_no');
        $chapter['total_verses'] = $this->input->post('total_verses');
        $chapter['status'] = 'Draft';
        return $chapter;
    }

    public function view_chapter($chapter_id)
    {
        $this->User_log_model->validate_access();
        $chapter = $this->Chapter_model->get_by_chapter_id($chapter_id);
        if($chapter)
        {
            $data = array(
                'chapter' => $chapter,
                'record_name' => 'Chapter',
                'delete_url' => site_url('chapter/delete_chapter/' . $chapter_id)
            );

            $this->load->view('chapter/view_page', $data);
        }
        else
        {
            $this->_record_not_found();
        }
    }

    public function edit_chapter($chapter_id)
    {
        $this->User_log_model->validate_access();
        $chapter = $this->Chapter_model->get_by_chapter_id($chapter_id);
        if($chapter)
        {
            $this->load->library('form_validation');
            $this->_set_rules_edit_chapter($chapter);

            if($this->form_validation->run())
            {
                if($this->Chapter_model->update($this->_prepare_edit_chapter_array($chapter)))
                {
                    $this->User_log_model->log_message('Chapter record updated. | chapter_id: ' . $chapter_id);
                    $this->session->set_userdata('Chapter record updated.');
                    redirect('chapter/view_chapter/' . $chapter_id);
                }
                else
                {
                    $this->User_log_model->log_message('Unable to update Chapter record. | chapter_id: ' . $chapter_id);
                    $this->session->set_userdata('Unable to update Chapter record.');
                }
            }

            $data = array(
                'chapter' => $chapter,
                'status_options' => $this->Chapter_model->_status_array()
            );
            $this->load->view('chapter/edit_page', $data);
        }
        else
        {
            $this->_record_not_found();
        }
    }

    private function _set_rules_edit_chapter($chapter)
    {
        if($chapter['chapter_no'] == $this->input->post('chapter_no'))
        {
            $this->form_validation->set_rules('chapter_no', 'Chapter Number', 'trim|required|is_natural_no_zero');
        }
        else
        {
            $this->form_validation->set_rules('chapter_no', 'Chapter Number',
                'trim|required|is_unique[chapter.chapter_no]|is_natural_no_zero');
        }

        $this->form_validation->set_rules('total_verses', 'Total Verses',
            'trim|required|is_natural_no_zero');
        $status_str = implode(',', $this->Chapter_model->_status_array());
        $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[' . $status_str . ']|max_length[512]');
    }

    private function _prepare_edit_chapter_array($chapter)
    {
        $chapter['chapter_no'] = $this->input->post('chapter_no');
        $chapter['total_verses'] = $this->input->post('total_verses');
        $chapter['status'] = $this->input->post('status');
        return $chapter;
    }

    public function delete_chapter($chapter_id)
    {
        if($this->Chapter_model->get_by_chapter_id($chapter_id))
        {
            if($this->Chapter_model->delete_by_chapter_id($chapter_id))
            {
                $this->User_log_model->log_message('Chapter record deleted. | chapter_id: ' . $chapter_id);
                $this->session->set_userdata('Chapter record deleted.');
                redirect('chapter/browse_chapter');
            }
            else
            {
                $this->User_log_model->log_message('Unable to delete Chapter record. | chapter_id: ' . $chapter_id);
                $this->session->set_userdata('Unable to delete Chapter record.');
                redirect('chapter/view_chapter/' . $chapter_id);
            }
        }
        else
        {
            $this->_record_not_found();
        }
    }

    private function _record_not_found()
    {
        $this->session->set_userdata('message', 'Chapter record not found');
        redirect('chapter/browse_chapter');
    }
	
} // end Chapter controller class