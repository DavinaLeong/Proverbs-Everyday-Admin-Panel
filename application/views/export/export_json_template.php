<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: export_template.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 19 Apr 2017

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
/**
 *
 */
$newline = "\n";
$tab = "\t";
$emptyline = $tab . $newline;

header("Content-Type: application/sql");
header("Content-Disposition: attachment; filename=passages.json");
header("Pragma: no-cache");
header("Expires: 0");