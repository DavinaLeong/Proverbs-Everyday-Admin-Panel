<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: index_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 26 Jul 2017

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
/**
 * @var $translations
 * @var $chapters
 * @var $searched_translation
 * @var $searched_chapter
 * @var $chapter_passage
 * @var $verse_passages
 */
?><!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('_snippets/meta'); ?>
    <?php $this->load->view('_snippets/head_resources'); ?>
    <link href="<?=RESOURCES_FOLDER;?>pe/dist/css/styles_parsley.min.css" rel="stylesheet" type="text/css">

    <style type="text/css">
        .status {
            display: inline-block;
            margin-right: 5px;
            font-size: 12px;
            border: thin solid #333;
            border-radius: 3px;
        }

        .status-title {
            color: #fff;
            background: #444;
            margin: 0;
            padding: 2px 5px;
        }

        .status-value {
            color: #000;
            background: #ccc;
            margin: 0;
            padding: 2px 5px;
        }

        .status-value-published {
            color: #fff;
            background: #080;
        }

        .status-value-draft {
            color: #fff;
            background: #800;
        }
    </style>
</head>
<body>
<div id="wrapper">
    <?php $this->load->view('_snippets/navbar'); ?>
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li><a href="<?=site_url('authenticate/start');?>">Home</a></li>
                <li class="active">Find Passage</li>
            </ol>

            <div id="content-wrapper" class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Find Passage</h1>
                    <?php $this->load->view('_snippets/validation_errors_box'); ?>
                    <?php $this->load->view('_snippets/message_box'); ?>

                    <div class="row">
                        <div class="col-md-11">

                            <div class="well well-sm">
                                <form class="form-inline" method="post" data-parsley-validate>

                                    <div class="form-group">
                                        <label class="sr-only" for="translation_id">Translation</label>
                                        <select class="form-control" name="translation_id" id="translation_id" required>
                                            <option id="translation_id_0" value=""
                                                <?=set_select('translation_id', '', ($this->session->userdata('SEARCHED_TRANSLATION_ID_KEY') == ''));?>>-- Select Translation --</option>
                                            <?php foreach($translations as $trans_key=>$translation): ?>
                                                <option id="translation_id_<?=$trans_key+1;?>" value="<?=$translation['translation_id'];?>"
                                                    <?=set_select('translation_id', '', ($this->session->userdata('SEARCHED_TRANSLATION_ID_KEY') == $translation['translation_id']));?>><?=$translation['name'];?> (<?=$translation['abbr'];?>)</option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="sr-only" for="chapter_id">Chapter</label>
                                        <select class="form-control" name="chapter_id" id="chapter_id" required>
                                            <option id="chapter_id_0" value=""
                                                <?=set_select('chapter_id', '', ($this->session->userdata('SEARCHED_CHAPTER_ID_KEY') == ''));?>>-- Select Chapter --</option>
                                            <?php foreach($chapters as $chapter_key=>$chapter): ?>
                                                <option id="chapter_id_<?=$chapter_key+1;?>" value="<?=$chapter['chapter_id'];?>"
                                                    <?=set_select('chapter_id', '', ($this->session->userdata('SEARCHED_CHAPTER_ID_KEY') == $chapter['chapter_id']));?>><?=$chapter['chapter_no'];?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-default" id="submit_btn" type="submit">
                                            <i class="fa fa-search fa-fw"></i> Find Passage
                                        </button>
                                    </div>

                                </form>
                            </div>

                            <?php if($searched_translation && $searched_chapter): ?>
                                <h3><small>Searched:</small> Chapter <?=$searched_chapter['chapter_no'];?>
                                    <span title="<?=$searched_translation['name'];?>">(<?=$searched_translation['abbr'];?>)</span></h3>

                                <p>
                                    <div class="status">
                                        <span class="status-title">Translation</span><span class="status-value status-value-<?=strtolower($searched_translation['status']);?>"><?=$searched_translation['status'];?></span>
                                    </div>
                                    <div class="status">
                                        <span class="status-title">Chapter</span><span class="status-value status-value-<?=strtolower($searched_chapter['status']);?>"><?=$searched_chapter['status'];?></span>
                                    </div>
                                </p>
                                <?php if($chapter_passage && $verse_passages): ?>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <div class="panel-title">Chapter Passage</div>
                                            </div>

                                            <div class="panel-body">
                                                <?=$chapter_passage['passage'];?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <div class="panel-title">Verse Passage</div>
                                            </div>

                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Passage</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach($verse_passages as $verse_passage): ?>
                                                    <tr>
                                                        <td><?=$verse_passage['verse_no'];?></td>
                                                        <td><?=$verse_passage['passage'];?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                            <?php endif; ?>

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