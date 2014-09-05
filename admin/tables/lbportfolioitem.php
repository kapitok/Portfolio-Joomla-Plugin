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

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Lbportfolio Table
 *
 * @package    Joomla.Components
 * @subpackage 	Lbportfolio
 */
class TableLbportfolioitem extends JTable{
	/** jcb code */
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;
	/**
	 *
	 * @var string
	 */
	var $name = null;
	/**
	 *
	 * @var string
	 */
	var $description = null;
	/**
	 *
	 * @var string
	 */
	var $url = null;
	/**
	 *
	 * @var int
	 */
	var $published = null;
	/**
	 *
	 * @var string
	 */
	var $img = null;
	
	var $thumb = null;
	/** jcb code */
	
	var $cat_id = null;

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableLbportfolioitem(& $db){
		parent::__construct('#__lbportfolio_item', 'id', $db);
	}
	
	function check(){
		// write here data validation code
		return parent::check();
	}
}