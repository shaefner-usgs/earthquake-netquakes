<?php

function geocode($str2geocode) {
  $result_json = curlRequest($str2geocode);
  $result_array = json_decode($result_json, true);

  if ($result_array) { // success
    return array(
      array(
        'lat' => $result_array['results'][0]['locations'][0]['latLng']['lat'],
        'lon' => $result_array['results'][0]['locations'][0]['latLng']['lng'],
        'accuracy' => $result_array['results'][0]['locations'][0]['geocodeQuality']
      )
    );
  } else { // unsuccessful; try less specific location
    $location = trimLocation($str2geocode);
    if ($location) {
      sleep(.1);
      return geocode ($location);
    }
  }
}

// Send geocode request
function curlRequest($location) {
  $key = 'Fmjtd|luur2h0bn1,2g=o5-9wbnhy';
  $url = sprintf ('http://www.mapquestapi.com/geocoding/v1/address?key=%s&outFormat=json&location=%s&maxResults=1', $key, urlencode($location));
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
  curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
  $response = curl_exec($ch);
  curl_close($ch);
  return $response;
}

// Remove first part of location string
function trimLocation($str2trim) {
  $location_parts = preg_split('/\s*,\s*/', $str2trim);
  if (count($location_parts) > 1) {
    array_shift($location_parts);
    $new_location = implode(',', $location_parts);
    return $new_location;
  }
}
