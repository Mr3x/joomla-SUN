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

defined('_JEXEC') or die('RESTRICTED');

wfimport('editor.libraries.classes.extensions');

class WFMediaPlayerExtension extends WFExtension
{
    /**
     * @access  protected
     */
    public function __construct($config = array())
    {
        $default = array(
        	'name'		=> '',
			'title' 	=> '',
        	'params'	=> array()
        );
        
        $config = array_merge($default, $config);
        
        parent::__construct($config);
    }
    
    /**
     * Returns a reference to a manager object
     *
     * This method must be invoked as:
     *    <pre>  $manager =MediaManager::getInstance();</pre>
     *
     * @access  public
     * @return  MediaManager  The manager object.
     * @since 1.5
     */
	public static function getInstance($name = 'jceplayer')
    {
        static $instance;
        
        if (!is_object($instance)) {
        	$classname = '';
				
        	if ($name && $name != 'none') {
        		$player = parent::loadExtensions(array(
		            'types' => array(
		                'mediaplayer'
		            ),
		            'extension' => $name
		        ));
		        
		        $classname = 'WFMediaPlayerExtension_' . ucfirst($player);
        	}

	        if ($classname && class_exists($classname)) {
            	$instance = new $classname();
	        } else {
	        	$instance = new WFMediaPlayerExtension();
	        }
        }
        
        return $instance;
    }
    
    public function display()
    {
    	parent::display();
    	
    	$document = WFDocument::getInstance();
        
        // Load javascript    
        $document->addScript(array(
            'extensions/mediaplayer'
        ), 'libraries');
        
        if ($this->isEnabled() && $this->get('name')) {
        	$document->addScript(array(
            	'mediaplayer/' . $this->get('name') . '/js/' . $this->get('name')
        	), 'extensions');
        	
        	$document->addStyleSheet(array(
            	'mediaplayer/' . $this->get('name') . '/css/' . $this->get('name')
        	), 'extensions');
				
			$document->addScriptDeclaration('WFExtensions.MediaPlayer.init(' . json_encode($this->getProperties()) . ')');	
        }
    }
	
	public function isEnabled()
	{
		return false;
	}
    
    public function getName()
    {
    	return $this->get('name');
    }
    
	public function getTitle()
    {
    	return $this->get('title');
    }
    
    public function getParams()
    {
    	return $this->params;
    }
    
    public function getParam($param, $default = '')
    {
    	$params = $this->getParams();
    	
    	return isset($params[$param]) ? $params[$param] : $default;
    }
    
    /**
     * 
     * @param object $player
     * @return 
     */
    public function loadTemplate($tpl = '')
    {
        $output = '';
		
		if ($this->isEnabled()) {
			$path = WF_EDITOR_EXTENSIONS . DS . 'mediaplayer' . DS . $this->get('name');
        
	        $file = 'default.php';
	        
	        if ($tpl) {
	            $file = 'default_' . $tpl . '.php';
	        }
	        
	        if (file_exists($path . DS . 'tmpl' . DS . $file)) {
	            ob_start();
	            
	            include $path . DS . 'tmpl' . DS . $file;
	            
	            $output .= ob_get_contents();
	            ob_end_clean();
	        }
		}

        return $output;
    }
}
?>