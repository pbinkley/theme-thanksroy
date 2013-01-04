<?php head(array('bodyid'=>'home', 'bodyclass' =>'two-col-primary')); ?>
<div id="primary">
    <?php if ($homepageText = get_theme_option('Homepage Text')): ?>
    <p><?php echo $homepageText; ?></p>
    <?php endif; ?>

<!-- list collections - based on http://omeka.org/codex/Functions/loop_collections -->
   <h2>Collections</h2>

    <div class="pagination"><?php echo pagination_links(); ?></div>
    <?php set_collections_for_loop(recent_collections(5)); ?>
    <?php while (loop_collections()): ?>
    <div class="collection">

        <h2><?php echo link_to_collection(); ?></h2>

        <div class="element">
           <!-- <h3><?php echo __('Description'); ?></h3> -->
            <div class="element-text"><?php echo nls2p(collection('Description', array('snippet'=>150))); ?></div>
        </div>

        <?php if(collection_has_collectors()): ?>
        <div class="element">
            <h3><?php echo __('Collector(s)'); ?></h3>
            <div class="element-text">
                <p><?php echo collection('Collectors', array('delimiter'=>', ')); ?></p>
            </div>
        </div>
        <?php endif; ?>
        
        <div class="collection-items">
<?php
$items = get_items(array('collection'=>get_current_collection()->id, 'featured' => true), 1);
set_items_for_loop($items);
while(loop_items()):
if (item_has_thumbnail()): 
    echo link_to_collection_for_item(item_square_thumbnail(),  array('class' => 'collection-img')); 
endif; 
endwhile; 
?>	
</div>	


        <p class="view-items-link"><?php echo link_to_browse_items(__('View the items in %s', collection('Name')), array('collection' => collection('id'))); ?></p>

        <?php echo plugin_append_to_collections_browse_each(); ?>

    </div><!-- end class="collection" -->
    <?php endwhile; ?>

    <?php echo plugin_append_to_collections_browse(); ?>



    <!-- Recent Items - suppressed pbinkley -->		
</div><!-- end primary -->

<div id="secondary">
    <?php if (get_theme_option('Display Featured Collection')): ?>
    <!-- Featured Collection -->
    <div id="featured-collection">
        <?php echo display_random_featured_collection(); ?>
    </div><!-- end featured collection -->
    <?php endif; ?>	
    <?php if ((get_theme_option('Display Featured Exhibit')) && function_exists('exhibit_builder_display_random_featured_exhibit')): ?>
    <!-- Featured Exhibit -->
    <?php echo exhibit_builder_display_random_featured_exhibit(); ?>
    <?php endif; ?>
    </div><!-- end recent-collections -->
    <?php if (get_theme_option('Display Featured Item') == 1): ?>
    <!-- Featured Item -->
    <div id="featured-item">
    <!-- note: we've modifed the function display_random_featured_items in application/helpers/ItemFunctions.php
     to include a link to the collection:
    
     set_current_item($randomItem);
     $html .= '<h4 style="clear: both;">&gt;&gt; ' . link_to_collection_for_item() . '</h4>';

      (inserted right before the return)    
      (and commented out the description)
    -->
    <?php echo display_random_featured_item(); ?>
    </div><!--end featured-item-->	
    <?php endif; ?>
</div><!-- end secondary -->
<?php foot(); ?>
