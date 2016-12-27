<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: passage_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 23 Dec 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
/**
 * @var $abbr
 * @var $chapter_no
 * @var $display_type
 * @var $translations
 * @var $chapter_passage
 * @var $verse_passages
 * @var $displays
 */
$url = site_url('passage/' . $abbr . '/' . $chapter_no) . '/';

$prev_chapter_no = $chapter_no > 1 ? $chapter_no - 1 : $chapter_no;
$prev_url = site_url('passage/' . $abbr . '/' . $prev_chapter_no) . '/';

$next_chapter_no = $chapter_no < 31 ? $chapter_no + 1 : $chapter_no;
$next_url = site_url('passage/' . $abbr . '/' . $next_chapter_no ). '/';
?><!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('page/_snippets/page_head_resources'); ?>
</head>
<body>
<?php $this->load->view('page/_snippets/page_header'); ?>

<!-- container start -->
<div class="container">

    <h1>Chapter <?=$chapter_no;?> (<?=$abbr;?>)</h1>
    <p class="date"><?= $this->datetime_helper->today('d M Y'); ?></p>

    <table id="passage_table">
        <tr>
            <?php if(in_array($display_type, $displays)): ?>
                <td id="left-chevron" class="col-xs-1 text-center">
                    <?php if($chapter_no > 1): ?>
                        <a class="chevron-link" href="<?=$prev_url . $display_type;?>"
                           data-toggle="tooltip" title="<?=$prev_chapter_no;?>">
                            <span class="hidden-xs"><i class="fa fa-angle-left fa-3x"></i></span>
                            <span class="visible-xs"><i class="fa fa-angle-left fa-lg"></i></span>
                        </a>
                    <?php else: ?>
                        <a class="chevron-link disabled-link">
                            <span class="hidden-xs"><i class="fa fa-angle-left fa-3x"></i></span>
                            <span class="visible-xs"><i class="fa fa-angle-left fa-lg"></i></span>
                        </a>
                    <?php endif; ?>
                </td>
                <td id="passage" class="col-xs-10">
                    <?php
                    switch($display_type)
                    {
                        case 'paragraph':
                            if(empty($chapter_passage))
                            {
                                echo '<p class="text-center">Passage not found</p>';
                            }
                            else
                            {
                                echo $chapter_passage['passage'];
                            }
                            break;

                        case 'grid':
                            if(empty($verse_passages))
                            {
                                echo '<p class="text-center">Passage not found.</p>';
                            }
                            else
                            {
                                foreach($verse_passages as $verse_passage)
                                {
                                    ?>
                                    <div class="row">
                                        <div class="col-xs-1 text-right"><?=$verse_passage['verse_no'];?></div>
                                        <div class="col-xs-11"><?=$verse_passage['passage'];?></div>
                                    </div>
                                    <?php
                                }
                            }
                            break;

                        default:
                            echo '<p class="text-center">Passage not found.</p>';
                            break;
                    }
                    ?>
                </td>
                <td id="right-chevron" class="col-xs-1 text-center">
                    <?php if($chapter_no < 31): ?>
                        <a class="chevron-link" href="<?=$next_url . $display_type;?>"
                           data-toggle="tooltip" title="<?=$next_chapter_no;?>">
                            <span class="hidden-xs"><i class="fa fa-angle-right fa-3x"></i></span>
                            <span class="visible-xs"><i class="fa fa-angle-right fa-lg"></i></span>
                        </a>
                    <?php else: ?>
                        <a class="chevron-link disabled-link">
                            <span class="hidden-xs"><i class="fa fa-angle-right fa-3x"></i></span>
                            <span class="visible-xs"><i class="fa fa-angle-right fa-lg"></i></span>
                        </a>
                    <?php endif; ?>
                </td>
            <?php else: ?>
                <td id="passage" class="text-center" style="vertical-align: top;"><p>Passage not found.</p></td>
            <?php endif; ?>
        </tr>
    </table>

</div>
<!-- container end -->

<!-- font start -->
<footer>
    <div class="container">
        <p class="text-center">Proverbs Everyday&nbsp;&nbsp;&#8226;&nbsp;&nbsp;2016&nbsp;&nbsp;&#8226;&nbsp;&nbsp;<a href="<?=$url . $display_type;?>/#top">Back to Top</a></p>
    </div>
</footer>
<!-- font end -->
<?php $this->load->view('page/_snippets/page_body_resources'); ?>
</body>
</html>
