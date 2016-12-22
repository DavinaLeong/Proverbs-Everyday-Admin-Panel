<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: 20161222095139_alter_verse_table.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 22 Dec 2016
	
	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]
	
***********************************************************************************/
/* Migration version: 
 * 22 Dec 2016, 09:51AM
 * 20161222095139
 */
class Migration_Alter_verse_table extends CI_Migration
{
	// Public Functions ----------------------------------------------------------------
	public function up()
	{
		// create tables
        echo '<p>Alter Verse Table</p><hr/><code>';
        $this->load->model('Script_runner_model');
        echo $this->Script_runner_model->run_script($this->_up_script())['output_str'];
        echo '</code><hr/>';
	}
	
	public function down()
	{
		// drop tables
        echo '<p>Alter Verse Table</p><hr/><code>';
        $this->load->model('Script_runner_model');
        echo $this->Script_runner_model->run_script($this->_down_script())['output_str'];
        echo '</code><hr/>';
	}
	
	// Private Functions ---------------------------------------------------------------
	private function _up_script()
	{
		$sql = "
		    RENAME TABLE `verse` TO `verse_passage`;

		    ALTER TABLE `verse_passage`
		        CHANGE `verse_id` `vp_id` INT(3) UNSIGNED  NOT NULL AUTO_INCREMENT,
		        CHANGE `verse` `passage` VARCHAR(512) NOT NULL;
		";
        return $sql;
	}

    private function _down_script()
    {
        $sql = "
            RENAME TABLE `verse_passage` TO `verse`;

		    ALTER TABLE `verse`
		        CHANGE `vp_id` `verse_id` INT(3) UNSIGNED  NOT NULL AUTO_INCREMENT,
		        CHANGE `passage` `verse` VARCHAR(512) NOT NULL;
        ";
        return $sql;
    }
	
} // end 20161222095139_alter_verse_table class