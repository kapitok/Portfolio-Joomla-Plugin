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

jimport('joomla.application.component.model');

/**
 * Lbportfolio Model
 *
 * @package    Joomla.Components
 * @subpackage 	Lbportfolio
 */
class LbportfolioModelLbportfolioitem extends JModel{
	/**
	 * Constructor that retrieves the ID from the request
	 *
	 * @access	public
	 * @return	void
	 */
	function __construct(){
		parent::__construct();

		$array = JRequest::getVar('cid',  0, '', 'array');
		$this->setId((int)$array[0]);
	}
	
	function _imageresize($name, $newsize, $thumb=TRUE)
	{
		if(preg_match("/\.jpeg/", $name)||preg_match("/\.jpg/", $name)) {
			$src = imagecreatefromjpeg($name);
		} 
		
		if(preg_match("/\.png/", $name)) {
			$src = imagecreatefrompng($name);
		} 

		// Capture the original size of the uploaded image
		$size = getimagesize($name);
		
		if($size[0] >= $size[1]) {
			$newwidth = $newsize;
			$newheight = ($size[1]/$size[0])*$newwidth;
		} else{
			$newheight = $newsize;
			$newwidth = ($size[0]/$size[1])*$newheight;
		}
		
		$tmp = imagecreatetruecolor($newwidth, $newheight);
		
		// this line actually does the image resizing, copying from the original
		// image into the $tmp image
		imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $size[0], $size[1]);
		
		// now write the resized image to disk. I have assumed that you want the
		// resized, uploaded image file to reside in the ./images subdirectory.
		
			
		if( $thumb ) {
			/*$parts = explode(".", $name);
			$parts[0] .= "_thumb";
			$name = implode(".", $parts);
			*/
			$fileNameReplace = basename($name, '.' . pathinfo($name, PATHINFO_EXTENSION));
			$name = str_replace($fileNameReplace, $fileNameReplace . '_thumb', $name);
		}
		
		$filename = $name;
		if(preg_match("/\.jpeg/", $filename)||preg_match("/\.jpg/", $name)) {
			imagejpeg($tmp, $filename, 100);
		}  elseif (preg_match("/\.png/", $filename)) {
			imagepng($tmp, $filename);
		} 
		
