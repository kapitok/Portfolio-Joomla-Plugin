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
 * Lbportfolio view
 *
 * @package    Joomla.Components
 * @subpackage 	Lbportfolio
 */
class LbportfolioViewLbportfolioitem extends JView
{
	/**
	 * display method of Lbportfolio view
	 * @return void
	 **/
	function display($tpl = null){
		$user  = JFactory::getUser();
		
		$document=& JFactory::getDocument();
		JHTML::_('behavior.mootools');	
				
		$css = JURI::base().'/components/com_lbportfolio/css/lbportfolio.css';
		$document->addStyleSheet($css);
		
		//get the data
		$data =& $this->get('Data');
		$isNew = ($data->id == null);

		$text = $isNew ? JText::_( 'NEW' ) : JText::_( 'EDIT' );
		JToolBarHelper::title(   JText::_( 'LBPORTFOLIO' ).': <small>[ ' . $text.' ]</small>' );
		
		if ($isNew)  {
			if($user->authorise('core.create', 'com_lbportfolio')) JToolBarHelper::save();
			JToolBarHelper::cancel();
		} else {
			if($user->authorise('core.edit', 'com_lbportfolio')) JToolBarHelper::save();
			// for existing items the button is renamed `close`
			JToolBarHelper::cancel( 'cancel', 'JTOOLBAR_CLOSE' );
		}

		$this->assignRef('data', $data);
		
		// create options for 'select' used in template
		$dataOptions = array();
		foreach(explode(',', '') as $field){
			if (!$field) continue;
			//options array are generated in the model...
			$dataOptions[$field] =& $this->get( ucfirst($field) );
		}
		
		/*
		// related table example 
		// thisTableFieldKey : foreign key (es #__content.catid -> 'catid')
		// relatedTableModelList : name used for table holding data (es #__content -> 'contentlist')
		// getRelatedTableFieldData : method for getting related table values for key (es #__categories.title -> 'getTitleFieldData()')
		// REMEMBER to add model inclusion in controller recordset list
		// see http://www.mmleoni.net/joomla-component-builder/create-joomla-extensions-manage-the-back-end-part-2

		$rmodel =& $this->getModel('relatedTableModelList'); 
		$dataOptions['thisTableFieldKey'] =& $rmodel->getRelatedTableFieldData();
		*/

		
		$this->assignRef('dataOptions', $dataOptions);

		parent::display($tpl);
	}
	
	public function showCatId( $id=0 )
	{
		$cat = '<select = name="cat_id" id="cat_id" >'
		 	. '<option value=0 > Chose category</option>';
		 $db = JFactory::getDbo();
		 $query = 'SELECT id, name FROM #__lbportfolio_cat ORDER BY name';
		 $db->setQuery($query);
		 $data = $db->loadAssocList();

		 foreach ($data as $row) {
		 	if ($row['id'] == $id) {
		 		$ch = 'selected="selected"';
		 	} else {
		 		$ch = '';
		 	}
		 	$cat .= "<option value='$row[id]' $ch>$row[name]</option>";
		 }
		 $cat .= '</select>';
		 echo $cat;
	}
}