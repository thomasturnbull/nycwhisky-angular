<?php // $Id: filefield.inc,v 1.3 2009/06/18 01:58:59 vauxia Exp $

/**
 * Implementation of hook_geocode_handler_info() on behalf of filefield.
 */
function filefield_geocode_handler_info() {
  return array(
    'geocode_filefield' => array(
      'label' => t('File field'),
      'module' => 'geocode',
      'file' => 'filefield.inc',
      'file path' => drupal_get_path('module', 'geocode') .'/includes/modules',
      'return types' => array(
        'geo' => array('linestring'),
      ),
      'field types' => array('filefield'),
    ),
  );
}

class geocode_filefield extends geocode {

  /**
   * Geocode from GPX files. (and hopefully additional formats, e.g. KML, ...)
   */
  function geocode($file) {
    if ($file['filepath']) {
      $filename = strtolower($file['filename']); 

      // file_get_mimetype() won't help us here.
      if (substr($filename, -4) == '.gpx') {
        module_load_include('inc', 'geocode', 'includes/modules/filefield/gpx');

        $gpx = New DOMDocument();
        $gpx->load($file['filepath']);
        if ($points = gpx_trackpoints($gpx)) {
          $this->set_result($points);
          return TRUE;
        }
      }
    }
    return FALSE;
  }

  function set_result($data) {

    $this->result = $data;
    $this->linestring = $this->result['data'];

    // Provide other vaules that may be used to generate bbox, centroid, etc.
    $this->min_lat = $this->result['data']['min_lat'];
    $this->min_lon = $this->result['data']['min_lon'];
    $this->max_lat = $this->result['data']['max_lat'];
    $this->max_lon = $this->result['data']['max_lon'];
  }
}
