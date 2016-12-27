<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: view_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 22 Dec 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
/**
 * @var $verse_passage
 */
?><!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('_snippets/meta'); ?>
    <?php $this->load->view('_snippets/head_resources'); ?>
</head>
<body>
<div id="wrapper">
    <?php $this->load->view('_snippets/navbar'); ?>
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li><a href="<?=site_url('authenticate/start');?>">Home</a></li>
                <li><a href="<?=site_url('verse_passage/browse_verse_passage');?>">Verse Passages</a></li>
                <li class="active">Verse Passage ID: <?=$verse_passage['vp_id'];?></li>
            </ol>

            <div id="content-wrapper" class="row">
                <div class="col-lg-12">

                    <h1 class="page-header">View Verse Passage&nbsp;
                        <div class="btn-group">
                            <button id="action_dropdown" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-gavel fa-fw"></i> Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="<?=site_url('verse_passage/edit_verse_passage/' . $verse_passage['vp_id']);?>"><i class="fa fa-pencil-square-o fa-fw"></i> Edit</a></li>
                                <li><a class="clickable" data-toggle="modal" data-target="#delete_modal"><i class="fa fa-trash-o fa-fw"></i> Delete</a></li>
                            </ul>
                        </div>
                    </h1>
                    <?php $this->load->view('_snippets/message_box'); ?>

                    <div class="row">
                        <div class="col-md-11">

                            <form id="view_verse_passage_form" class="form-horizontal">
                                <fieldset>
                                    <legend>Info</legend>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Verse Number</label>
                                        <div class="col-md-10">
                                            <p id="verse_no" class="form-control-static"><?=$verse_passage['verse_no'];?></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Chapter</label>
                                        <div class="col-md-10">
                                            <p id="chapter_no" class="form-control-static"><?=$verse_passage['chapter_no'];?></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Translation</label>
                                        <div class="col-md-10">
                                            <p id="translation" class="form-control-static"><?=$verse_passage['name'];?> (<?=$verse_passage['abbr'];?>)</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Passage</label>
                                        <div class="col-md-10">
                                            <div class="well well-sm passage-well">
                                                <p id="passage"><?=$verse_passage['passage'];?></p>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <legend>Admin</legend>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="status">Status</label>
                                        <div class="col-md-10">
                                            <p class="form-control-static status-<?=strtolower($verse_passage['status']);?>" id="status"><?=$verse_passage['status'];?></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Date Added</label>
                                        <div class="col-md-10">
                                            <p id="date_added" class="form-control-static"><?=$this->datetime_helper->format_dd_mmm_yyyy_hh_ii_ss($verse_passage['date_added']);?></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Last Updated</label>
                                        <div class="col-md-10">
                                            <p id="last_updated" class="form-control-static"><?=$this->datetime_helper->format_internet_standard($verse_passage['last_updated']);?></p>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>

                        </div>
                    </div>

                    <?php $this->load->view('_snippets/generic_delete_modal'); ?>

                </div>
            </div>
            <?php $this->load->view('_snippets/footer'); ?>
        </div>
    </div>
</div>

<?php $this->load->view('_snippets/body_resources'); ?>
</body>
</html>