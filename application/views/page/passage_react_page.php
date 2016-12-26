<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: passage_react_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 26 Dec 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
/**
 * @var $abbr
 * @var $chapter_no
 * @var $translations
 * @var $chapter_passage
 * @var $verse_passage
 */
$url = site_url('passage/' . $abbr . '/' . $chapter_no);
?><!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('page/page_head_resources'); ?>
</head>
<body>

<div id="Test"></div>

<?php $this->load->view('page/page_body_resources'); ?>
<!-- React JS -->
<script src="<?=RESOURCES_FOLDER;?>vendor/react/react-with-addons.js"></script>
<script src="<?=RESOURCES_FOLDER;?>vendor/react-dom/react-dom.js"></script>
<script src="<?=RESOURCES_FOLDER;?>pe/dist/js/Test.js"></script>
<script>
	var props = {};
	var element = React.createElement(Test, props);

	ReactDOM.render(element, document.getElementById('Test'));
</script>
</body>
</html>