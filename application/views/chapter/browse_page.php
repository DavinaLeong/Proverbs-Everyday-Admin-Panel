<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: browse_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 20 Dec 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
/**
 * @var $chapters
 */
?><!DOCTYPE html>
<html>

<head>
    <?php $this->load->view('_snippets/meta'); ?>
    <?php $this->load->view('_snippets/head_resources'); ?>
    <link href="<?=RESOURCES_FOLDER;?>vendor/sb-admin-2/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?=RESOURCES_FOLDER;?>vendor/sb-admin-2/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet" type="text/css" />
</head>

<body>
<!-- Wrapper start -->
<div id="wrapper">
    <?php $this->load->view('_snippets/navbar'); ?>
    <!-- Page Content start -->
    <div id="page-wrapper">
        <ol class="breadcrumb">
            <li><a href="<?=site_url();?>">Home</a></li>
            <li class="active">Chapters</li>
        </ol>

        <div id="content-wrapper" class="row">
            <div class="col-lg-12">

                <div class="page-header">
                    <h1>Chapters&nbsp;
                        <div class="btn-group">
                            <button id="action_dropdown" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-gavel fa-fw"></i> Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="<?=site_url('chapter/export_chapter');?>"><i class="fa fa-download fa-fw"></i> Export Records</a></li>
                            </ul>
                        </div>
                    </h1>
                </div>
                <p class="lead">Click on a row to view a Chapter record.</p>
                <?php if( ! $chapters):?>
                    <div id="no_records_box" class="alert alert-warning" role="alert">
                        <h4><i class="fa fa-exclamation fa-fw"></i> No records found.</h4>
                        <p>Click <a href="<?=site_url('chapter/new_chapter');?>">here</a> to create a new record.</p>
                    </div>
                <?php endif;?>
                <?php $this->load->view('_snippets/message_box'); ?>

                <div class="row">
                    <div class="col-md-11">

                        <table id="chapters_table" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Chapter Number</th>
                                <th>Total Verses</th>
                                <th>Status</th>
                                <th>Last Updated</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($chapters as $key=>$chapter): ?>
                                <tr class="clickable" onclick="location.href = '<?=site_url("chapter/view_chapter/" . $chapter['chapter_id']);?>'">
                                    <td><?=$chapter['chapter_no'];?></td>
                                    <td><?=$chapter['total_verses'];?></td>
                                    <td><span class="status-<?=strtolower($chapter['status']);?>"><?=$chapter['status'];?></span></td>
                                    <td data-sort="<?=$chapter['last_updated'];?>"><?=$this->datetime_helper->format_dd_mmm_yyyy_space($chapter['last_updated']);?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
        <?php $this->load->view('_snippets/footer'); ?>
    </div>
    <!-- Page Content end -->

</div>
<!-- Wrapper end -->
<?php $this->load->view('_snippets/body_resources'); ?>
<script src="<?=RESOURCES_FOLDER;?>vendor/sb-admin-2/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?=RESOURCES_FOLDER;?>vendor/sb-admin-2/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="<?=RESOURCES_FOLDER;?>vendor/sb-admin-2/vendor/datatables-responsive/dataTables.responsive.js"></script>
<script>
    $(document).ready(function() {
        $('#chapters_table').DataTable({
            responsive: true,
            order: [[0, "asc"]]
        });
    });
</script>
</body>
</html>