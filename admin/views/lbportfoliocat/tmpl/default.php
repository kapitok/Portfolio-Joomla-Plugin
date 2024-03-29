<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php jimport( 'joomla.html.editor' ); $editor =& JFactory::getEditor(); ?>
<?php jimport( 'joomla.html.html' ); ?>
<?php $data =& $this->data; ?>
<script type="text/javascript">

	Joomla.submitbutton = function (pressbutton){
		var form = document.adminForm;
	
		if (pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		}
	
	
		// do field validation
		if (form.name.value == "") {
			alert( "<?php echo JText::_( 'Field Name must have a name', true ); ?>" );
		}  else {
			submitform( pressbutton );
		}
	}

</script>

<form action="index.php" method="post" name="adminForm" id="adminForm">
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
		<label for="description">
			<?php echo JText::_( 'DESCRIPTION' ); ?>:
		</label>
	</td>
	<td>
		<?php echo $editor->display('description', htmlspecialchars($this->data->description, ENT_QUOTES), '550', '300', '60', '20'); ?>
	</td>
</tr>
<!-- jcb code -->

		</table>
	</fieldset>
</div>
<div class="clr"></div>

<input type="hidden" name="option" value="com_lbportfolio" />
<input type="hidden" name="id" value="<?php echo $this->data->id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="lbportfoliocat" />
</form>
