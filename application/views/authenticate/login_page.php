<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: login_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 11 Dec 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
?><!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('_snippets/meta'); ?>
    <?php $this->load->view('_snippets/head_resources'); ?>
    <link href="<?=RESOURCES_FOLDER;?>pe/dist/css/styles_parsley.min.css" rel="stylesheet" type="text/css">
    <style>
        html, body {
            width: 100%;
            height: 100%;
        }

        body {
            background: url(<?=RESOURCES_FOLDER;?>pe/images/linedpaper.png) repeat;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title text-center"><img data-toggle="tooltip" title="<?=SITE_TITLE;?>" src="<?=RESOURCES_FOLDER;?>pe/images/openbook_admin_128.png" alt="site logo" width="64" height="64" /></h3>
                </div>
                <div class="panel-body">
                    <form method="post" data-parsley-validate>
                        <?php $this->load->view('_snippets/validation_errors_box'); ?>
                        <?php $this->load->view('_snippets/message_box'); ?>
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" id="username" name="username" type="text" placeholder="Username" required autofocus />
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="password" name="password" type="password" placeholder="Password" required />
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <button class="btn btn-lg btn-primary btn-block" id="submit_btn" type="submit">Login</button>
                        </fieldset>
                    </form>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-6"><small><a href="<?=site_url('page/');?>" target="_blank">Today's Proverb</a></small></div>
                        <div class="col-md-6 text-right text-muted"><small><?=SITE_TITLE;?> &#8226; <?= $this->datetime_helper->today('Y'); ?></small></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('_snippets/body_resources'); ?>
<script src="<?=RESOURCES_FOLDER;?>vendor/parsleyjs/parsley.min.js"></script>
</body>
</html>