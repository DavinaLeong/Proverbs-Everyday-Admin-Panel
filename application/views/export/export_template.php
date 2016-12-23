<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: export_template.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 20 Dec 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
/**
 * @var $table_name
 * @var $id_field_name
 * @var $records
 * @var $fields_list
 */
$newline = "\n";
$tab = "\t";
$emptyline = $tab . $newline;

header("Content-Type: application/sql");
header("Content-Disposition: attachment; filename=" . $table_name . "_records_" . $this->datetime_helper->now('Ymdhis') . ".sql");
header("Pragma: no-cache");
header("Expires: 0");

echo "INSERT INTO `" . $table_name . "` (";
foreach($fields_list as $field_key=>$field_name)
{
    echo "`" . $field_name . "`";

    echo ($field_key < count($fields_list) - 1 ? ',' : '');
}
echo ") VALUES" . $newline;
foreach($records as $key=> $record)
{
    echo "(";
    foreach($fields_list as $field_key=>$field_name)
    {
        if($field_name == $id_field_name)
        {
            echo $record[$field_name];
        }
        else
        {
            echo "\"" . addslashes($record[$field_name]) . "\"";
        }

        echo ($field_key < count($fields_list) - 1 ? ',' : '');
    }
    echo ")" . ($key < count($records) - 1 ? ',' : ';') . $newline;
}