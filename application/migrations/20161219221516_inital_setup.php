<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: 20161211221516_inital_setup.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 19 Dec 2016
	
	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]
	
***********************************************************************************/
/* Migration version: 
 * 19 Dec 2016, 10:15PM
 * 20161219221516
 */
class Migration_Inital_setup extends CI_Migration
{
	// Public Functions ----------------------------------------------------------------
	public function up()
	{
		echo '<p>Create Tables</p><hr/><code>';
		$this->load->model('Script_runner_model');
		echo $this->Script_runner_model->run_script($this->_up_script())['output_str'];
		echo '</code><hr/>';
	}
	
	public function down()
	{
		echo '<p>Drop Tables</p><hr/><code>';
		$this->load->model('Script_runner_model');
		echo $this->Script_runner_model->run_script($this->_down_script())['output_str'];
		echo '</code><hr/>';
	}
	
	// Private Functions ---------------------------------------------------------------
	private function _up_script()
	{
		$this->load->library("datetime_helper");
		$password_hash = password_hash('password', PASSWORD_DEFAULT);
		$last_updated = $date_added = $this->datetime_helper->now('Y-m-d H:i:s');

		$script = "
			DROP TABLE IF EXISTS `ci_sessions`;
			CREATE TABLE `ci_sessions` (
				`id` varchar(40) NOT NULL,
				`ip_address` varchar(45) NOT NULL,
				`timestamp` int(10) unsigned NOT NULL DEFAULT '0',
				`data` blob NOT NULL,
				KEY `ci_sessions_timestamp` (`timestamp`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;


			DROP TABLE IF EXISTS `translation`;
			CREATE TABLE `translation` (
				`translation_id` INT(3) UNSIGNED NOT NULL AUTO_INCREMENT,
				`name` VARCHAR (512) NOT NULL,
				`abbr` VARCHAR(512) NOT NULL,
				`copyright` VARCHAR(512) NOT NULL,
				`status` VARCHAR(512) NOT NULL,
				`date_added` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
				`last_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				PRIMARY KEY(`translation_id`)
			) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


			DROP TABLE IF EXISTS `chapter`;
			CREATE TABLE `chapter` (
				`chapter_id` INT(3) UNSIGNED NOT NULL AUTO_INCREMENT,
				`total_verses` INT(4) UNSIGNED NOT NULL DEFAULT 0,
				`status` VARCHAR(512) NOT NULL,
				`date_added` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
				`last_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				PRIMARY KEY(`chapter_id`)
			) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


			DROP TABLE IF EXISTS `verse`;
			CREATE TABLE `verse` (
				`verse_id` INT(3) UNSIGNED  NOT NULL AUTO_INCREMENT,
				`chapter_id` INT(3) UNSIGNED NOT NULL,
				`translation_id` INT(3) UNSIGNED NOT NULL,
				`verse_no` INT(3) UNSIGNED NOT NULL,
				`verse` VARCHAR(512) NOT NULL,
				`status` VARCHAR(512) NOT NULL,
				`date_added` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
				`last_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				PRIMARY KEY(`verse_id`)
			) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


			DROP TABLE IF EXISTS `user_log`;
            CREATE TABLE `user_log` (
              `ulid` INT(3) NOT NULL AUTO_INCREMENT,
              `user_id` INT(3) NOT NULL,
              `message` text NOT NULL,
              `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
              PRIMARY KEY (`ulid`)
            ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


            DROP TABLE IF EXISTS `user`;
			CREATE TABLE `user` (
				`user_id` INT(3) UNSIGNED NOT NULL AUTO_INCREMENT,
				`username` VARCHAR(128) NOT NULL,
				`password_hash` VARCHAR(512) NOT NULL,
				`name` VARCHAR(128) NULL,
				`access` VARCHAR(128) NOT NULL,
				`status` VARCHAR(128) NOT NULL,
				`date_added` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
				`last_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				PRIMARY KEY(`user_id`)
			) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

			INSERT INTO `user` (`username`, `password_hash`, `name`, `access`, `status`, `date_added`, `last_updated`)
			VALUES('admin', '" . $password_hash . "', 'Default Admin', 'A', 'Active', '" . $date_added . "', '" . $last_updated . "');
		";

		return $script;
	}

	private function _down_script()
	{
		$script = "
			DROP TABLE IF EXISTS `ci_sessions`;

			DROP TABLE IF EXISTS `translation`;

			DROP TABLE IF EXISTS `chapter`;

			DROP TABLE IF EXISTS `verse`;

			DROP TABLE IF EXISTS `user_log`;

			DROP TABLE IF EXISTS `user`;
		";

		return $script;
	}
	
} // end 20161211221516_inital_setup class