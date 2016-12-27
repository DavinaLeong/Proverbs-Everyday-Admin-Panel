<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: new_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 22 Dec 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
/**
 * @var $translations
 * @var $chapters
 * @var $status_options
 */
?><!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('_snippets/meta'); ?>
    <?php $this->load->view('_snippets/head_resources'); ?>
    <link href="<?=RESOURCES_FOLDER;?>pe/dist/css/styles_parsley.min.css" rel="stylesheet" type="text/css">
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
                <li class="active">New Verse Passage</li>
            </ol>

            <div id="content-wrapper" class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">New Verse Passage</h1>
                    <?php $this->load->view('_snippets/validation_errors_box'); ?>
                    <?php $this->load->view('_snippets/message_box'); ?>

                    <div class="row">
                        <div class="col-md-11">

                            <form id="new_translation_form" class="form-horizontal" method="post" data-parsley-validate>
                                <fieldset>
                                    <legend>Info</legend>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="translation_id">Translation <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <select class="form-control" id="translation_id" name="translation_id" required>
                                                <option id="translation_id_0" value="">-- Select Translation --</option>
                                                <?php foreach($translations as $key=>$translation): ?>
                                                    <option id="translation_id_<?=$key+1;?>" value="<?=$translation['translation_id'];?>" <?=set_select('translation_id', $translation['translation_id']); ?>>
                                                        <?= $translation['name']; ?> (<?=$translation['abbr'];?>)
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="chapter_id">Chapter <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <select class="form-control" id="chapter_id" name="chapter_id" required>
                                                <option id="chapter_id_0" value="">-- Select Chapter --</option>
                                                <?php foreach($chapters as $key=>$chapter): ?>
                                                    <option id="chapter_id_<?=$key+1;?>" value="<?=$chapter['chapter_id'];?>" <?=set_select('chapter_id', $chapter['chapter_id']);?>><?=$chapter['chapter_no'];?> (total verses: <?=$chapter['total_verses'];?>)</option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="verse_no">Verse Number <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="text" id="verse_no" name="verse_no"
                                                   value="<?=set_value('verse_no');?> " required
                                                   data-parsley-type="digits" min="1" max="9999" maxlength="4" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="passage">Passage <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" rows="4" id="passage" name="passage" required><?=set_value('passage');?></textarea>
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
                                                    <option id="status_<?=$key+1;?>" value="<?=$option;?>" <?=set_select('status', $option); ?>><?=$option;?></option>
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