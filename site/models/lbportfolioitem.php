<?php
/**
 * Lbportfolio Model for Lbportfolio Component
 * 
 * @package    Lbportfolio
 * @subpackage com_lbportfolio
 * @license  GNU/GPL v2
 *
 * Created with Marco's Component Creator for Joomla! 1.6
 * http://www.mmleoni.net/joomla-component-builder
 *
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.model' );

/**
 * Lbportfolio Model
 *
 * @package    Joomla.Components
 * @subpackage 	Lbportfolio
 */
class LbportfolioModelLbportfolioitem extends JModel{

	/**
	 * Lbportfolioitem data array for tmp store
	 *
	 * @var array
	 */
	private $_data;
	
	/**
	 * Gets the data
	 * @return mixed The data to be displayed to the user
	 */
	public function getData(){
		if (empty( $this->_data )){
			$id = JRequest::getInt('id',  0);
			$db =& JFactory::getDBO();
			$query = "SELECT * FROM `#__lbportfolio_item` where `id` = {$id}";
			$db->setQuery( $query );
			$this->_data = $db->loadObject();
		}
		return $this->_data;
	}
	
	public function getPortfolioItems(){

		$recordSet =& $this->getTable('lbportfolioitem');
		$db =& JFactory::getDBO();
		$query = 'SELECT * FROM `#__lbportfolio_item` WHERE ' . (isset($recordSet->published)?'`published`':'1') . ' = 1 ORDER BY `id` ';
		
		$db->setQuery($query);
		$portfolioItems = $db->loadAssocList();
		return $portfolioItems;
	}
}
