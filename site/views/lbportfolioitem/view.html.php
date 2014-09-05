<?php
/**
 * Lbportfolio View for com_lbportfolio Component
 * 
 * @package    Lbportfolio
 * @subpackage com_lbportfolio
 * @license  GNU/GPL v2
 *
 * Created with Marco's Component Creator for Joomla! 1.6
 * http://www.mmleoni.net/joomla-component-builder
 *
 */

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the Lbportfolio Component
 *
 * @package	Joomla.Components
 * @subpackage	Lbportfolio
 */
class LbportfolioViewLbportfolioitem extends JView
{
	function display($tpl = null)
	{
		$document=& JFactory::getDocument();
		JHTML::_('behavior.mootools');		
		$css=JURI::base().'components/com_lbportfolio/css/style.css';
		$document->addStyleSheet($css);
		
		$data = $this->get('Data');
		$this->assignRef('data', $data);

		parent::display($tpl);
	}
}
?>
