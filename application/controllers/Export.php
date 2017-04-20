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
		$array = [2, 5];
		if($translations = $this->Export_model->get_translation_by_ids($array))
		{
			foreach($translations as $key=>$translation)
			{
				$chapters = [];
				for($i = 1; $i <= 31; ++$i)
				{
					$chapter = array(
						'paragraph' => $this->Export_model->get_chapter_passage_text_by_translation_id_chapter_id(
							$translation['translation_id'], $i),
						'grid' => $this->Export_model->get_verse_passage_text_by_translation_id_chapter_id(
							$translation['translation_id'], $i)
					);
					array_push($chapters, $chapter);
				}
				$translations[$key]['chapters'] = $chapters;
			}

			$data = array(
				'translations' => $translations
			);
			$this->load->view('export/export_json_template', $data);
		}

	}

	public function visual()
	{
		echo '<h1>Export records as JSON</h1>';
		$array = [2, 5];
		if($translations = $this->Export_model->get_translation_by_ids($array))
		{
			echo '<p style="color: #080;">Translation(s) found!</p>';

			foreach($translations as $key=>$translation)
			{
				$chapters = [];
				for($i = 1; $i <= 31; ++$i)
				{
					$chapter = array(
						'paragraph' => $this->Export_model->get_chapter_passage_text_by_translation_id_chapter_id(
							$translation['translation_id'], $i),
						'grid' => $this->Export_model->get_verse_passage_text_by_translation_id_chapter_id(
							$translation['translation_id'], $i)
					);
					array_push($chapters, $chapter);
				}
				$translations[$key]['chapters'] = $chapters;
			}

			echo '<h2>Unformatted</h2>';
			echo '<div style="padding: 0 15px;">';
			echo '<div style="border: thin solid #999; background: #eee; padding: 5px; max-height: 600px; overflow: auto;">Translations:';
			var_dump($translations);
			echo '</div><br/>';

			echo '<div style="border: thin solid #999; background: #eee; padding: 5px; max-height: 600px; overflow: auto;">Translations:';
			var_dump($translations[0]['chapters']);
			echo '</div><br/>';

			echo '<div style="border: thin solid #999; background: #eee; padding: 5px; max-height: 600px; overflow: auto;">Translations:';
			var_dump($translations[0]['chapters'][0]);
			echo '</div>';
			echo '</div>';

			echo '<h2>JSON</h2>';
			echo '<div style="padding: 0 15px;">';
			echo '<div style="border: thin solid #999; background: #eee; padding: 5px; max-height: 600px; overflow: auto;">Translations:';
			$json_translations = json_encode($translations, JSON_PRETTY_PRINT);
			var_dump($json_translations);
			echo '</div><br/>';

			echo '<div style="border: thin solid #999; background: #eee; padding: 5px; max-height: 600px; overflow: auto;">Translations:';
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
	
} // end Export controller class