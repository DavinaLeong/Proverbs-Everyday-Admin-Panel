<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: new_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 20 Dec 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
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
                <li><a href="<?=site_url('translation/browse_translation');?>">Translations</a></li>
                <li class="active">New Translation</li>
            </ol>

            <div id="content-wrapper" class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">New Translation</h1>
                    <?php $this->load->view('_snippets/validation_errors_box'); ?>
                    <?php $this->load->view('_snippets/message_box'); ?>

                    <div class="row">
                        <div class="col-md-11">

                            <form id="new_translation_form" class="form-horizontal" method="post" data-parsley-validate>
                                <fieldset>
                                    <legend>Info</legend>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="name">Name <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="text" id="name" name="name"
                                                   value="<?=set_value('name');?> " required maxlength="512" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="abbr">Abbr. <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="text" id="abbr" name="abbr"
                                                   value="<?=set_value('abbr');?> " required maxlength="512" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="copyright">Copyright</label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" rows="4" id="copyright" name="copyright" maxlength="512"><?=set_value('copyright');?></textarea>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <legend>Admin</legend>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="status">Status</label>
                                        <div class="col-md-10">
                                            <p class="form-control-static" id="status">Draft</p>
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