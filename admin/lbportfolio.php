<?php
/**
 * @package    Lbportfolio
 * @subpackage com_lbportfolio
 * @license  !license!
 *
 * Created with Marco's Component Creator for Joomla! 1.6
 * http://www.mmleoni.net/joomla-component-builder
 *
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_lbportfolio')){
	return JError::raiseWarning(404, JText::_( 'JERROR_ALERTNOAUTHOR' ));
}

// Require the base controller
require_once( JPATH_COMPONENT.DS.'controller.php' );

$controllers = explode(',', 'lbportfoliocatlist,lbportfolioitemlist,lbportfoliocontentlist');
if(!JRequest::getWord('controller')){
	JRequest::setVar( 'controller', $controllers[0] );
}
foreach($controllers as $controller){
	$link = JRoute::_("index.php?option=com_lbportfolio&controller={$controller}");
	$selected = ($controller == JRequest::getWord('controller'));
	JSubMenuHelper::addEntry(JText::_( 'MENU' . $controller ), "index.php?option=com_lbportfolio&controller={$controller}", ($controller == JRequest::getWord('controller')));
}
JRequest::setVar( 'view', JRequest::getWord('controller') );


// Require specific controller if requested; allways, in standard execution
if($controller = JRequest::getWord('controller')) {
	$path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
	if (file_exists($path)) {
		require_once $path;
	} else {
		$controller = '';
	}
}

// Create the controller
$classname	= 'LbportfolioController'.$controller;
$controller	= new $classname( );

// Perform the Request task
$controller->execute( JRequest::getCmd( 'task' ) );

// Redirect if set by the controller
$controller->redirect();