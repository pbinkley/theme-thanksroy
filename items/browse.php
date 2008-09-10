<?php head(array('title'=>'Browse Items')); ?>

<?php
if (function_exists('COinSMultiple')):
    COinSMultiple($items);
endif;
?>

	<div id="primary" class="browse">
		<h1>Browse Items</h1>
		<ul class="navigation" id="secondary-nav">
			<?php echo nav(array('Browse All' => uri('items'), 'Browse by Tag' => uri('items/tags'))); ?>
		</ul>
		
		<div class="pagination top"><?php echo pagination_links(); ?></div>
		<?php while (loop_items()): ?>
			<div class="item hentry">
				<div class="item-meta">
				<h3><?php echo link_to_item(item('Title'), array('class'=>'permalink')); ?></h3>

				<?php if (item_has_thumbnail()): ?>
				<div class="item-img">
					<?php echo link_to_item(item_square_thumbnail(array('alt'=>item('Title',0)))); ?>						
				</div>
				<?php endif; ?>

				<?php if ($text = item('Text', array('index'=>0,'snippet'=>250))): ?>
	    			<div class="item-description">
    				<p><?php echo $text; ?></p>
    				</div>
				<?php elseif ($description = item('Description', array('index'=>0,'snippet'=>250))): ?>
    				<div class="item-description">
    				<?php echo $description; ?>
    				</div>
				<?php endif; ?>

				<?php if (item_has_tags()): ?>
				<div class="tags"><p><strong>Tags:</strong>
				<?php echo item_tags_as_string(); ?></p>
				</div>
				<?php endif;?>

				</div>
			</div>
		<?php endwhile; ?>
		<div class="pagination bottom"><?php echo pagination_links(); ?></div>
			
	</div>
<?php foot(); ?>