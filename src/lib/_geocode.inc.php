<?php

/**
 * Geocode a given address
 *
 * @param $address {String}
 *
 * @return {Array}
 *     geocoded result
 */
function geocode ($address) {
  $json = curlRequest($address);
  $result = json_decode($json, true);

  if ($result) { // success
    return array(
      'lat' => $result['results'][0]['locations'][0]['latLng']['lat'],
      'lon' => $result['results'][0]['locations'][0]['latLng']['lng'],
      'accuracy' => $result['results'][0]['locations'][0]['geocodeQuality']
    );
  } else { // unsuccessful; try less specific address
    $newAddress = trimAddress($address);
    if ($newAddress) {
      sleep(.1);
      return geocode ($newAddress);
    }
  }
}

// Send geocode request
function curlRequest ($str) {
  $key = 'Fmjtd|luur2h0bn1,2g=o5-9wbnhy';
  $url = sprintf ('http://www.mapquestapi.com/geocoding/v1/address?key=%s&outFormat=json&location=%s&maxResults=1', $key, urlencode($str));
  $ch = curl_init($url);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
  curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
  $response = curl_exec($ch);
  curl_close($ch);

  return $response;
}

// Remove first (most specific) part of address string
function trimAddress ($str) {
  preg_match('/[^,]+,\s*(.*)/', $str, $matches);

  if ($matches) {
    return $matches[1];
  }
}
