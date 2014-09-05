<?php
/**
 * Lbportfolio View for Lbportfolio Component
 * 
 * @package    Lbportfolio
 * @subpackage com_lbportfolio
 * @license  GNU/GPL v2
 *
 * Created with Marco's Component Creator for Joomla! 1.6
 * http://www.mmleoni.net/joomla-component-builder
 *
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );

/**
 * Lbportfolio View
 *
 * @package    Joomla.Components
 * @subpackage 	Lbportfolio
 */
class LbportfolioViewLbportfoliocontentlist extends JView
{
	/**
	 * Lbportfoliocatlist view display method
	 * @return void
	 **/
	function display($tpl = null){
		
		$document=& JFactory::getDocument();
		JHTML::_('behavior.mootools');	
				
		$css = JURI::base().'/components/com_lbportfolio/css/lbportfolio.css';
		$document->addStyleSheet($css);
		
		$app =& JFactory::getApplication();
		$user  = JFactory::getUser();

		// Get data from the model
		$rows = & $this->get( 'Data');
		
		// draw menu
		//'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.delete'
		JToolBarHelper::title( JText::_( 'LBPORTFOLIO_MANAGER' ), 'generic.png' );
		if($user->authorise('core.edit', 'com_lbportfolio')) JToolBarHelper::editListX();
		if($user->authorise('core.create', 'com_lbportfolio')) JToolBarHelper::addNewX();
		if($user->authorise('core.delete', 'com_lbportfolio')) JToolBarHelper::deleteList();
		
		if( (isset($rows[0]->published)) && ($user->authorise('core.edit', 'com_mcm')) ){
			JToolBarHelper::divider();
			JToolBarHelper::publishList();
			JToolBarHelper::unpublishList();
		}
		
		// configuration editor for config.xml
		if($user->authorise('core.admin', 'com_lbportfolio')){
			JToolBarHelper::divider();
			JToolBarHelper::preferences('com_lbportfolio');
		}
		

		$this->assignRef('rows', $rows );
		$pagination =& $this->get('Pagination');
		$this->assignRef('pagination', $pagination);

		// SORTING get the user state of order and direction
		$default_order_field = 'id';
		$lists['order_Dir'] = $app->getUserStateFromRequest('com_lbportfoliofilter_order_Dir', 'filter_order_Dir', 'ASC');
		$lists['order'] = $app->getUserStateFromRequest('com_lbportfoliofilter_order', 'filter_order', $default_order_field);
		$lists['search'] = $app->getUserStateFromRequest('com_lbportfoliosearch', 'search', '');
		$this->assignRef('lists', $lists);


		parent::display($tpl);
	}
}