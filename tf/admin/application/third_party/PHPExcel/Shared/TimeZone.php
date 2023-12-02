<?php

class PHPExcel_Shared_TimeZone
{
	/*
	 * Default Timezone used for date/time conversions
	 *
	 * @private
	 * @var	string
	 */
	protected static $_timezone	= 'UTC';

	/**
	 * Validate a Timezone name
	 *
	 * @param	 string		$timezone			Time zone (e.g. 'Europe/London')
	 * @return	 boolean						Success or failure
	 */
	public static function _validateTimeZone($timezone) {
		if (in_array($timezone, DateTimeZone::listIdentifiers())) {
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Set the Default Timezone used for date/time conversions
	 *
	 * @param	 string		$timezone			Time zone (e.g. 'Europe/London')
	 * @return	 boolean						Success or failure
	 */
	public static function setTimeZone($timezone) {
		if (self::_validateTimezone($timezone)) {
			self::$_timezone = $timezone;
			return TRUE;
		}
		return FALSE;
	}	//	function setTimezone()


	/**
	 * Return the Default Timezone used for date/time conversions
	 *
	 * @return	 string		Timezone (e.g. 'Europe/London')
	 */
	public static function getTimeZone() {
		return self::$_timezone;
	}	//	function getTimezone()


	/**
	 *	Return the Timezone transition for the specified timezone and timestamp
	 *
	 *	@param		DateTimeZone	 	$objTimezone	The timezone for finding the transitions
	 *	@param		integer	 			$timestamp		PHP date/time value for finding the current transition
	 *	@return	 	array				The current transition details
	 */
	private static function _getTimezoneTransitions($objTimezone, $timestamp) {
		$allTransitions = $objTimezone->getTransitions();
		$transitions = array();
		foreach($allTransitions as $key => $transition) {
			if ($transition['ts'] > $timestamp) {
				$transitions[] = ($key > 0) ? $allTransitions[$key - 1] : $transition;
				break;
			}
			if (empty($transitions)) {
				$transitions[] = end($allTransitions);
			}
		}

		return $transitions;
	}

	/**
	 *	Return the Timezone offset used for date/time conversions to/from UST
	 *	This requires both the timezone and the calculated date/time to allow for local DST
	 *
	 *	@param		string	 			$timezone		The timezone for finding the adjustment to UST
	 *	@param		integer	 			$timestamp		PHP date/time value
	 *	@return	 	integer				Number of seconds for timezone adjustment
	 *	@throws		PHPExcel_Exception
	 */
	public static function getTimeZoneAdjustment($timezone, $timestamp) {
		if ($timezone !== NULL) {
			if (!self::_validateTimezone($timezone)) {
				throw new PHPExcel_Exception("Invalid timezone " . $timezone);
			}
		} else {
			$timezone = self::$_timezone;
		}

		if ($timezone == 'UST') {
			return 0;
		}

		$objTimezone = new DateTimeZone($timezone);
		if (version_compare(PHP_VERSION, '5.3.0') >= 0) {
			$transitions = $objTimezone->getTransitions($timestamp,$timestamp);
		} else {
			$transitions = self::_getTimezoneTransitions($objTimezone, $timestamp);
		}

		return (count($transitions) > 0) ? $transitions[0]['offset'] : 0;
	}

}
