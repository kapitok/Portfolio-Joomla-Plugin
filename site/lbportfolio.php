<?php
/**
 * Lbportfolio entry point file for lbportfolio Component
 * 
 * @package    Lbportfolio
 * @subpackage com_lbportfolio
 * @license  !license!
 *
 * Created with Marco's Component Creator for Joomla! 1.6
 * http://www.mmleoni.net/joomla-component-builder
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

// Require the base controller
require_once (JPATH_COMPONENT.DS.'controller.php');


// define default controller & view if you need routing...
/*
if(!JRequest::getWord('controller')){
	JRequest::setVar( 'view', '***' ); // insert here!! 
}
*/

// Require specific controller if requested
if($controller = JRequest::getWord('controller')) {
	require_once (JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php');
}

// Create the controller
$classname	= 'LbportfolioController'.$controller;
$controller = new $classname();

// Perform the Request task
$controller->execute( JRequest::getCmd('task'));

// Redirect if set by the controller
$controller->redirect();

?>
