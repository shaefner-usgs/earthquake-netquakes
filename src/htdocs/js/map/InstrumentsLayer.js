/* global L, MOUNT_PATH */
'use strict';


var Util = require('util/Util');


var _DEFAULTS,
    _OVERLAY_DEFAULTS;

_OVERLAY_DEFAULTS = {
  fillOpacity: 0.3,
  opacity: 0.7,
  radius: 8,
  weight: 1
};
_DEFAULTS = {
  data: {},
  overlayOptions: _OVERLAY_DEFAULTS
};

/**
 * Factory for Instruments overlay
 *
 * @param options {Object}
 *     {
 *       data: {String} Geojson data
 *     }
 *
 * @return {L.FeatureGroup}
 */
var InstrumentsLayer = function (options) {
  var _initialize,
      _this,

      _overlayOptions,

      _onEachFeature,
      _pointToLayer,
      _showCount;


  _this = {};

  _initialize = function (options) {
    options = Util.extend({}, _DEFAULTS, options);

    _overlayOptions = Util.extend({}, _OVERLAY_DEFAULTS, options.overlayOptions);

    _showCount(options.data.count);

    _this = L.geoJson(options.data, {
      onEachFeature: _onEachFeature,
      pointToLayer: _pointToLayer
    });
  };

  /**
   * Leaflet GeoJSON option: called on each created feature layer. Useful for
   * attaching events and popups to features.
   *
   * @param feature {Object}
   * @param layer (L.Layer)
   */
  _onEachFeature = function (feature, layer) {
    var data,
        img,
        imgLink,
        imgSrc,
        props,
        name,
        popup,
        popupTemplate,
        timestamp;

    props = feature.properties;
    name = props.site + '_' + props.net + '_' + props.loc;

    img = '<p class="nodata">No data available</p>'; // default
    timestamp = props.datetime.replace(/[-: ]/g, '');

    if (props.file) {
      imgLink = MOUNT_PATH + '/viewdata/' + name + '/' + timestamp;
      imgSrc = MOUNT_PATH + '/data/trigs/' + props.file;

      img = '<a href="' + imgLink + '"><img src="' + imgSrc + '" /></a>';
    }

    data = {
      description: props.description,
      img: img,
      link: MOUNT_PATH + '/viewdata/' + name,
      name: name
    };

    popupTemplate = '<div class="popup">' +
        '<h2>{name}</h2>' +
        '<p>{description}</p>' +
        '<h3>Latest Data</h3>' +
        '{img}' +
        '<h3>All data</h3>' +
        '<p><a href="{link}">View all seismograms</a></p>' +
      '</div>';
    popup = L.Util.template(popupTemplate, data);

    layer.bindPopup(popup, {
      autoPanPadding: L.point(50, 10)
    });
  };

  /**
   * Leaflet GeoJSON option: used for creating layers for GeoJSON points
   *
   * @param feature {Object}
   * @param latlng {L.LatLng}
   *
   * @return marker {L.CircleMarker}
   */
  _pointToLayer = function (feature, latlng) {
    var status;

    status = feature.properties.status;

    if (status === 'red') {
      _overlayOptions.color = '#c00';
      _overlayOptions.fillColor = '#c00';
    } else {
      _overlayOptions.color = '#03f';
      _overlayOptions.fillColor = '#03f';
    }

    return L.circleMarker(latlng, _overlayOptions);
  };

  /**
   * Show instrument count on web page
   *
   * @param count {Integer}
   */
  _showCount = function (count) {
    var el;

    el = document.querySelector('.count');
    el.innerHTML = count + ' instruments on this map';
  };

  _initialize(options);
  options = null;
  return _this;
};


L.instrumentsLayer = InstrumentsLayer;

module.exports = InstrumentsLayer;
