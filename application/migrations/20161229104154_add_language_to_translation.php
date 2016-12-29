<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: 20161229104154_add_language_to_translation.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 29 Dec 2016
	
	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]
	
***********************************************************************************/
/* Migration version: 
 * 29 Dec 2016, 10:41AM
 * 20161229104154
 */
class Migration_Add_language_to_translation extends CI_Migration
{
	// Public Functions ----------------------------------------------------------------
	public function up()
	{
        echo '<p>Up Script</p><hr/><code>';
		$this->load->model('Script_runner_model');
		echo $this->Script_runner_model->run_script($this->_up_script())['output_str'];
        echo '</code><hr/>';
	}
	
	public function down()
	{
        echo '<p>Down Script</p><hr/><code>';
        $this->load->model('Script_runner_model');
        echo $this->Script_runner_model->run_script($this->_down_script())['output_str'];
        echo '</code><hr/>';
	}
	
	// Private Functions ---------------------------------------------------------------
	private function _up_script()
	{
		$sql = "
			ALTER TABLE `translation`
			  ADD COLUMN `language` VARCHAR(512) NOT NULL;

            UPDATE `translation` SET `language` = 'English' WHERE `language` = '';
		";
		return $sql;
	}
	
	private function _down_script()
	{
		$sql = "
			ALTER TABLE `translation`
			  DROP COLUMN `language`;
		";
		return $sql;
	}
	
} // end 20161229104154_add_language_to_translation class