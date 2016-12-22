<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: 20161221204001_insert_chapters.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 21 Dec 2016
	
	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]
	
***********************************************************************************/
/* Migration version: 
 * 21 Dec 2016, 08:40PM
 * 20161221204001
 */
class Migration_Insert_chapters extends CI_Migration
{
	// Public Functions ----------------------------------------------------------------
	public function up()
	{
		// create tables
		echo '<p>Populate Chapters Table</p><hr/><code>';
		$this->load->model('Script_runner_model');
		echo $this->Script_runner_model->run_script($this->_up_script())['output_str'];
		echo '</code><hr/>';
	}
	
	public function down()
	{
		// drop tables
		echo '<p>Empty Chapters Table</p><hr/><code>';
		$this->load->model('Script_runner_model');
		echo $this->Script_runner_model->run_script($this->_down_script())['output_str'];
		echo '</code><hr/>';
	}
	
	// Private Functions ---------------------------------------------------------------
	private function _up_script()
	{
		$sql = '
            TRUNCATE TABLE `chapter`;

			INSERT INTO `chapter` (`chapter_id`,`chapter_no`,`total_verses`,`status`,`date_added`,`last_updated`)
			VALUES
				(1, "1", "33", "Published", "2016-12-21 20:38:51", "2016-12-21 20:38:51"),
				(2, "2", "22", "Published", "2016-12-21 20:38:51", "2016-12-21 20:38:51"),
				(3, "3", "35", "Published", "2016-12-21 20:38:51", "2016-12-21 20:38:51"),
				(4, "4", "27", "Published", "2016-12-21 20:38:51", "2016-12-21 20:38:51"),
				(5, "5", "23", "Published", "2016-12-21 20:38:51", "2016-12-21 20:38:51"),
				(6, "6", "35", "Published", "2016-12-21 20:38:51", "2016-12-21 20:38:51"),
				(7, "7", "27", "Published", "2016-12-21 20:38:51", "2016-12-21 20:38:51"),
				(8, "8", "36", "Published", "2016-12-21 20:38:51", "2016-12-21 20:38:51"),
				(9, "9", "18", "Published", "2016-12-21 20:38:51", "2016-12-21 20:38:51"),
				(10, "10", "32", "Published", "2016-12-21 20:38:51", "2016-12-21 20:38:51"),
				(11, "11", "31", "Published", "2016-12-21 20:38:51", "2016-12-21 20:38:51"),
				(12, "12", "28", "Published", "2016-12-21 20:38:51", "2016-12-21 20:38:51"),
				(13, "13", "25", "Published", "2016-12-21 20:38:51", "2016-12-21 20:38:51"),
				(14, "14", "35", "Published", "2016-12-21 20:38:51", "2016-12-21 20:38:51"),
				(15, "15", "33", "Published", "2016-12-21 20:38:51", "2016-12-21 20:38:51"),
				(16, "16", "33", "Published", "2016-12-21 20:38:51", "2016-12-21 20:38:51"),
				(17, "17", "28", "Published", "2016-12-21 20:38:51", "2016-12-21 20:38:51"),
				(18, "18", "24", "Published", "2016-12-21 20:38:51", "2016-12-21 20:38:51"),
				(19, "19", "29", "Published", "2016-12-21 20:38:51", "2016-12-21 20:38:51"),
				(20, "20", "30", "Published", "2016-12-21 20:38:51", "2016-12-21 20:38:51"),
				(21, "21", "31", "Published", "2016-12-21 20:38:51", "2016-12-21 20:38:51"),
				(22, "22", "29", "Published", "2016-12-21 20:38:51", "2016-12-21 20:38:51"),
				(23, "23", "35", "Published", "2016-12-21 20:38:51", "2016-12-21 20:38:51"),
				(24, "24", "34", "Published", "2016-12-21 20:38:51", "2016-12-21 20:38:51"),
				(25, "25", "28", "Published", "2016-12-21 20:38:51", "2016-12-21 20:38:51"),
				(26, "26", "28", "Published", "2016-12-21 20:38:51", "2016-12-21 20:38:51"),
				(27, "27", "27", "Published", "2016-12-21 20:38:51", "2016-12-21 20:38:51"),
				(28, "28", "28", "Published", "2016-12-21 20:38:51", "2016-12-21 20:38:51"),
				(29, "29", "27", "Published", "2016-12-21 20:38:51", "2016-12-21 20:38:51"),
				(30, "30", "33", "Published", "2016-12-21 20:38:51", "2016-12-21 20:38:51"),
				(31, "31", "31", "Published", "2016-12-21 20:38:51", "2016-12-21 20:38:51");
		';
		return $sql;
	}

	private function _down_script()
	{
		$sql = "
			TRUNCATE TABLE `chapter`;
		";
		return $sql;
	}
	
} // end 20161221204001_insert_chapters class