<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: Debug_helper.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 28th Sep 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

 Description:
 * Created this class to assist in debugging.
 * Has functions which display's preset error messages as well a formatted ones.

***********************************************************************************/
class Debug_helper
{
    public function _error_page_not_implemented($page_name='page')
    {
        show_error(
            '<p style="font-size: 1.5em;">Page <strong style="color: #c00;">' . $page_name . '</strong> doesn\'t exist</p>' .
            '<p>Click <a href="javascript:history.back()">here</a> to return.</p>'
        );
    }

    public function _error_not_implemented($function_name='function')
    {
        show_error('<p style="font-size: 1em;"><strong style="font-size: 2em; color: #c00;">' .
            $function_name . '</strong> not implemented yet.');
    }

    public function _var_dump_pretty($data_to_vardump, $variable_name='variable_name', $remarks='')
    {
        echo '<div style="font-family: monospace; border: thin solid #ddd; padding: 5px 10px;">';
        echo '  <h3>' . $variable_name . '</h3>';
        if($remarks)
        {
            echo '  <p>' . $remarks . '</p>';
        }
        var_dump($data_to_vardump);
        echo '</div>';
    }

    public function _var_dump_bootstrap($data_to_vardump, $variable_name='variable_name', $remarks='')
    {
        echo '<div class="panel panel-default" style="font-family: monospace;">';
        echo '  <div class="panel-heading">';
        echo '      <h3 class="panel-title">' . $variable_name . '</h3>';
        echo '  </div>';
        echo '  <div class="panel-body">';
        if($remarks)
        {
            echo '    <p>' . $remarks . '</p>';
        }
        var_dump($data_to_vardump);
        echo '  </div>';
        echo '</div>';
    }

} // end Debug_helper class