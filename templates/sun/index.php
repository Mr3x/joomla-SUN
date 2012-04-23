<?php  
/*------------------------------------------------------------------------
# author    your name or company
# copyright Copyright © 2011 example.com. All rights reserved.
# @license  http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Website   http://www.example.com
-------------------------------------------------------------------------*/

defined( '_JEXEC' ) or die; 

// variables
$app = JFactory::getApplication();
$doc = JFactory::getDocument(); 
$params = &$app->getParams();
$pageclass = $params->get('pageclass_sfx');
$pageclass .= ' page-itemid'.JRequest::getVar('Itemid', 1);
$tpath = $this->baseurl.'/templates/'.$this->template;

$this->setGenerator(null);

// load sheets and scripts
$doc->addStyleSheet($tpath.'/css/template.css.php?v=1.0.0'); 
$doc->addScript($tpath.'/js/modernizr.js'); // <- this script must be in the head

// unset scripts, put them into /js/template.js.php to minify http requests
unset($doc->_scripts[$this->baseurl.'/media/system/js/mootools-core.js']);
unset($doc->_scripts[$this->baseurl.'/media/system/js/core.js']);
unset($doc->_scripts[$this->baseurl.'/media/system/js/caption.js']);

?><!doctype html>
<!--[if IEMobile]><html class="iemobile" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if gt IE 8]><!-->  <html class="no-js" lang="<?php echo $this->language; ?>"> <!--<![endif]-->

<head>
  <script type="text/javascript" src="<?php echo $tpath.'/js/template.js.php'; ?>"></script>
  <jdoc:include type="head" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" /> <!-- mobile viewport -->
  <link rel="stylesheet" media="only screen and (max-width: 768px)" href="<?php echo $tpath; ?>/css/tablet.css" type="text/css" />
  <link rel="stylesheet" media="only screen and (min-width: 320px) and (max-width: 480px)" href="<?php echo $tpath; ?>/css/phone.css" type="text/css" />
  <!--[if IEMobile]><link rel="stylesheet" media="screen" href="<?php echo $tpath; ?>/css/phone.css" type="text/css" /><![endif]--> <!-- iemobile -->
  <link rel="apple-touch-icon-precomposed" href="<?php echo $tpath; ?>/apple-touch-icon-57x57.png"> <!-- iphone, ipod, android -->
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $tpath; ?>/apple-touch-icon-72x72.png"> <!-- ipad -->
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $tpath; ?>/apple-touch-icon-114x114.png"> <!-- iphone retina -->
  <!--[if lte IE 8]>
    <style> 
      {behavior:url(<?php echo $tpath; ?>/js/PIE.htc);}
    </style>
  <![endif]-->
</head>
	
<body class="<?php echo $pageclass; ?>">
<div id="overall">
  <div id="header">
    <div class="container">
      <jdoc:include type="modules" name="header" style="block" />
    </div>
  </div>
    <div class="container">
      <div id="sidebar">
        <jdoc:include type="modules" name="sidebar" style="block" />
      </div>
      <div id="content">
      		<jdoc:include type="modules" name="content-top" style="none" />
      		<div class="content">
	    		<jdoc:include type="message" />
	    		<jdoc:include type="component" />
      		</div>
      		<jdoc:include type="modules" name="content-bottom" style="none" />
      </div>
    </div>
    <div id="footer-top" class="container">
        <jdoc:include type="modules" name="footer-top" style="block" />
    </div>
    <div id="footer" class="container">
        <jdoc:include type="modules" name="footer" style="clearcontent" />
    </div>
</div>
  <jdoc:include type="modules" name="debug" />
</body>
</html>