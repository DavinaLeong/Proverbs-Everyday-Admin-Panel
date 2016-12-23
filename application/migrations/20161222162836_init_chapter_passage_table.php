<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: 20161222162836_init_chapter_passage_table.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 22 Dec 2016
	
	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]
	
***********************************************************************************/
/* Migration version: 
 * 22 Dec 2016, 04:28PM
 * 20161222162836
 */
class Migration_Init_chapter_passage_table extends CI_Migration
{
	// Public Functions ----------------------------------------------------------------
	public function up()
	{
		echo '<p>Create Chapter Passage Table</p><hr/><code>';
		$this->load->model('Script_runner_model');
		echo $this->Script_runner_model->run_script($this->_up_script())['output_str'];
		echo '</code><hr/>';
	}
	
	public function down()
	{
		echo '<p>Drop Chapter Passage Table</p><hr/><code>';
		$this->load->model('Script_runner_model');
		echo $this->Script_runner_model->run_script($this->_down_script())['output_str'];
		echo '</code><hr/>';
	}
	
	// Private Functions ---------------------------------------------------------------
	private function _up_script()
	{
		$sql = "
			DROP TABLE IF EXISTS `chapter_passage`;
			CREATE TABLE `chapter_passage` (
			  `cp_id` INT(4) UNSIGNED NOT NULL AUTO_INCREMENT,
			  `translation_id` INT(4) UNSIGNED NOT NULL,
			  `chapter_id` INT(4) UNSIGNED NOT NULL,
			  `passage` TEXT NOT NULL,
			  `status` VARCHAR(512) NOT NULL,
			  `date_added` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `last_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
              PRIMARY KEY(`cp_id`)
			) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
		";
		return $sql;
    }
	
	private function _down_script()
	{
		$sql = "
			DROP TABLE IF EXISTS `chapter_passage`;
		";
		return $sql;
    }
	
} // end 20161222162836_init_chaper_passage_table class