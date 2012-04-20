<?php
/**
 * @package   	JCE
 * @copyright 	Copyright � 2009-2011 Ryan Demmer. All rights reserved.
 * @license   	GNU/GPL 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * JCE is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('JPATH_BASE') or die('RESTRICTED');

/**
 * Renders a select element
 */

class JElementMediaplayer extends JElement
{
    /**
     * Element type
     *
     * @access  protected
     * @var   string
     */
    var $_name = 'Mediaplayer';
    
    public function fetchElement($name, $value, &$node, $control_name)
    {
        jimport('joomla.filesystem.folder');
        
        // path to images directory
        $path  = WF_EDITOR . DS . 'extensions' . DS . 'mediaplayer';
        $files = JFolder::files($path, '\.xml', false, true);
        
        $language = JFactory::getLanguage();
        
        // create unique id
        $id = preg_replace('#([^a-z0-9_-]+)#i', '', $control_name . 'mediaplayer' . $name);
        
    	// add javascript if element has parameters
		if ($node->attributes('parameters')) {
			$document = JFactory::getDocument();
			$document->addScriptDeclaration('$jce.Parameter.add("#' . $id . '", "mediaplayer");');
		}
        
        $options 	= array();
		
		$options[] = JHTML::_('select.option', 'none', WFText::_('WF_OPTION_NONE'));
        
    	if ( is_array($files) )
		{
			foreach ($files as $file)
			{
				// load language file
				$language->load('com_jce_'. $name . '_' . basename($file, '.xml'), JPATH_SITE);
				$xml 		= JApplicationHelper::parseXMLInstallFile($file);
				$options[] 	= JHTML::_('select.option', basename($file, '.xml'), WFText::_($xml['name']));
			}
		}
        
        return JHTML::_('select.genericlist',  $options, ''.$control_name.'[mediaplayer][' . $name . ']', 'class="inputbox"', 'value', 'text', $value, $id);
    }
}
?>
