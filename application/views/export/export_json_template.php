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
 * @var $translations
 */
//private function echo_tabs($times)
//{
//	for($i = 0; $i < $times; ++$i)
//	{
//		echo "\t";
//	}
//}

$newline = "\n";
$tab = "\t";
$emptyline = $tab . $newline;

header("Content-Type: application/sql");
header("Content-Disposition: attachment; filename=passages_" . $this->datetime_helper->now('Ymd-his') . ".json");
header("Pragma: no-cache");
header("Expires: 0");

echo "[" . $newline;
foreach($translations as $translation_key=>$translation)
{
	echo $tab . "{" . $newline;
	echo $tab . $tab . "\"name\": ". "\"" . $translation['name'] . "\"," . $newline;
	echo $tab . $tab . "\"abbr\": ". "\"" . $translation['abbr'] . "\"," . $newline;
	echo $tab . $tab . "\"copyright\": ". "\"" . $translation['copyright'] . "\"," . $newline;

	echo $tab . $tab . "\"chapters\": [" . $newline;
	$chapters = $translation['chapters'];
	foreach($chapters as $chapter_key=>$chapter)
	{
		if($chapter['paragraph'])
		{
			echo $tab . $tab . $tab . "{" . $newline;
			echo $tab . $tab . $tab . $tab . "\"chapterNo\": " . ($chapter_key+1) . "," . $newline;
			echo $tab . $tab . $tab . $tab . "\"paragraph\": " . json_encode($chapter['paragraph']) . "," . $newline;
			echo $tab . $tab . $tab . $tab . "\"grid\": [" . $newline;

			$grid = $chapter['grid'];
			foreach($grid as $verse_key=>$verse)
			{
				echo $tab . $tab . $tab . $tab . $tab . "\"" . $verse['passage'] . "\"" .
					($verse_key >= count($grid) - 1 ? '' : ',') . $newline;
			}

			echo $tab . $tab . $tab . $tab . "]" . $newline;
			echo $tab . $tab . $tab . "}";
			if($translation['abbr'] == 'YLT')
			{
				if($chapter_key < 10 - 1) echo ',';
			}
			else
			{
				if($chapter_key < count($chapters) - 1) echo ',';
			}
			echo $newline;
		}
	}
	echo $tab . $tab . "]" . $newline;

	echo $tab . "}" . ($translation_key >= count($translations) - 1 ? '' : ',') . $newline;
}
echo "]" . $newline;