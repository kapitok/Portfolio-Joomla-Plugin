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
 * Lbportfolio Model
 *
 * @package    Joomla.Components
 * @subpackage 	Lbportfolio
 */
class LbportfolioControllerLbportfolioitemlist extends LbportfolioController{

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
		$this->registerTask('add', 'edit');
		
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
		JRequest::setVar( 'hidemainmenu', 1 );
		
		$view =& $this->getView('lbportfolioitem', 'html');
		// Related table model include [NB: include recordset list model]
		// see http://www.mmleoni.net/joomla-component-builder/create-joomla-extensions-manage-the-back-end-part-2
		// tips: insert file name, not class name
		/*
		$altModel =& $this->getModel('relateTableModelList');
		$view->setModel($altModel);
		*/


		parent::display();
	}

	/**
	 * save a record (and redirect to main page)
	 * @return void
	 */
	public function save(){
		$model = $this->getModel('lbportfolioitemlist'); 

		if ($model->store($post)) {
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
		$model = $this->getModel('lbportfolioitem');
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
	
	
	public function publish(){
		$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);
		if (count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'SELECT_AN_ITEM_TO_PUBLISH' ) );
		}
		$cids = implode( ',', $cid );
		$db	=& JFactory::getDBO();
		$query = 'UPDATE #__lbportfolio_item SET published = 1 WHERE `id` IN ( '. $cids.'  )';
		$db->setQuery( $query );
		if (!$db->query()) {
			return JError::raiseWarning( 500, $db->getError() );
		}
		$this->setMessage( JText::sprintf('Fields published', $n ) );
		$this->setRedirect( 'index.php?option=com_lbportfolio&controller=lbportfolioitemlist' );
	}

	public function unpublish(){
		$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);
		if (count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'SELECT_AN_ITEM_TO_UNPUBLISH' ) );
		}
		$cids = implode( ',', $cid );
		$db	=& JFactory::getDBO();
		$query = 'UPDATE #__lbportfolio_item SET published = 0 WHERE `id` IN ( '. $cids.'  )';
		$db->setQuery( $query );
		if (!$db->query()) {
			return JError::raiseWarning( 500, $db->getError() );
		}
		$this->setMessage( JText::sprintf( 'Fields unpublished', $n ) );
		$this->setRedirect( 'index.php?option=com_lbportfolio&controller=lbportfolioitemlist' );
	}

	/*
	function cancel() {
		$model = $this->getModel( 'lbportfolioitem' );
		$model->checkin();
		$this->setRedirect( 'index.php?option=com_lbportfolio&view=lbportfolioitemlist' );
	}
	*/

	public function orderup(){
		$model = $this->getModel( 'lbportfolioitem' );
		$model->move(-1);
		$this->setRedirect( 'index.php?option=com_lbportfolio&controller=lbportfolioitemlist' );
	}

	public function orderdown(){
		$model = $this->getModel( 'lbportfolioitem' );
		$model->move(1);
		$this->setRedirect( 'index.php?option=com_lbportfolio&controller=lbportfolioitemlist' );
	}

	public function saveorder(){
		$cid 	= JRequest::getVar( 'cid', array(), 'post', 'array' );
		$order 	= JRequest::getVar( 'order', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);
		JArrayHelper::toInteger($order);

		$model = $this->getModel( 'lbportfolioitem' );
		$model->saveorder($cid, $order);

		$msg = JText::_( 'NEW_ORDERING_SAVED' );
		$this->setRedirect( 'index.php?option=com_lbportfolio&controller=lbportfolioitemlist', $msg );
	}
	
	
}