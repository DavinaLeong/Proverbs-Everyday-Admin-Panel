<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: export_ts_template.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 19 Apr 2017

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
/**
 * @var $translations
 */

$newline = "\n";
$tab = "\t";
$emptyline = $tab . $newline;

header("Content-Type: application/json");
header("Content-Disposition: attachment; filename=passages_" . $this->datetime_helper->now('Ymd-his') . ".ts");
header("Pragma: no-cache");
header("Expires: 0");

echo "export default [" . $newline;
foreach($translations as $translation_key=>$translation)
{
	echo $tab . "{" . $newline;
	echo $tab . $tab . "id: ". $translation['translation_id'] . "," . $newline;
	echo $tab . $tab . "name: ". "\"" . $translation['name'] . "\"," . $newline;
	echo $tab . $tab . "abbr: ". "\"" . $translation['abbr'] . "\"," . $newline;
	echo $tab . $tab . "copyright: ". "\"" . $translation['copyright'] . "\"," . $newline;

	echo $tab . $tab . "chapters: [" . $newline;
	$chapters = $translation['chapters'];
	foreach($chapters as $chapter_key=>$chapter)
	{
		if($chapter['passage'])
		{
			echo $tab . $tab . $tab . "{" . $newline;
			echo $tab . $tab . $tab . $tab . "chapterNo: " . $chapter['chapter_no'] . "," . $newline;
			echo $tab . $tab . $tab . $tab . "chapterPassage: " . json_encode($chapter['passage']) . "," . $newline;
			echo $tab . $tab . $tab . $tab . "versePassages: [" . $newline;

			$verses = $chapter['grid'];
			foreach($verses as $verse_key=> $verse)
			{
				echo $tab . $tab . $tab . $tab . $tab . "{" . $newline;
				echo $tab . $tab . $tab . $tab . $tab . $tab . "verseNo: " . $verse['verse_no'] . "," . $newline;
				echo $tab . $tab . $tab . $tab . $tab . $tab . "versePassage: " . "\"" . $verse['passage'] . "\"" . $newline;
				echo $tab . $tab . $tab . $tab . $tab . "}" . ($verse_key >= count($verses) - 1 ? '' : ',') . $newline;

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