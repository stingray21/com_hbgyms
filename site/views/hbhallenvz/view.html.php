<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * HTML View class for the HB Hallenverzeichnis Component
 */
class HBhallenvzViewHBhallenvz extends JView
{
	// Overwriting JView display method
	function display($tpl = null)
	{
		$document = JFactory::getDocument();
		$document->addScript('https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false');
		$document->addScript(JURI::Root().'jquery-2.0.3.js');
		$document->addScript(JURI::Root().'components/com_hbhallenvz/maps_halle.js');
		
		
		$model = $this->getModel('hbhallenvz');
		//$this->assignRef('model', $model);
		
		// Mannschaften
		$mannschaften = $model->getMannschaften();
		$this->assignRef('mannschaften', $mannschaften);
		//echo "<pre>"; print_r($mannschaften); echo "</pre>";

		// Hallen
		$hallen = $model->getHallen('all');
		$this->assignRef('hallen', $hallen);
		//echo "<pre>"; print_r($hallen); echo "</pre>";
		
		
		//$post = JRequest::get('post');
		//echo "<pre>"; print_r($post); echo "</pre>";
		//$this->assignRef('post', $post);
		

		JHtml::stylesheet('com_hbhallenvz/site.stylesheet.css', array(), true);
		
		
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JLog::add(implode('<br />', $errors), JLog::WARNING, 'jerror');
			return false;
		}
		
		// Display the view
		parent::display($tpl);
	}
	
}