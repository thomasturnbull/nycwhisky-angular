<?php
//template for new NYC Whisky Theme

function new_width($left, $right) {
  $width = 540;
  if (!$left ) {
    $width = $width +190;
  }  
  
   if (!$right) {
    $width = $width +190;
  }
  return $width;
}

function _phptemplate_variables($hook, $vars = array()) {
  switch ($hook) {
    case 'page':
      $vars['body_classes'] = 'foo';
    break;
  }
  return $vars;
}

// remove the revision information field from displaying for non moderator roles
function new_node_form($form) {
  // Remove 'Log message' text area
  $form['revision_information']['#access'] = false; //user_access('view revisions');
  return theme_node_form($form);
}
