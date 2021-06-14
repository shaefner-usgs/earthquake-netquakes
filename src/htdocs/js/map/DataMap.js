/* global L, MOUNT_PATH */
'use strict';


var Xhr = require('hazdev-webutils/src/util/Xhr');

// Factories for creating map layers (returns e.g. "L.earthquakesLayer()")
require('map/DarkLayer');
require('map/GreyscaleLayer');
require('map/InstrumentsLayer');
require('map/SatelliteLayer');
require('map/TerrainLayer');


/*
 * Factory for Leaflet map instance on view data page
 */
var DataMap = function (options) {
  var _initialize,
      _this,

      _el,
      _instruments,

      _getMapLayers,
      _initMap,
      _loadInstrumentsLayer;

  _this = {};


  _initialize = function (options) {
    options = options || {};
    _el = options.el || document.createElement('div');

    // Load instruments layer which calls initMap() when finished
    _loadInstrumentsLayer();
  };

  /**
   * Get all map layers that will be displayed on map
   *
   * @return layers {Object}
   *     {
   *       baseLayers: {Object}
   *       overlays: {Object}
   *       defaults: {Array}
   *     }
   */
  _getMapLayers = function () {
    var dark,
        greyscale,
        layers,
        satellite,
        terrain;

    dark = L.darkLayer();
    greyscale = L.greyscaleLayer();
    satellite = L.satelliteLayer();
    terrain = L.terrainLayer();

    layers = {};
    layers.baseLayers = {
      'Terrain': terrain,
      'Satellite': satellite,
      'Greyscale': greyscale,
      'Dark': dark
    };
    layers.overlays = {
      'Instruments': _instruments,
    };
    layers.defaults = [terrain, _instruments];

    return layers;
  };

  /**
   * Create Leaflet map instance
   */
  _initMap = function () {
    var bounds,
        layers,
        map;

    layers = _getMapLayers();

    // Create map
    map = L.map(_el, {
      layers: layers.defaults,
      scrollWheelZoom: false
    });

    // Set intial map extent to contain requested sites overlay
    bounds = _instruments.getBounds();
    map.fitBounds(bounds);

    // Add controllers
    L.control.scale().addTo(map);
    L.control.layers(layers.baseLayers, layers.overlays).addTo(map);
  };

  /**
   * Load instruments layer from geojson data via ajax
   */
  _loadInstrumentsLayer = function () {
    Xhr.ajax({
      url: MOUNT_PATH + '/_getInstruments.json.php',
      success: function (data) {
        _instruments = L.instrumentsLayer({
          data: data
        });
        _initMap();
      },
      error: function (status) {
        console.log(status);
      }
    });
  };

  _initialize(options);
  options = null;
  return _this;
};


module.exports = DataMap;
