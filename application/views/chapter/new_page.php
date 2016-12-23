<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: new_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 21 Dec 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
/**
 * @var $status_options
 */
?><!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('_snippets/meta'); ?>
    <?php $this->load->view('_snippets/head_resources'); ?>
    <link href="<?=RESOURCES_FOLDER;?>pe/styles_parsley.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="wrapper">
    <?php $this->load->view('_snippets/navbar'); ?>
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li><a href="<?=site_url();?>">Home</a></li>
                <li><a href="<?=site_url('translation/browse_translation');?>">Chapters</a></li>
                <li class="active">New Chapter</li>
            </ol>

            <div id="content-wrapper" class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">New Chapter</h1>
                    <?php $this->load->view('_snippets/validation_errors_box'); ?>
                    <?php $this->load->view('_snippets/message_box'); ?>

                    <div class="row">
                        <div class="col-md-11">

                            <form id="new_chapter_form" class="form-horizontal" method="post" data-parsley-validate>
                                <fieldset>
                                    <legend>Info</legend>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="chapter_no">Chapter Number <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="number" id="chapter_no" name="chapter_no"
                                                   value="<?=set_value('chapter_no');?> " required step="1" min="1" max="999" maxlength="3" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="total_verses">Total Verses <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="number" id="total_verses" name="total_verses"
                                                   value="<?=set_value('total_verses');?> " required step="1" min="1" max="999" maxlength="3" />
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <legend>Admin</legend>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="status">Status</label>
                                        <div class="col-md-10">
                                            <select class="form-control" id="status" name="status" required>
                                                <option id="status_0" value="">-- Select Status --</option>
                                                <?php foreach($status_options as $key=>$option): ?>
                                                    <option id="status_<?=$key;?>" value="<?=$option;?>" <?=set_select('status', $option); ?>><?=$option;?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </fieldset>

                                <div class="form-group">
                                    <div class="col-md-10 col-md-offset-2">
                                        <button class="btn btn-primary" id="submit_btn" type="submit"><i class="fa fa-check fa-fw"></i> Submit</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
            <?php $this->load->view('_snippets/footer'); ?>
        </div>
    </div>
</div>
<?php $this->load->view('_snippets/body_resources'); ?>
<script src="<?=RESOURCES_FOLDER;?>vendor/parsleyjs/parsley.min.js"></script>
</body>
</html>