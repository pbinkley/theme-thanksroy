<?php head(array('title' => item('Dublin Core', 'Title'), 'bodyid'=>'items','bodyclass' => 'show')); ?>

<div id="primary">

    <ul class="item-pagination item-pagination-upper navigation">
        <li id="previous-item" class="previous"><?php echo link_to_previous_item(); ?></li>
        <li id="next-item" class="next"><?php echo link_to_next_item(); ?></li>
    </ul>

    <h1>"<?php echo item('Dublin Core', 'Title'); ?>"</h1>

    <!-- The following returns all of the files associated with an item. -->
    <div id="itemfiles" class="element">
        <div class="element-text"><?php echo display_files_for_item(); ?></div>
    </div>

    <!-- If the item belongs to a collection, the following creates a link to that collection. -->
    <?php if (item_belongs_to_collection()): ?>
    <div id="collection" class="element">
        <h3><?php echo __('Collection'); ?></h3>
        <div class="element-text"><p><?php echo link_to_collection_for_item(); ?></p></div>
    </div>
    <?php endif; ?>

    <!-- The following prints a list of all tags associated with the item -->
    <?php echo rcb_custom_show_item_metadata(); ?>

   <!-- this is where maps will go -->
   <?php 
      $coverage = item('Dublin Core', 'Coverage', array('delimiter' => '|')); 
      if ($coverage != ''):
         $covcount = 0;
         $coverages = explode("|", $coverage);
         
         reset($coverages);
         while (list(, $value) = each($coverages)):
            $covcount = $covcount + 1;
            $mapname = "map_canvas_" . $covcount;
   ?>
   <div id="<?php echo $mapname; ?>" style="width: 500px; height: 300px"></div>
   <script type="text/javascript"> 
      codeAddress("<?php echo $mapname; ?>", "<?php echo $value; ?>");
      </script>
   <?php 
         endwhile;
      endif; ?>
   
    <?php if (item_has_tags()): ?>
    <div id="item-tags" class="element">
        <h3><?php echo __('Tags'); ?></h3>
        <div class="element-text"><?php echo item_tags_as_string(); ?></div>
    </div>
    <?php endif;?>

    <!-- The following prints a citation for this item. -->
    <div id="item-citation" class="element">
        <h3><?php echo __('Citation'); ?></h3>
        <div class="element-text"><?php echo item_citation(); ?></div>
    </div>

    <?php echo plugin_append_to_items_show(); ?>

    <ul class="item-pagination navigation">
        <li id="previous-item" class="previous"><?php echo link_to_previous_item(); ?></li>
        <li id="next-item" class="next"><?php echo link_to_next_item(); ?></li>
    </ul>

</div><!-- end primary -->

<?php foot(); ?>
