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

require_once( WF_EDITOR_LIBRARIES .DS. 'classes' .DS. 'plugin.php' );


class WFPastePlugin extends WFEditorPlugin 
{
	
	public function __construct() {	
		parent::__construct();
	}
	
	/**
	 * Returns a reference to a manager object
	 *
	 * This method must be invoked as:
	 * 		<pre>  $manager =FileManager::getInstance();</pre>
	 *
	 * @access	public
	 * @return	FileManager  The manager object.
	 * @since	1.5
	 */
	public function &getInstance(){
		static $instance;

		if ( !is_object( $instance ) ){
			$instance = new WFPastePlugin();
		}
		return $instance;
	}
	
	public function display()
	{
		parent::display();

		$document = WFDocument::getInstance();

		$document->addScript(array('paste'), 'plugins');
		$document->addStyleSheet(array('paste'), 'plugins');
	}
	
	function getSettings()
	{
		$settings = array();		
		return parent::getSettings($settings);
	}
}
?>
