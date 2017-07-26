<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: navbar_admin.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 20 Dec 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
?><!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <!-- header start -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?=site_url('authenticate/start');?>"><img src="<?=RESOURCES_FOLDER;?>pe/images/openbook_admin_16.png" />&nbsp;&nbsp;<?=SITE_TITLE;?></a>
    </div>
    <!-- header end -->

    <!-- top-links start -->
    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <?=$this->session->userdata('name');?> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="<?=site_url('authenticate/logout');?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
            </ul>
        </li>
    </ul>
    <!-- top-links end -->

    <!-- side-links start -->
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="#"><i class="fa fa-book fa-fw"></i> Translation<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?=site_url('translation/browse_translation');?>">Browse Translations</a>
                        </li>
                        <li>
                            <a href="<?=site_url('translation/new_translation');?>">New Translation</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-file fa-fw"></i> Chapter<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?=site_url('chapter/browse_chapter');?>">Browse Chapters</a>
                        </li>
                        <li>
                            <a href="<?=site_url('chapter/new_chapter');?>">New Chapter</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-file-text fa-fw"></i> Chapter Passage<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?=site_url('chapter_passage/browse_chapter_passage');?>">Browse Chapter Passages</a>
                        </li>
                        <li>
                            <a href="<?=site_url('chapter_passage/new_chapter_passage');?>">New Chapter Passage</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-file-text fa-fw"></i> Verse Passage<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?=site_url('verse_passage/browse_verse_passage');?>">Browse Verse Passages</a>
                        </li>
                        <li>
                            <a href="<?=site_url('verse_passage/new_verse_passage');?>">New Verse Passage</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-download fa-fw"></i> Export<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?=site_url('export/visualise');?>">View Sample</a>
                        </li>
                        <li>
                            <a href="<?=site_url('export/export_json');?>">As JSON</a>
                        </li>
                        <li>
                            <a href="<?=site_url('export/export_typescript');?>">As Typescript</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?=site_url();?>find_passage"><i class="fa fa-search fa-fw"></i> Find Passage</a>
                </li>
                <li>
                    <a href="<?=site_url();?>passage/kjv/1/paragraph" target="_blank"><i class="fa fa-globe fa-fw"></i> Sample Passage</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- side-links end -->
</nav>