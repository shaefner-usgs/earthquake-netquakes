<?php

include_once '../lib/_functions.inc.php'; // app functions

/**
 * Database connector and queries for NetQuakes app
 *
 * @author Scott Haefner <shaefner@usgs.gov>
 */
class Db {
  private static $db;

  public function __construct() {
    try {
      $this->db = new PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASS']);
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      print '<p class="alert error">ERROR 1: ' . $e->getMessage() . '</p>';
    }
  }

  /**
   * Perform db query
   *
   * @param $sql {String}
   *     SQL query
   * @param $params {Array} default is NULL
   *     key-value substitution params for SQL query
   *
   * @return $stmt {Object} - PDOStatement object
   */
  private function _execQuery ($sql, $params=NULL) {
    try {
      $stmt = $this->db->prepare($sql);

      // bind sql params
      if (is_array($params)) {
        foreach ($params as $key => $value) {
          $type = $this->_getType($value);
          $stmt->bindValue($key, $value, $type);
        }
      }
      $stmt->execute();

      return $stmt;
    } catch(Exception $e) {
      print '<p class="alert error">ERROR 2: ' . $e->getMessage() . '</p>';
    }
  }

  /**
   * Get data type for a sql parameter (PDO::PARAM_* constant)
   *
   * @param $var {?}
   *     variable to identify type of
   *
   * @return $type {Integer}
   */
  private function _getType ($var) {
    $varType = gettype($var);
    $pdoTypes = array(
      'boolean' => PDO::PARAM_BOOL,
      'integer' => PDO::PARAM_INT,
      'NULL' => PDO::PARAM_NULL,
      'string' => PDO::PARAM_STR
    );

    $type = $pdoTypes['string']; // default
    if (isset($pdoTypes[$varType])) {
      $type = $pdoTypes[$varType];
    }

    return $type;
  }

  /**
   * Get event list
   *
   * @return {Function}
   */
  public function queryEvents () {
    $sql = 'SELECT * FROM `netq_trigs`
      WHERE evtid != "" AND delete_flag = 0
      GROUP BY `evtid`
      ORDER BY `evttime` DESC';

    return $this->_execQuery($sql);
  }

  /**
   * Get instrument list
   *
   * @return {Function}
   */
  public function queryInstruments () {
    $sql = 'SELECT * FROM netq_inst
      WHERE `type`="NQ"';

    return $this->_execQuery($sql);
  }

  /**
   * Get plot(s)
   * - all plots for a given event/instrument id; or
   * - specific plot for a given instrument & time
   * - all latest plots (one for each instrument);
   *
   * @param $id {String}
   *     optional parameter to get plots for a given event/instrument id
   * @param $datetime {Integer}
   *     optional parameter to get a specific plot for a given time
   *
   * @return {Function}
   */
  public function queryPlots ($id=NULL, $datetime=NULL) {
    $params = [];

    if ($id) {
      if (isInstrument($id)) {
        list(
          $params['site'], $params['net'], $params['loc']
        ) = explode('_', $id);

        if ($datetime) { // get specific plot matching instrument id and time
          $params['datetime'] = $datetime;
          $sql = 'SELECT * FROM netq_trigs trigs
            LEFT JOIN netq_inst inst ON trigs.site = inst.site
            WHERE trigs.loc = :loc AND trigs.net = :net AND trigs.site = :site
              AND trigs.datetime = :datetime';
        }
        else { // get all plots matching instrument id
          // Why does changing order of params break query??
          //$sql = 'SELECT trigs.datetime, trigs.type, trigs.unixtime, trigs.file, inst.description
          $sql = 'SELECT trigs.type, trigs.datetime, trigs.unixtime, trigs.file, inst.description
          FROM netq_trigs trigs
          LEFT JOIN netq_inst inst ON trigs.loc = inst.loc
            AND trigs.net = inst.net AND trigs.site = inst.site
          WHERE trigs.loc = :loc AND trigs.net = :net AND trigs.site = :site
            AND trigs.delete_flag = 0 AND trigs.type != "CAL"
          ORDER BY `datetime` DESC';
        }
      }
      else if (isEvent($id)) { // get all plots matching event id
        $params['evtid'] = substr($id, 2); // id and network are stored separately
        $sql = 'SELECT * FROM netq_trigs
          WHERE delete_flag = 0 AND evtid = :evtid AND `type` != "CAL"
          ORDER BY evtdst ASC';
      }
    }
    else { // get all latest plots
      $sql = 'SELECT `site`, `file`, MAX(`datetime`) AS `datetime`
      FROM netq_trigs
      WHERE `type` != "CAL" AND delete_flag = 0
      GROUP BY `site`';
    }

    return $this->_execQuery($sql, $params);
  }

  /**
   * Get requested points
   *
   * @return {Function}
   */
  public function queryRequestedPoints () {
    $sql = 'SELECT * FROM `netq_req_point`';

    return $this->_execQuery($sql);
  }

  /**
   * Get requested polygons
   *
   * @return {Function}
   */
  public function queryRequestedPolys () {
    $sql = 'SELECT * FROM `netq_req_polygon`';

    return $this->_execQuery($sql);
  }

}