		imagedestroy($src);
		imagedestroy($tmp);
		return $name;
	}

	/**
	 * Method to set the identifier for the record
	 *
	 * @access	public
	 * @param	int primary key identifier
	 * @return	void
	 */
	public function setId($id){
		// Set id and wipe data
		$this->_id		= $id;
		$this->_data	= null;
	}

	/**
	 * Method to get a record
	 * @return object with data
	 */
	public function &getData(){
		// Load the data
		if (empty( $this->_data )) {
			$query = 'SELECT * FROM `#__lbportfolio_item` WHERE `id` = '.$this->_id;
			$this->_db->setQuery( $query );
			$this->_data = $this->_db->loadObject();
		}
		if (!$this->_data) {
			$this->_data =& $this->getTable();
		}
		return $this->_data;
	}
	
	public function saveItemImage($width, $iwidth, $id=null)
	{
		jimport('joomla.filesystem.file');
		$photo = JRequest::getVar("img", "", "FILES", "array");
		
		$portfolioImgs = array();
		/*
		$imagePath = $_FILES['background-image-file']['tmp_name'];
		$imageName = $_FILES['background-image-file']['name'];
		*/
		
		
		$oldphoto = JRequest::getVar('oldphoto', '', 'post', 'string' );
		
		if( empty($oldphoto) ) {
			
				$uploadpath = JPATH_ROOT . DS . "images" . DS . "lbportfolio";
				
				if ($id) {
					$uploadpath .= DS . $id;
				}
				
				$path = "";
				if (!empty($photo["name"])) {
			        	$safename = JFile::makeSafe($photo["name"]);
			        	$safename = strtolower($safename);
	        			$safename = str_replace("_thumb", "", $safename);			
			        	
	        			JFile::upload( $photo["tmp_name"], $uploadpath . DS . $safename );
			        	
			        	$this->_imageresize($uploadpath . DS . $safename, $width);
			        	$this->_imageresize($uploadpath . DS . $safename, $iwidth, FALSE);
			        	
			        	$portfolioImgUrls['img'] = JUri::root() . "images/lbportfolio/" . $id . '/' . $safename;
			        	
			        	$parts = explode(".", $safename);
						$parts[0] .= "_thumb";
						$safename = implode(".", $parts);
			        	$path = JUri::root() . "images/lbportfolio/" . $id . '/' . $safename;
			        	
			        	$portfolioImgUrls['thumb'] = $path;
			        	return $portfolioImgUrls;
			        }

			} else {
				
				$ok = TRUE;
				$message="";
				if ( ( !empty( $photo["name"] )) && $ok ) {
			        	/* delete the old photos */
			        	$pathdelete = str_replace(JUri::root(), "", $oldphoto);
						$pathdelete = str_replace("/", DS, $pathdelete);
						
						JFile::delete(JPATH_ROOT . DS . $pathdelete);
						//delete thumbnail
						$pathdelete = str_replace("_thumb", "", $pathdelete);
						JFile::delete(JPATH_ROOT.DS.$pathdelete);
						
						/*upload the new one*/
						$uploadpath = JPATH_ROOT . DS . "images" . DS . "lbportfolio";
						
						if ($id) {
							$uploadpath .= DS . $id;
						}
						
						$safename = JFile::makeSafe($photo["name"]);
						$safename = strtolower($safename);
	        			$safename = str_replace("_thumb", "", $safename);			
			        	JFile::upload($photo["tmp_name"], $uploadpath . DS . $safename);
			        	
			        	$this->_imageresize($uploadpath . DS . $safename, $width);
			        	$this->_imageresize($uploadpath . DS . $safename, $iwidth, FALSE);
			        	
			        	$portfolioImgUrls['img'] = JUri::root() . "images/lbportfolio/" . $id . '/' . $safename;
			        	
			        	$parts = explode(".", $safename);
						$parts[0] .= "_thumb";
						$safename = implode(".", $parts);
			        	$path = JUri::root() . "images/lbportfolio/" . $id . '/' . $safename;
			        	$portfolioImgUrls['thumb'] = $path;
			        	
			        	return $portfolioImgUrls;
			        }
			     
			}
	}
	
	/**
	 * Method to store a record
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	public function store(){	
		$row =& $this->getTable();

		$data = JRequest::get( 'post' );
		// HTML content must be required!
		//$data['my_html_field'] = JRequest::getVar( 'my_html_field', '', 'post', 'string', JREQUEST_ALLOWHTML );
		
// mcm code 
		$data['id'] = JRequest::getVar('id', '', 'post', 'int');
		$data['description'] = JRequest::getVar('description', '', 'post', 'string', JREQUEST_ALLOWRAW);
		$data['published'] = JRequest::getVar('published', '', 'post', 'int');
		$data['cat_id'] = JRequest::getVar('cat_id', '', 'post', 'int');
		
		
		jimport( 'joomla.application.component.helper' );
		$params = &JComponentHelper::getParams( 'com_lbportfolio' );
		
		$imgSize = intval($params->get ('param_img_size')) ? intval($params->get ('param_img_size')) : 400;
 		$thumbSize = intval($params->get ('param_img_thumb_size')) ? intval($params->get ('param_img_thumb_size')) : 250;
		
 		if ($data['id']) {
 			$id = $data['id'];
 		} else {
 			srand(time());
 			$id = rand(1000, 9999);
 		}
 		$portfolioImgUrls = $this->saveItemImage($thumbSize, $imgSize, $id);
 		
 		$data['img'] = $portfolioImgUrls['img'];
 		$data['thumb'] = $portfolioImgUrls['thumb'];
// mcm code 


		// Bind the form fields to the table
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Make sure the record is valid
		if (!$row->check()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Store the web link table to the database
		if (!$row->store()) {
			$this->setError( $row->_db->getErrorMsg() );
			return false;
		}

		return true;
	}

	/**
	 * Method to delete record(s)
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	public function delete(){
		$cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );

		$row =& $this->getTable();

		if (count( $cids )) {
			foreach($cids as $cid) {
				if (!$row->delete( $cid )) {
					$this->setError( $row->getErrorMsg() );
					return false;
				}
			}
		}
		return true;
	}
	/**
	 * Method to move record(s)
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */			
	public function move($direction){
		$row =& $this->getTable();
		if (!$row->load($this->_id)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		if (!$row->move( $direction )) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		return true;
	}
				
	/**
	 * Method to save the new order
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	public function saveorder($cid = array(), $order){
		$row =& $this->getTable();

		// update ordering values
		$n = count($cid);
		for( $i=0; $i < $n; $i++ )
		{
			$row->load( (int) $cid[$i] );

			if ($row->ordering != $order[$i])
			{
				$row->ordering = $order[$i];
				if (!$row->store()) {
					$this->setError($this->_db->getErrorMsg());
					return false;
				}
			}
		}

		return true;
	}			

	/**
	 * Methods to get options arrays for specific fields
	 * @return object with data
	 */
	
	public function &getGenericFieldName(){
		$options = array(
            JHTML::_('select.option',  'val1', 'text 1' ),
            JHTML::_('select.option',  'val2', 'text 2' )
        );    
		return $options;
	}
	
	

}