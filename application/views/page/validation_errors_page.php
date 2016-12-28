<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: validation_errors_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 23 Dec 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
/**
 * @var $translations
 * @var $displays
 */
?><!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('page/_snippets/page_head_resources'); ?>
</head>
<body>
<!-- container start -->
<div class="container">

    <h1>Error in Search Form</h1>

    <div id="passage" style="vertical-align: top;">
        <p class="text-danger"><?=validation_errors();?></p>
        <a href="javascript:history.back()"><i class="fa fa-arrow-left"></i> Go Back</a>
    </div>

</div>
<!-- container end -->

<!-- font start -->
<footer>
    <div class="container">
        <p class="text-center">Proverbs Everyday&nbsp;&nbsp;&#8226;&nbsp;&nbsp;2016</a></p>
    </div>
</footer>
<!-- font end -->
<?php $this->load->view('page/_snippets/page_body_resources'); ?>
</body>
</html>
