<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: view_translation_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 20 Dec 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
/**
 * @var $translation
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
                <li><a href="<?=site_url('translation/browse_translation');?>">Translations</a></li>
                <li class="active">Translation ID: <?=$translation['translation_id'];?></li>
            </ol>

            <div id="content-wrapper" class="row">
                <div class="col-lg-12">

                    <h1 class="page-header">View Translation&nbsp;
                        <div class="btn-group">
                            <button id="action_dropdown" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-gavel fa-fw"></i> Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="<?=site_url('translation/edit_translation/' . $translation['translation_id']);?>"><i class="fa fa-pencil-square-o fa-fw"></i> Edit</a></li>
                                <li><a class="clickable" data-toggle="modal" data-target="#delete_modal"><i class="fa fa-trash-o fa-fw"></i> Delete</a></li>
                            </ul>
                        </div>
                    </h1>
                    <?php $this->load->view('_snippets/message_box'); ?>

                    <div class="row">
                        <div class="col-md-10">

                            <form id="view_translation_form" class="form-horizontal">
                                <fieldset>
                                    <legend>Info</legend>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Name</label>
                                        <div class="col-md-10">
                                            <p id="name" class="form-control-static"><?=$translation['name'];?></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Abbr.</label>
                                        <div class="col-md-10">
                                            <p id="abbr" class="form-control-static"><?=$translation['abbr'];?></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Copyright</label>
                                        <div class="col-md-10">
                                            <div class="well well-sm" style="background: #fff">
                                                <p id="copyright"><?=nl2br($translation['copyright']);?></p>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <legend>Admin</legend>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="status">Status</label>
                                        <div class="col-md-10">
                                            <p class="form-control-static" id="status"><?=$translation['status'];?></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Date Added</label>
                                        <div class="col-md-10">
                                            <p id="date_added" class="form-control-static"><?=$this->datetime_helper->format_dd_mmm_yyyy_hh_ii_ss($translation['date_added']);?></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Last Updated</label>
                                        <div class="col-md-10">
                                            <p id="last_updated" class="form-control-static"><?=$this->datetime_helper->format_internet_standard($translation['last_updated']);?></p>
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