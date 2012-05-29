<?php
/*
 * use by views/layouts/main.php to create customer wediget
 * like menu or other related
 * this must be load after app() created
 */
//	initial
$cs=	Yii::app()->getClientScript();
$am=	Yii::app()->getAssetManager();
$ext=	Yii::app()->getBasePath()."/extensions";
$base=	Yii::app()->request->baseUrl;
$as=	null;//assign by asset Manager
$js=	null;//use for customer js input by php here
$ss=	null;//use for customer css input by php here
if($_SERVER['SystemRoot']=='H:\WINDOWS')
$cs->registerCSSFile(		$base.'/css/main.css');

//expect clear:left; all is repeat from original but needed background:#F5F5F5;
$ss	=".post .nav{-moz-border-radius:7px;padding:5px;clear:left;}";
$cs->registerCSS(			'reset-floating-images',$ss);

//register customer Cmenu
$as =$am->publish(			$ext.'/slidemenu');

$cs->registerCoreScript(	'jquery');
$cs->registerScriptFile(	$as.'/jqueryslidemenu.js');
$cs->registerCssFile(		$as.'/jqueryslidemenu.css');

$js ="var arrowimages={\n";
$js.="down:['downarrowclass', '".$as."/iis/down.gif', 23],\n";
$js.="right:['rightarrowclass', '".$as."/iis/right.gif']}\n";
$cs->registerScript(		'sm-iis',$js,			CClientScript::POS_HEAD);

$js ="jqueryslidemenu.buildmenu('slidemenu',arrowimages)";
$cs->registerScript(		'sm-run',$js,			CClientScript::POS_END);

//register highslide image popup
$as =$am->publish(			$ext.'/highslide');
$cs->registerCoreScript(	'jquery');
$cs->registerScriptFile(	$as.'/highslide.js',	CClientScript::POS_HEAD);
$cs->registerScriptFile(	$as.'/highslide_eh.js',	CClientScript::POS_HEAD);
$cs->registerCSSFile(		$as.'/highslide.css');

$js ='hs.graphicsDir = \''.$as.'/graphics/\';'."\n";
$js.='hs.outlineType = \'rounded-white\';'."\n";
$js.='hs.showCredits = false;';
$cs->registerScript(		'hislide-par',$js,		CClientScript::POS_BEGIN);

$js ='addHighSlideAttribute();';
$cs->registerScript(		'hislide-att',$js,		CClientScript::POS_END);

//		<!-- Piwik --> 
$js ='var pkBaseURL = (("https:" == document.location.protocol) ? "https://';
$js.=M::configMap('host').M::configMap('dirname').'" : "http://';
$js.=M::configMap('host').M::configMap('dirname').'");';
$js.='document.write(unescape("%3Cscript src=\'" + pkBaseURL + "piwik.js\' type=\'text/javascript\'%3E%3C/script%3E"));';
$cs->registerScript(		'piwik-init',$js,		CClientScript::POS_BEGIN);

$js ='try{var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 1);';
$js.='piwikTracker.trackPageView();piwikTracker.enableLinkTracking();}';
$js.='catch(err){}';
$cs->registerScript(		'piwik-track',$js,		CClientScript::POS_END);
//TODO
//<noscript><p><img src="http://"+M::configMap('host').M::configMap('dirname')+"/piwik.php?idsite=1" style="border:0" alt="" /></p></noscript>

//		 <!-- End Piwik Tracking Code -->




