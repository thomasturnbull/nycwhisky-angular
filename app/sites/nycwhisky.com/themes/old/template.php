<?php


function old_width($left, $right) {
  $width = 540;
  if (!$left ) {
    $width = $width +190;
  }  
  
   if (!$right) {
    $width = $width +190;
  }
  return $width;
}



/**
 * Return a themed breadcrumb trail.
 *
 * @param $breadcrumb
 *   An array containing the breadcrumb links.
 * @return a string containing the breadcrumb output.
 */
function phptemplate_breadcrumb($breadcrumb) {
  if (!empty($breadcrumb)) {
      $breadcrumb[] = drupal_get_title();
        array_shift($breadcrumb);
       return '<div class="path"><p><span>'.t('You are here').'</span>'. implode(' / ', $breadcrumb) .'</p></div>';
  }
}

/**
 * Implementation of preprocess_node()
 * Add map to locations
 */
function old_preprocess_node(&$variables) {
  if($variables['type'] == 'location') {
    $block = gmap_location_block_view($variables['nid']);
    $variables['map'] = $block['content'];
  }
}