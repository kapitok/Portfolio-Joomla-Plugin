<?php
/**
 * Lbportfolio Controller for Lbportfolio Component
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
 * Lbportfolio Model
 *
 * @package    Joomla.Components
 * @subpackage 	Lbportfolio
 */
class LbportfolioControllerLbportfolioitem extends LbportfolioController{


	/**
	 * Parameters in config.xml.
	 *
	 * @var	object
	 * @access	protected
	 */
	private $_params = null;

	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	function __construct(){
		parent::__construct();

		// Register Extra tasks
		$this->registerTask( 'add'  , 	'edit' );
		
		// Set reference to parameters
		$this->_params = &JComponentHelper::getParams( 'com_lbportfolio' );
		//$dummy = $this->_params->get('parm_text');

	}

	/**
	 * display the edit form
	 * @return void
	 */
	public function edit(){
		JRequest::setVar( 'view', 'lbportfolioitem' );
		JRequest::setVar( 'layout', 'default'  );
		JRequest::setVar('hidemainmenu', 1);

		parent::display();
	}

	/**
	 * save a record (and redirect to main page)
	 * @return void
	 */
	public function save(){
		$model = $this->getModel('lbportfolioitem'); 

		if ($model->store()) {
			$msg = JText::_( 'DATA_SAVED' );
		} else {
			$msg = JText::_( 'ERROR_SAVING_DATA' );
		}

		// Check the table in so it can be edited.... we are done with it anyway
		$link = 'index.php?option=com_lbportfolio&controller=lbportfolioitemlist';
		$this->setRedirect($link, $msg);
	}

	/**
	 * remove record(s)
	 * @return void
	 */
	public function remove(){
		$model = $this->getModel('lbportfolioitem'); //
		if(!$model->delete()) {
			$msg = JText::_( 'ERROR_ONE_OR_MORE_DATA_COULD_NOT_BE_DELETED' );
		} else {
			$msg = JText::_( 'DATAS_DELETED' );
		}

		$this->setRedirect( 'index.php?option=com_lbportfolio&controller=lbportfolioitemlist', $msg );
	}

	/**
	 * cancel editing a record
	 * @return void
	 */
	public function cancel(){
		$msg = JText::_( 'OPERATION_CANCELLED' );
		$this->setRedirect( 'index.php?option=com_lbportfolio&controller=lbportfolioitemlist', $msg );
	}
}