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
 * @package		Lbportfolio
 * @subpackage	Components
 */
class LbportfolioViewLbportfolioitemlist extends JView
{
	protected $params;
	
	function display($tpl = null){
		
		$document=& JFactory::getDocument();
		JHTML::_('behavior.mootools');	
		
		$js = JURI::base().'components/com_lbportfolio/js/jquery-1.8.1.js';
		$document->addScript($js);
		
		$js = JURI::base().'components/com_lbportfolio/js/jquery-1.8.1.min.js';
		$document->addScript($js);

		$js = JURI::base().'components/com_lbportfolio/js/jquery.easing.1.3.js';
		$document->addScript($js);
		
		$js = JURI::base().'components/com_lbportfolio/js/jquery.quicksand.js';
		$document->addScript($js);
		
		$js = JURI::base().'components/com_lbportfolio/js/jquery.custom.js';
		$document->addScript($js);
				
		$css=JURI::base().'components/com_lbportfolio/css/style.css';
		$document->addStyleSheet($css);
		
		$app =& JFactory::getApplication();
		$this->params = $app->getParams();

		/*
		$params =& JComponentHelper::getParams( 'com_lbportfolio' );
		$params =& $app->getParams( 'com_lbportfolio' );	
		$dummy = $params->get( 'dummy_param', 1 ); 
		*/
		
		$data =& $this->get('Data');
		$this->assignRef('data', $data);
		
		$pagination =& $this->get('Pagination');
		$this->assignRef('pagination', $pagination);

		parent::display($tpl);
	}
}
?>
