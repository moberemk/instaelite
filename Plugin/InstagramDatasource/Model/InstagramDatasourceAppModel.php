<?php

/**
 * App model for the InstagramDatasource plugin.
 *
 * @package InstagramDatasource
 * @author Michael Enger <mien@nodesagency.no>
 */
class InstagramDatasourceAppModel extends AppModel {

/**
 * _lastPagination
 *
 * Store the pagination information from the last query
 *
 * @var array
 */
	protected $_lastPagination = array();

	public function getPagination() {
		return $this->_lastPagination;
	}

	public function setPagination($data) {
		$this->_lastPagination = $data;
	}
}
