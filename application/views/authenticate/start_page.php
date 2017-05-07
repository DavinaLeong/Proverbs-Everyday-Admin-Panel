<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: login_page.php
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
</head>
<body>
<div id="wrapper">
    <?php $this->load->view('_snippets/navbar'); ?>
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="active">Home</li>
            </ol>

            <div id="content-wrapper" class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Welcome to <?=SITE_TITLE;?></h1>

                    <div class="row">
                        <div class="col-md-11">

                            <p class="lead">You are logged in as <span class="text-primary"><?=$this->session->userdata('name');?></span>.</p>
                            <?php $this->load->view('_snippets/message_box'); ?>

                            <h2>About</h2>
                            <ul>
                                <li>Backend UI for updating the Proverbs Everyday database.</li>
                            </ul>

                            <h2>Module Status</h2>
                            <h4>
                                <span class="label label-success"><i class="fa fa-check fa-fw"></i> Done</span>&nbsp;
                                <span class="label label-warning"><i class="fa fa-minus fa-fw"></i> Work in progress</span>&nbsp;
                                <span class="label label-danger"><i class="fa fa-times fa-fw"></i> Not Started</span>
                            </h4>
                            <br/>
                            <ul class="list-group">
                                <li class="list-group-item list-group-item-success">
                                    <i class="fa fa-check fa-fw"></i> Translation Module
                                </li>
                                <li class="list-group-item list-group-item-success">
                                    <i class="fa fa-check fa-fw"></i> Chapter Module
                                </li>
                                <li class="list-group-item list-group-item-success">
                                    <i class="fa fa-check fa-fw"></i> Verse Passage Module
                                </li>
                                <li class="list-group-item list-group-item-success">
                                    <i class="fa fa-check fa-fw"></i> Chapter Passage Module
                                </li>
                                <li class="list-group-item list-group-item-success">
                                    <i class="fa fa-check fa-fw"></i> Export Module
                                </li>
                            </ul>

                        </div>
                    </div>

                </div>
            </div>
            <?php $this->load->view('_snippets/footer'); ?>
        </div>
    </div>
</div>
<?php $this->load->view('_snippets/body_resources'); ?>
</body>
</html>