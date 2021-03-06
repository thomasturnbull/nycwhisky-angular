<?php // $Id: geocode.inc,v 1.5 2009/11/04 21:07:31 vauxia Exp $

class geocode {
  var $result;

  var $point;
  var $box;
  var $street1;
  var $street2;
  var $city;
  var $state;
  var $zip;
  var $country;
  var $country_name;

  function set_result($value) {
    $this->$result = $value;
  }

  function get_result($type, $item = NULL) {
    $func = 'get_'. $type;
    if (method_exists($this, $func)) {
      return $this->$func($item);
    }
  }

  function get_point() {
    return $this->point;
  }

  function get_linestring() {
    return $this->linestring;
  }

  function get_wkt($item) {
    // TODO figure out how to make any geo data type (shape, line) into a point.
    switch ($item) {
      case 'point':
        return 'POINT('. $this->point['lon'].' '. $this->point['lat'] .')';

      case 'linestring':
        $wkt = 'LINESTRING(';
        foreach ($this->linestring as $point) {
          $wkt .= $point['lon'] .' '. $point['lat'] .', ';
        }
        $wkt = substr($wkt, 0, -2) .')';
        return $wkt;
    }
  }

  function get_field_text($item) {
    return array('value' => $this->$item);
  }

  function get_field_postal() {
    $postal = array();
    foreach (array('street1', 'street2', 'city', 'state', 'zip', 'country') as $item) {
      if (isset($this->$item)) $postal[$item] = $this->$item;
    }
    return $postal;
  }
}

class geocode_google extends geocode {

  function set_result($result) {
    $this->result = $result;
    if (isset($result->AddressDetails)) {
      $addr = $result->AddressDetails->Country;
      $this->country_name = $addr->CountryName;
      $this->country = $addr->CountryNameCode;
      $this->state = $addr->AdministrativeArea->AdministrativeAreaName;
      $this->city = $addr->AdministrativeArea->Locality->LocalityName;
      $this->street1 = $addr->AdministrativeArea->Locality->Thoroughfare->ThoroughfareName;
      $this->zip = $addr->AdministrativeArea->Locality->PostalCode->PostalCodeNumber;
    }

    if (isset($result->Point)) {
      $point = (array) $result->Point->coordinates;
      $this->point = array(
        'type' => 'point', 'lat' => $point[1], 'lon' => $point[0], 'alt' => $point[2],
      );
    }
    if (isset($result->ExtendedData->LatLonBox)) {
      $this->box = (array) $result->ExtendedData->LatLonBox;
    }
  }

  function geocode($input, $options) {
    if (is_array($input)) $input = join(',', $input);
    $url = "http://maps.google.com/maps/geo?";
    $url .= 'q='. urlencode($input);

    // Deliberately reusing the GMAP key, still pending an interface.
    global $conf;
    if ($key = variable_get('googlemap_api_key', '')) {
      $url .= '&key='. check_plain($key);
    }
    $url .= '&sensor=false&output=json&oe=utf-8';
    $ret = drupal_http_request($url);
    $result = json_decode($ret->data);

    if ($result->Status->code == '200') {
      $this->set_result($result->Placemark[0]);
      return TRUE;
    }

    return FALSE;
  }
}
