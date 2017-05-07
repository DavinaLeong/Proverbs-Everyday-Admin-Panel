<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: Export.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 19 Apr 2017

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/

class Export extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Export_model');
		$this->load->library('Datetime_helper');
	}

	public function index()
	{
		redirect('export/visualise');
	}

	public function visualise()
	{
		echo '<h1>Export records as JSON</h1>';
		echo '<h4><a href="javascript:history.back()">Back</a> | <a href="' . site_url('authenticate/start') . '">Home</a></h4>';
		if($translations = $this->_retrieve_passages([2, 5]))
		{
			echo '<p style="color: #080;">Translation(s) found!</p>';

			echo '<h2>Unformatted</h2>';
			echo '<div style="padding: 0 15px;">';
			echo '<div style="border: thin solid #999; background: #eee; padding: 5px; max-height: 600px; overflow: auto;">Translations:';
			var_dump($translations);
			echo '</div><br/>';

			echo '<div style="border: thin solid #999; background: #eee; padding: 5px; max-height: 600px; overflow: auto;">Chapter:';
			var_dump($translations[0]['chapters']);
			echo '</div><br/>';

			echo '<div style="border: thin solid #999; background: #eee; padding: 5px; max-height: 600px; overflow: auto;">Verse:';
			var_dump($translations[0]['chapters'][0]);
			echo '</div>';
			echo '</div>';

			echo '<h2>JSON</h2>';
			echo '<div style="padding: 0 15px;">';
			echo '<div style="border: thin solid #999; background: #eee; padding: 5px; max-height: 600px; overflow: auto;">JSON Translations:';
			$json_translations = json_encode($translations, JSON_PRETTY_PRINT);
			var_dump($json_translations);
			echo '</div><br/>';

			echo '<div style="border: thin solid #999; background: #eee; padding: 5px; max-height: 600px; overflow: auto;">JSON Chapter:';
			$json_chapter = json_encode($translations[0]['chapters'], JSON_PRETTY_PRINT);
			var_dump($json_chapter);
			echo '</div>';
			echo '</div>';

			echo '<div style="height: 50px">&nbsp;</div>';
		}
		else
		{
			echo '<p style="color: #800;">Translation(s) not found.</p>';
		}
	}

	public function export_json()
	{
		if($translations = $this->_retrieve_passages([2, 5]))
		{
			$data = array(
				'translations' => $translations
			);
			$this->load->view('export/export_json_template', $data);
		}
	}

	public function export_typescript()
	{
		if($translations = $this->_retrieve_passages([2, 5]))
		{
			$data = array(
				'translations' => $translations
			);
			$this->load->view('export/export_ts_template', $data);
		}
	}

	private function _retrieve_passages($translation_ids)
	{
		if(is_array($translation_ids))
		{
			$translations = $this->Export_model->get_translation_by_ids($translation_ids);
			foreach($translations as $key=>$translation)
			{
				$chapters = [];
				for($i = 1; $i <= 31; ++$i)
				{
					$chapter_passage = $this->Export_model->get_chapter_passage_text_by_translation_id_chapter_id(
						$translation['translation_id'], $i);
					$chapter = array(
						'chapter_no' => $chapter_passage['chapter_id'],
						'passage' => $chapter_passage['passage'],
						'grid' => $this->Export_model->get_verse_passage_text_by_translation_id_chapter_id(
							$translation['translation_id'], $i)
					);
					array_push($chapters, $chapter);
				}
				$translations[$key]['chapters'] = $chapters;
			}
			return $translations;
		}
		else
		{
			return FALSE;
		}
	}
	
} // end Export controller class