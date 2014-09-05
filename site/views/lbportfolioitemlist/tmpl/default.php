<?php // no direct access
defined('_JEXEC') or die('Restricted access'); 

$model      = $this->getModel();
$categories = $model->getCategories();
//var_dump($model->getContents());
	$portfolioEasing = $this->params->get('param_portfolio_easing') ? $this->params->get('param_portfolio_easing') : 'easeInOutCirc' ;
	$portfolioDuration = $this->params->get('param_portfolio_duration') ? $this->params->get('param_portfolio_duration') : 750;
	$portfolioAdjustHeight = $this->params->get('param_portfolio_adjust_height') ? $this->params->get('param_portfolio_adjust_height') : 'auto'; 
	$portfolioShowCatDesc = $this->params->get('param_show_desc_cat') ? $this->params->get('param_show_desc_cat') : false;
	$portfolioThumbWidth = $this->params->get('param_img_thumb_size') ? $this->params->get('param_img_thumb_size') : 250;
?>

<div class="content-before-portfolio">
	<?php foreach ($model->getContents() as $content): ?>
		<?php if ( ($content->position === 'before') && $content->published): ?>
			<div class="content-body" id="<?php echo $content->id ?>">
				<p><?php echo $content->description ?></p>
			</div>
			<?php endif; ?>
	<?php endforeach; ?>
</div>

<?php if ( count($this->data) ): ?>

<div class="nvp-portfolio">
	
	<div class="nvp-filter-style">
		<ul class="nvp-filter clearfix">  
			    <li><strong><?php echo JText::_('Categories') ?>:</strong></li>  
			    <li class="active"><a href="javascript:void(0)" class="all"><?php echo JText::_('All') ?></a></li>  
			    <?php foreach ($categories as $category): ?>
			    	<?php if ($category->published): ?>
			   			<li> <a href="javascript:void(0)" class="category<?php echo $category->id ?>"> <?php echo $category->name  ?></a> </li>
			   		<?php endif; ?>
			    <?php endforeach; ?>
		</ul> 
	</div>	

    <ul class="filterable-grid clearfix">  
    	
	    <?php foreach($this->data as $dataItem): ?> 
	    	<?php $category = $model->getCategory($dataItem->cat_id) ?>
	    	<?php $link = JRoute::_( "index.php?option=com_lbportfolio&view=lbportfolioitem&id={$dataItem->id}" );?>
	    	<?php if ($category->published): ?>
		    	<?php if($dataItem->published): ?>
		    		<?php if ($dataItem->thumb): ?>
				        <li data-id="item<?php echo $dataItem->id ?>" data-type="category<?php echo $dataItem->cat_id ?>"> 
				        	<div class="portfolio-item-content" style="width:<?php echo $portfolioThumbWidth ?>px" >
				           		<img src="<?php echo $dataItem->thumb; ?>" />
					             <p><?php echo $dataItem->name; ?></p>
					             <a href="<?php echo $link; ?>"><?php echo JText::_('Read More') ?></a>
				       		 </div>   
				        </li> 
				    <?php endif; ?> 
		        <?php endif; ?>
		    <?php endif; ?>
	    
	    <?php endforeach; ?>
	</ul>  
	
	<?php  if ($portfolioShowCatDesc): ?>
		<ul class="filterable-category-grid clearfix">
			<?php foreach ($categories as $category): ?>
				<li data-id="itemcat<?php echo $category->id ?>" data-type="category<?php echo $category->id ?>">  
					<span class="category-title"><?php echo $category->name ?></span>
					<div class="category-desc"><?php echo $category->description ?></div> 
				</li>  
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
		
	
	
</div><!-- end .nvp-portfolio -->
<div class="clear"></div>
<?php endif; //end count($this->data) ?>

<div class="content-after-portfolio">
	<?php foreach ($model->getContents() as $content): ?>
		<?php if (($content->position === 'after') && $content->published): ?>
			<div class="content-body" id="<?php echo $content->id ?>">
				<p><?php echo $content->description ?></p>
			</div>
		<?php endif;?>
	<?php endforeach; ?>
</div>

<script type="text/javascript">

	var lbEffectsData = {};
	
	lbEffectsData['portfolio'] = {
			duration: <?php echo $portfolioDuration ?>,
			easing: "<?php echo $portfolioEasing ?>",
            adjustHeight: "<?php $portfolioAdjustHeight ?>"
			}
</script>


	