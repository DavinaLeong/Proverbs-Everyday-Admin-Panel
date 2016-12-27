<?php
/**********************************************************************************
	- File Info -
		File name		: page_header.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 27 Dec 2016

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

defined('BASEPATH') OR exit('No direct script access allowed');
?><!-- navbar start -->
<nav id="top" class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=$url . $display_type;?>">Proverbs Everyday</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <!-- search form start -->
            <form id="search-form" class="navbar-form navbar-left" method="post" action="<?=site_url('page/process_search_form');?>">
                <div class="form-group" data-toggle="tooltip" title="Chapter No.">
                    <select class="form-control" id="chapter_no" name="chapter_no" required>
                        <option id="chapter_no_1" value="">-- Select Chapter ---</option>
                        <?php for($i = 1; $i <= 31; ++$i): ?>
                            <option id="chapter_no_<?=$i;?>" <?=set_select('chapter_no', $i, ($chapter_no == $i));?>><?=$i;?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control" id="abbr" name="abbr" required>
                        <option id="abbr_0" value="">-- Select Translation --</option>
                        <?php foreach($translations as $key=>$translation): ?>
                            <option id="abbr_<?=$key+1;?>" value="<?=$translation['abbr'];?>" <?=set_select('abbr', $translation['abbr'], ($abbr == $translation['abbr']));?>><?=$translation['name'];?> (<?=$translation['abbr'];?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control" id="display_type" name="display_type" required>
                        <option id="display_type_0" value="">-- Select View --</option>
                        <?php foreach($displays as $display_key=>$display): ?>
                            <option id="display_type_<?=$display_key+1;?>" value="<?=$display;?>" <?=set_select('display_type', $display, ($display == $display_type));?>><?=ucfirst($display);?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button class="btn btn-navbar" type="submit" data-toggle="tooltip" title="Search">
                    <i class="fa fa-search fa-fw"></i>
                </button>
            </form>
            <!-- search form end -->

            <!-- right links start -->
            <ul class="nav navbar-nav navbar-right">
                <li data-toggle="tooltip" title="Paragraph View"><a href="<?=$url . 'paragraph';?>"><i class="fa fa-align-left fa-fw"></i> <span class="hidden-lg hidden-md hidden-sm">Paragraph</span></a></li>
                <li data-toggle="tooltip" title="Grid View"><a href="<?=$url . 'grid';?>"><i class="fa fa-th-large fa-fw"></i> <span class="hidden-lg hidden-md hidden-sm">Grid</span></a></li>
                <li data-toggle="tooltop" title="Back to top"><a href="<?=$url . $display_type;?>/#top"><i class="fa fa-arrow-up fa-fw"></i> <span class="hidden-lg hidden-md hidden-sm">Back to Top</span></a></li>
            </ul>
            <!-- right links start -->
        </div>
    </div>
</nav>
<!-- navbar end -->

<div class="header"></div>