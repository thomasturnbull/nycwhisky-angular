<?php
// $Id: imagecrop_actions.inc,v 1.1.4.7 2009/06/03 17:00:52 longwave Exp $

/**
 * @file
 * Imagecache actions implementation.
 *
 * @param $data values passed on by imagecache
 */

function imagecrop_javascript_form($data) {
  $form['width'] = array(
    '#type' => 'textfield',
    '#title' => t('Width'),
    '#required' => TRUE,
    '#default_value' => $data['width'],
    '#description' => t('Enter a width in pixels or as a percentage. i.e. 500 or 80%.'),
  );
  $form['height'] = array(
    '#type' => 'textfield',
    '#title' => t('Height'),
    '#required' => TRUE,
    '#default_value' => $data['height'],
    '#description' => t('Enter a height in pixels or as a percentage. i.e. 500 or 80%.'),
  );
  $form['xoffset'] = array(
    '#type' => 'textfield',
    '#title' => t('X offset'),
    '#default_value' => $data['xoffset'],
    '#description' => t('Enter an offset in pixels or use a keyword: <em>left</em>, <em>center</em>, or <em>right</em>.'),
  );
  $form['yoffset'] = array(
    '#type' => 'textfield',
    '#title' => t('Y offset'),
    '#default_value' => $data['yoffset'],
    '#description' => t('Enter an offset in pixels or use a keyword: <em>top</em>, <em>center</em>, or <em>bottom</em>.'),
  );
  $form['resizable'] = array(
    '#type' => 'checkbox',
    '#title' => t('Is the toolbox resizable or not?'),
    '#default_value' => $data['resizable'],
  );
  $form['disable_if_no_data'] = array(
    '#type' => 'checkbox',
    '#title' => t('Don\'t crop if cropping region wasn\'t set.'),
    '#default_value' => $data['disable_if_no_data'],
  );
  return $form;
}

/**
 * Display properties of a single action
 *
 * @param $element passed on by imagecache
 * @return string
 */
function theme_imagecrop_javascript($element) {
  $data = $element['#value'];
  return 'width: '. $data['width'] .', height: '. $data['height'] .', xoffset: '. $data['xoffset'] .', yoffset: '. $data['yoffset'] .', resizable: '. $data['resizable'] .', don\'t crop if region is not set: '. $data['disable_if_no_data'];
}

/**
 * Callback to perform the crop on an image
 *
 * @param $image current image resource
 * @param $data values associated with this action
 * @return false or true
 */
function imagecrop_javascript_image(&$image, $data) {
  $presetid = '';
  // if a global presetid is been set, it meens the image is generated from the imagecrop module
  if (isset($GLOBALS['imagecrop_presetid'])) {
    $presetid = $GLOBALS['imagecrop_presetid'];
  }
  // and if not, then we'll have to make a database call to get the id
  else {
    $args = explode('/', $_GET['q']);
    $key = array_search('imagecache', $args);
    if ($key != FALSE) {
      $key++;
      $presetname = $args[$key];
      $presetid = db_result(db_query("SELECT presetid FROM {imagecache_preset} WHERE presetname = '%s'", $presetname));
    }
  }

  if (!empty($presetid)) {
    $row = db_fetch_object(db_query("SELECT xoffset,yoffset,width,height,scale FROM {imagecrop} ic INNER JOIN {files} f on f.fid = ic.fid WHERE f.filepath = '%s' AND ic.presetid = %d AND reference = 'files'", $image->source, $presetid));
    // support for node images (this sucks in a way, because images are not stored in the files table)
    if (module_exists('node_images')) {
      $directory = variable_get('node_images_path', 'node_images');
      $pos = strpos($image->source, $directory);
      if ($pos !== FALSE)
      $row = db_fetch_object(db_query("SELECT xoffset,yoffset,width,height,scale FROM {imagecrop} ic INNER JOIN {node_images} ni on ni.id = ic.fid WHERE ni.filepath = '%s' AND ic.presetid = %d AND reference = 'node_images'", $image->source, $presetid));
    }

    $firstscale = FALSE;
    // fill cropping info from database
    if (!empty($row)) {
      $data['xoffset'] = $row->xoffset;
      $data['yoffset'] = $row->yoffset;
      $data['width'] = $row->width;
      $data['height'] = $row->height;
      $firstscale = TRUE;
    }
    else {
      // If there is no data in DB, use default or exit
      if ($data['disable_if_no_data'] == 1) {
        return TRUE;
      }
    }

    // add scale if necessary
    if ($row->scale != 'original' && $firstscale == TRUE) {
      if (!imageapi_image_scale($image, $row->scale, '', FALSE)) {
        watchdog('imagecrop', t('imagecache_scale_image failed before imagecrop'), WATCHDOG_ERROR);
        return FALSE;
      }
    }
  }

  if (!imageapi_image_crop($image, $data['xoffset'], $data['yoffset'], $data['width'], $data['height'])) {
    watchdog('imagecrop', t('imagecrop_javascript failed. image: %image, data: %data.', array('%path' => $image, '%data' => print_r($data, TRUE))), WATCHDOG_ERROR);
    return FALSE;
  }
  return TRUE;
}
