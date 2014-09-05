<?php // no direct access
	defined('_JEXEC') or die('Restricted access'); 
	$data = $this->data;
	$link = JRoute::_( "index.php?option=com_lbportfolio&view=lbportfolioitem&id={$data->id}" );
	
	$linkBackToGrid = JRoute::_( "index.php?option=com_lbportfolio&view=lbportfolioitemlist");

	$portfolioItems = $this->getModel()->getPortfolioItems();
	
	$portfolioItemsIds = array();
	
	foreach ($portfolioItems as $key=>$value) {
		$portfolioItemsIds[] = $value['id'];
	}
	
	$currentId = $data->id;
	$currentPos = array_search($currentId, $portfolioItemsIds);
	///Form NEXT Link
	$nextPos = $currentPos+1;
	$nextUrl = '';
	if (array_key_exists($nextPos, array_keys($portfolioItemsIds))) {
		$nextId = $portfolioItemsIds[$nextPos];
		$nextUrl = JRoute::_( "index.php?option=com_lbportfolio&view=lbportfolioitem&id={$nextId}" );
	}
	//Form PREV Link
	$prevPos = $currentPos-1;
	$prevUrl = '';
	if (array_key_exists($prevPos, array_keys($portfolioItemsIds))) {
		$prevId = $portfolioItemsIds[$prevPos];
		$prevUrl = JRoute::_( "index.php?option=com_lbportfolio&view=lbportfolioitem&id={$prevId}" );
	}
	
?>

<div class="portfolio-item-details">
		
		<h3 class="portfolio-item-details-name"><?php echo $data->name; ?></h3>
		<div class="portfolio-item-description">
			
			<p class="portfolio-item-details-desc">
				<img src="<?php echo $data->img; ?>"/>
				
				<?php echo $data->description; ?>
				
				<?php if ($data->url): ?>
					<div class="portfolio-item-details-url"> 
						<a id="back-grid" href="<?php echo $data->url; ?>"> <?php echo JText::_('Link to project') ?></a>
					</div>
				<?php endif;?>

				<div class="clear"></div>
				<div class="portfolio-item_nav"> 
					<?php if($prevUrl): ?>
						<a id="prev-lbportfolio-item" href="<?php echo$prevUrl; ?>"><?php echo JText::_('Prev')?></a> 
					<?php endif; ?>
						<?php if ($prevUrl && $nextUrl):?>
							|
						<?php endif; ?>
					<?php if($nextUrl): ?>
						<a id="next-lbportfolio-item" href="<?php echo$nextUrl; ?>"><?php echo JText::_('Next')?></a>
					<?php endif; ?>
					<div class="clear"></div>
					<a id="back-lbportfolio-grid" href="<?php echo $linkBackToGrid?>"><?php echo JText::_('Back to grid') ?></a>
				</div>
			</p>
			
		</div>
		
	
		
	
</div>
