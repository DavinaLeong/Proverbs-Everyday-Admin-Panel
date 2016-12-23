<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: browse_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 22 Dec 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
/**
 * @var $verse_passages
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
            <li class="active">Verse Passages</li>
        </ol>

        <div id="content-wrapper" class="row">
            <div class="col-lg-12">

                <div class="page-header">
                    <h1>Verse Passages&nbsp;
                        <div class="btn-group">
                            <button id="action_dropdown" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-gavel fa-fw"></i> Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="<?=site_url('verse_passage/export_verse_passage');?>"><i class="fa fa-download fa-fw"></i> Export Records</a></li>
                            </ul>
                        </div>
                    </h1>
                </div>
                <p class="lead">Click on a row to view a Verse Passage record.</p>
                <?php if( ! $verse_passages):?>
                    <div id="no_records_box" class="alert alert-warning" role="alert">
                        <h4><i class="fa fa-exclamation fa-fw"></i> No records found.</h4>
                        <p>Click <a href="<?=site_url('verse_passage/new_verse_passage');?>">here</a> to create a new record.</p>
                    </div>
                <?php endif;?>
                <?php $this->load->view('_snippets/message_box'); ?>

                <div class="row">
                    <div class="col-md-11">

                        <table id="verse_passages_table" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Chapter No</th>
                                <th>Verse No</th>
                                <th>Passage</th>
                                <th>Translation</th>
                                <th>Status</th>
                                <th>Last Updated</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($verse_passages as $key=>$verse_passage): ?>
                                <tr class="clickable" onclick="location.href = '<?=site_url("verse_passage/view_verse_passage/" . $verse_passage['vp_id']);?>'">
                                    <td><?=$verse_passage['chapter_no'];?></td>
                                    <td><?=$verse_passage['verse_no'];?></td>
                                    <td><?=word_limiter($verse_passage['passage'], 20);?></td>
                                    <td><?=$verse_passage['abbr'];?></td>
                                    <td><span class="status-<?=strtolower($verse_passage['status']);?>"><?=$verse_passage['status'];?></span></td>
                                    <td data-sort="<?=$verse_passage['last_updated'];?>"><?=$this->datetime_helper->format_dd_mmm_yyyy_space($verse_passage['last_updated']);?></td>
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
        $('#verse_passages_table').DataTable({
            responsive: true,
            order: [[0, "asc"]],
            pageLength: 25
        });
    });
</script>
</body>
</html>