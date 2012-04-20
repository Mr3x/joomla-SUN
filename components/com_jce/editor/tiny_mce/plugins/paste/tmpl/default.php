<?php
/**
 * @package   	JCE
 * @copyright 	Copyright © 2009-2011 Ryan Demmer. All rights reserved.
 * @license   	GNU/GPL 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * JCE is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined( 'WF_EDITOR' ) or die('RESTRICTED');
?>
<form onsubmit="return false;" action="#">
	<div id="title" class="title">{#paste_dlg.title}</div>		
	<div id="container"></div>
	
	<div class="mceActionPanel">
	<button id="insert" >{#insert}</button>
	<button id="cancel">{#cancel}</button>
	</div>
</form>