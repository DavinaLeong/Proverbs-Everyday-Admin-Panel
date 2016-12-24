<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: passage_page.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 23 Dec 2016

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
<!-- navbar start -->
<nav id="top" class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=$url;?>">Proverbs Everyday</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <!-- search form start -->
            <form id="search-form" class="navbar-form navbar-left" method="post">
                <div class="form-group" data-toggle="tooltip" title="Chapter No.">
                    <select class="form-control" id="chapter_no" name="cnapter_no" required>
                        <option id="chapter_no_1" value="">-- Select Chapter ---</option>
                        <?php for($i = 1; $i <= 31; ++$i): ?>
                            <option id="chapter_no_<?=$i;?>" <?=set_select('chapter_no', $i);?>><?=$i;?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control" id="abbr" name="abbr" required>
                        <option id="translation_id_0" value="">-- Select Translation --</option>
                        <?php foreach($translations as $key=>$translation): ?>
                            <option id="translation_id_<?=$key+1;?>" value="<?=$translation['abbr'];?>" <?=set_select('abbr', $translation['abbr']);?>><?=$translation['name'];?> (<?=$translation['abbr'];?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button class="btn btn-navbar" type="submit" data-toggle="tooltip" title="Search"><i class="fa fa-search fa-fw"></i></button>
            </form>
            <!-- search form end -->

            <!-- right links start -->
            <ul class="nav navbar-nav navbar-right">
                <li data-toggle="tooltip" title="Paragraph View"><a href="#"><i class="fa fa-align-left fa-fw"></i> <span class="hidden-lg hidden-md hidden-sm">Paragraph</span></a></li>
                <li data-toggle="tooltip" title="Grid View"><a href="#"><i class="fa fa-th-large fa-fw"></i> <span class="hidden-lg hidden-md hidden-sm">Grid</span></a></li>
                <li data-toggle="tooltop" title="Back to top"><a href="<?=$url;?>/#top"><i class="fa fa-arrow-up fa-fw"></i> <span class="hidden-lg hidden-md hidden-sm">Back to Top</span></a></li>
            </ul>
            <!-- right links start -->
        </div>
    </div>
</nav>
<!-- navbar end -->

<div class="header"></div>

<!-- container start -->
<div class="container">

    <h1>Chapter 1</h1>
    <p class="date">20 Dec 2016</p>

    <table>
        <tr>
            <td class="col-xs-1 text-center">
                <a class="chevron-link" href="#">
                    <span class="hidden-xs"><i class="fa fa-angle-left fa-3x"></i></span>
                    <span class="visible-xs"><i class="fa fa-angle-left fa-lg"></i></span>
                </a>
            </td>
            <td class="col-xs-10">
                <p>Real sold my in call. Invitation on an advantages collecting. But event old above shy bed noisy. Had sister see wooded favour income has. Stuff rapid since do as hence. Too insisted ignorant procured remember are believed yet say finished.</p>

                <p>Gave read use way make spot how nor. In daughter goodness an likewise oh consider at procured wandered. Songs words wrong by me hills heard timed. Happy eat may doors songs. Be ignorant so of suitable dissuade weddings together. Least whole timed we is. An smallness deficient discourse do newspaper be an eagerness continued. Mr my ready guest ye after short at.</p>

                <p>Arrived compass prepare an on as. Reasonable particular on my it in sympathize. Size now easy eat hand how. Unwilling he departure elsewhere dejection at. Heart large seems may purse means few blind. Exquisite newspaper attending on certainty oh suspicion of. He less do quit evil is. Add matter family active mutual put wishes happen.</p>

                <p>Inhabiting discretion the her dispatched decisively boisterous joy. So form were wish open is able of mile of. Waiting express if prevent it we an musical. Especially reasonable travelling she son. Resources resembled forfeited no to zealously. Has procured daughter how friendly followed repeated who surprise. Great asked oh under on voice downs. Law together prospect kindness securing six. Learning why get hastened smallest cheerful.</p>

                <p>Extremity direction existence as dashwoods do up. Securing marianne led welcomed offended but offering six raptures. Conveying concluded newspaper rapturous oh at. Two indeed suffer saw beyond far former mrs remain. Occasional continuing possession we insensible an sentiments as is. Law but reasonably motionless principles she. Has six worse downs far blush rooms above stood.</p>

                <p>Dispatched entreaties boisterous say why stimulated. Certain forbade picture now prevent carried she get see sitting. Up twenty limits as months. Inhabit so perhaps of in to certain. Sex excuse chatty was seemed warmth. Nay add far few immediate sweetness earnestly dejection.</p>

                <p>Ask especially collecting terminated may son expression. Extremely eagerness principle estimable own was man. Men received far his dashwood subjects new. My sufficient surrounded an companions dispatched in on. Connection too unaffected expression led son possession. New smiling friends and her another. Leaf she does none love high yet. Snug love will up bore as be. Pursuit man son musical general pointed. It surprise informed mr advanced do outweigh.</p>

                <p>Concerns greatest margaret him absolute entrance nay. Door neat week do find past he. Be no surprise he honoured indulged. Unpacked endeavor six steepest had husbands her. Painted no or affixed it so civilly. Exposed neither pressed so cottage as proceed at offices. Nay they gone sir game four. Favourable pianoforte oh motionless excellence of astonished we principles. Warrant present garrets limited cordial in inquiry to. Supported me sweetness behaviour shameless excellent so arranging.</p>

                <p>Do in laughter securing smallest sensible no mr hastened. As perhaps proceed in in brandon of limited unknown greatly. Distrusts fulfilled happiness unwilling as explained of difficult. No landlord of peculiar ladyship attended if contempt ecstatic. Loud wish made on is am as hard. Court so avoid in plate hence. Of received mr breeding concerns peculiar securing landlord. Spot to many it four bred soon well to. Or am promotion in no departure abilities. Whatever landlord yourself at by pleasure of children be.</p>

                <p>Affronting discretion as do is announcing. Now months esteem oppose nearer enable too six. She numerous unlocked you perceive speedily. Affixed offence spirits or ye of offices between. Real on shot it were four an as. Absolute bachelor rendered six nay you juvenile. Vanity entire an chatty to.</p>
            </td>
            <td class="col-xs-1 text-center">
                <a class="chevron-link" href="#">
                    <span class="hidden-xs"><i class="fa fa-angle-right fa-3x"></i></span>
                    <span class="visible-xs"><i class="fa fa-angle-right fa-lg"></i></span>
                </a>
            </td>
        </tr>
    </table>

</div>
<!-- container end -->

<!-- font start -->
<footer>
    <div class="container">
        <p class="text-center">Proverbs Everyday&nbsp;&nbsp;&#8226;&nbsp;&nbsp;2016&nbsp;&nbsp;&#8226;&nbsp;&nbsp;<a href="<?=$url;?>/#top">Back to Top</a></p>
    </div>
</footer>
<!-- font end -->
<?php $this->load->view('page/page_body_resources'); ?>
</body>
</html>