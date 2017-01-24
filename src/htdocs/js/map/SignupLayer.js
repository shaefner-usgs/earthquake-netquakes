/* global L */
'use strict';


var Util = require('util/Util');


var _DEFAULTS,
    _OVERLAY_DEFAULTS;

_OVERLAY_DEFAULTS = {
  clickable: false,
  color: '#c00',
  fillColor: '#c00',
  fillOpacity: 0.1,
  opacity: 1,
  weight: 1
};
_DEFAULTS = {
  data: {},
  overlayOptions: _OVERLAY_DEFAULTS
};

/**
 * Factory for signup overlay (points, polys)
 *
 * @param options {Object}
 *     {
 *       data: {String} Geojson data
 *     }
 *
 * @return {L.FeatureGroup}
 */
var SignupLayer = function (options) {
  var _this,
      _initialize,

      _bounds,
      _overlayOptions,

      _createBounds,
      _onEachFeature,
      _pointToLayer;

  _this = {};

  _initialize = function () {
    options = Util.extend({}, _DEFAULTS, options);

    _bounds = {};
    _overlayOptions = Util.extend({}, _OVERLAY_DEFAULTS, options.overlayOptions);

    _this = L.geoJson(options.data, {
      onEachFeature: _onEachFeature,
      pointToLayer: _pointToLayer,
      style: _overlayOptions // polys (points styled in _pointToLayer())
    });
  };

  /*
   * Create a Leaflet bounds obj once for each region
   */
  _createBounds = function (code) {
    if (!_bounds[code]) {
      _bounds[code] = new L.LatLngBounds();
    }
  };

  /**
   * Leaflet GeoJSON option: called on each created feature layer. Useful for
   * attaching events and popups to features.
   *
   * @param feature {Object}
   * @param layer (L.Layer)
   */
  _onEachFeature = function (feature/*, layer*/) {
    var code;

    if (feature.type === 'Polygon') {
      // track bounds for each region
      code = feature.properties.code.toLowerCase();
      _createBounds(code);
      _bounds[code].extend(feature);
    }
  };

  /**
   * Leaflet GeoJSON option: used for creating layers for GeoJSON points
   *
   * @param feature {Object}
   * @param latlng {L.LatLng}
   *
   * @return marker {L.Marker}
   */
  _pointToLayer = function (feature, latlng) {
    var code,
        radius;

    radius = 1000; // default
    if (feature.properties.radius) {
      radius = 1000 * feature.properties.radius;
    }

    // track bounds for each region
    code = feature.properties.code.toLowerCase();
    _createBounds(code);
    _bounds[code].extend(latlng);

    return new L.Circle(latlng, radius, _overlayOptions);
  };


  _initialize();
  options = null;
  return _this;
};


L.signupLayer = SignupLayer;

module.exports = SignupLayer;
