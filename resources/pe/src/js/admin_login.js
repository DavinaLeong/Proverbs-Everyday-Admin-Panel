/**********************************************************************************
	- File Info -
		File name		: admin_login.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 28 Dec 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
var $username = null;
var $password = null;

function init()
{
	$username = $('#username');
	$password = $('#password');
}

function fillLoginForm()
{
	init();
    $username.val('admin');
    $password.val('prov2229');
}

function clearLoginForm()
{
	init();
	$username.val('');
	$password.val('');
}