<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php jimport( 'joomla.html.editor' ); $editor =& JFactory::getEditor(); ?>
<?php jimport( 'joomla.html.html' ); ?>
<?php $data =& $this->data; 
$weditor =& JFactory::getEditor();
    $descr_string = $weditor->display('description', $this->data->description, '550', '400', '60', '20', false);
?>
<script type="text/javascript">

	Joomla.submitbutton = function (pressbutton){
		var form = document.adminForm;
	
		if (pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		}
	
		// do field validation
		if (form.name.value == "") {
			alert( "<?php echo JText::_( 'Portfolio Item must have a name', true ); ?>" );
		} else if (form.cat_id.options[form.cat_id.selectedIndex].value == "0") {
			alert( "<?php echo JText::_( 'You must select a Category', true ); ?>" );		
		} else {
			submitform( pressbutton );
		}
	}

</script>

<form action="index.php" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'DETAILS' ); ?></legend>
		<table class="admintable">
<!-- jcb code -->
<tr>
	<td width="100" align="right" class="key">
		<label for="name">
			<?php echo JText::_( 'NAME' ); ?>:
		</label>
	</td>
	<td>
		<input class="text_area" type="text" name="name" id="name" size="32" maxlength="255" value="<?php echo htmlspecialchars($this->data->name, ENT_COMPAT, 'UTF-8');?>" />
	</td>
</tr>
<tr>
	<td width="100" align="right" class="key">
		<label for="cat_id">
			<?php echo JText::_( 'Category' ); ?>:
		</label>
	</td>
	<td>
		<?php if ($this->data->cat_id): ?>
			<?php $this->showCatId($this->data->cat_id) ?>
		<?php else: ?>
			<?php $this->showCatId() ?>
		<?php endif;?>
	</td>
</tr>
<tr>
	<td width="100" align="right" class="key">
		<label for="published">
			<?php echo JText::_( 'PUBLISHED' ); ?>:
		</label>
	</td>
	<td>
		<fieldset class="radio"><?php echo JHTML::_('select.booleanlist', 'published', null, $this->data->published, 'JYES', 'JNO', false); ?></fieldset>
	</td>
</tr>
<tr>
	<td width="100" align="right" class="key">
		<label for="img">
			<?php echo JText::_( 'IMG' ); ?>:
		</label>
	</td>
	<td>
			<?php if ($this->data->thumb):?>
				<div class="clear"></div>
					<div class="lb-img-container">
						<img src="<?php echo htmlspecialchars($this->data->thumb, ENT_COMPAT, 'UTF-8');?>" />
					</div>
				<div class="clear"></div>
				<input type="hidden" name="oldphoto" value="<?php echo $this->data->thumb ?>" />
			<?php endif; ?>
			<br />
			<input type="file" name="img" id="img" />
	</td>
</tr>
<tr>
	<td width="100" align="right" class="key">
		<label for="description">
			<?php echo JText::_( 'DESCRIPTION' ); ?>:
		</label>
	</td>
	<td>
		<?php echo $descr_string;//$editor->display('description', htmlspecialchars($this->data->description, ENT_QUOTES), '550', '300', '60', '20'); ?>
	</td>
</tr>
<tr>
	<td width="100" align="right" class="key">
		<label for="url">
			<?php echo JText::_( 'URL' ); ?>:
		</label>
	</td>
	<td>
		<input class="text_area" type="text" name="url" id="url" size="32" maxlength="255" value="<?php echo htmlspecialchars($this->data->url, ENT_COMPAT, 'UTF-8');?>" />
	</td>
</tr>


		</table>
	</fieldset>
</div>
<div class="clr"></div>

<input type="hidden" name="option" value="com_lbportfolio" />
<input type="hidden" name="id" value="<?php echo $this->data->id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="lbportfolioitem" />
</form>
