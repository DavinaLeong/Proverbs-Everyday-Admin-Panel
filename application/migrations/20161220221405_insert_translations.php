<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: 20161220221405_insert_translations.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 20 Dec 2016
	
	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]
	
***********************************************************************************/
/* Migration version: 
 * 20 Dec 2016, 10:14PM
 * 20161220221405
 */
class Migration_Insert_translations extends CI_Migration
{
	// Public Functions ----------------------------------------------------------------
	public function up()
	{
		// create tables
		echo '<p>Populate Translations Table</p><hr/><code>';
		$this->load->model('Script_runner_model');
		echo $this->Script_runner_model->run_script($this->_up_script())['output_str'];
		echo '</code><hr/>';
	}
	
	public function down()
	{
		// drop tables
		echo '<p>Empty Tranlsations Table</p><hr/><code>';
		$this->load->model('Script_runner_model');
		echo $this->Script_runner_model->run_script($this->_down_script())['output_str'];
		echo '</code><hr/>';
	}
	
	// Private Functions ---------------------------------------------------------------
	private function _up_script()
	{
		$sql = '
			INSERT INTO `translation` (`translation_id`,`name`,`abbr`,`copyright`,`status`,`date_added`,`last_updated`) VALUES
			(1,"New King James Version","NKJV","The Holy Bible, New King James Version®. Copyright © 1982 by Thomas Nelson, Inc. All rights reserved.","Published","2016-12-20 19:31:23","2016-12-20 21:26:03"),
			(2,"Young\'s Literal Translation","YLT","Public Domain","Published","2016-12-20 20:43:02","2016-12-20 21:26:03"),
			(3,"New Living Translation","NLT","Holy Bible, New Living Translation, copyright © 1996, 2004, 2015 by Tyndale House Foundation. Used by permission of Tyndale House Publishers Inc., Carol Stream, Illinois 60188. All rights reserved.","Published","2016-12-20 20:44:53","2016-12-20 21:26:03"),
			(4,"New International Version","NIV","THE HOLY BIBLE, NEW INTERNATIONAL VERSION®, NIV® Copyright © 1973, 1978, 1984, 2011 by Biblica, Inc.® Used by permission. All rights reserved worldwide.","Published","2016-12-20 20:47:07","2016-12-20 21:26:03"),
			(5,"King James Version","KJV","Public Domain","Published","2016-12-20 20:47:47","2016-12-20 21:34:55"),
			(6,"The Message","MSG","Scripture taken from The Message. Copyright © 1993, 1994, 1995, 1996, 2000, 2001, 2002. Used by permission of NavPress Publishing Group.","Published","2016-12-20 20:52:35","2016-12-20 21:26:03"),
			(7,"Amplified Bible","AMP","All rights reserved. For Permission To Quote information visit http://www.lockman.org/

			The \"Amplified\" trademark is registered in the United States Patent and Trademark Office by The Lockman Foundation. Use of this trademark requires the permission of The Lockman Foundation.","Published","2016-12-20 20:56:06","2016-12-20 21:26:03"),
			(8,"English Standard Version","ESV","ESV Copyright and Permissions Information
			The Holy Bible, English Standard Version® (ESV®)
			Copyright © 2001 by Crossway,
			a publishing ministry of Good News Publishers.
			All rights reserved.
			ESV® Text Edition: 2016","Published","2016-12-20 20:58:54","2016-12-20 21:26:03");
		';
		return $sql;
	}

	private function _down_script()
	{
		$sql = "
			TRUNCATE TABLE `translation`;
		";
		return $sql;
	}
	
} // end 20161220221405_insert_translations class