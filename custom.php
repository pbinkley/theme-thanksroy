<?php

function rcb_custom_show_item_metadata(array $options = array(), $item = null)
{
    if (!$item) {
        $item = get_current_item();
    }
    if ($dcFieldsList = get_theme_option('display_dublin_core_fields')) {

        $otherElementSets = array();

        $elementSets = get_db()->getTable('ElementSet')->findForItems();
        foreach ($elementSets as $set) {
            if ($set->name == 'Dublin Core') continue;
            $otherElementSets[] = $set->name;
        }

        $html = '<h2>' . __('Dublin Core') . '</h2>';
        $dcFields = explode(',', $dcFieldsList);
        foreach ($dcFields as $field) {
            $field = trim($field);
            if (element_exists('Dublin Core', $field)) {
                if ($fieldValues = item('Dublin Core', $field, 'all')) {
                    $html .= '<h3>'.__($field).'</h3>';
                    foreach ($fieldValues as $key => $fieldValue) {
                        if (!item_field_uses_html('Dublin Core', $field, $key)) {
                            $fieldValue = nls2p($fieldValue);
                        }
                        $html .= $fieldValue;
                    }
                }
            }
        }
        $html .= show_item_metadata(array('show_element_sets' => $otherElementSets));
        return $html;
    } else {
        return show_item_metadata($options, $item); 
    }
}

?>