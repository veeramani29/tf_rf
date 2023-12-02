<?php

class PHPExcel_Writer_Excel5_BIFFwriter
{
	/**
	 * The byte order of this architecture. 0 => little endian, 1 => big endian
	 * @var integer
	 */
	private static $_byte_order;

	/**
	 * The string containing the data of the BIFF stream
	 * @var string
	 */
	public $_data;

	/**
	 * The size of the data in bytes. Should be the same as strlen($this->_data)
	 * @var integer
	 */
	public $_datasize;

	/**
	 * The maximum length for a BIFF record (excluding record header and length field). See _addContinue()
	 * @var integer
	 * @see _addContinue()
	 */
	public $_limit	= 8224;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->_data       = '';
		$this->_datasize   = 0;
//		$this->_limit      = 8224;
	}

	/**
	 * Determine the byte order and store it as class data to avoid
	 * recalculating it for each call to new().
	 *
	 * @return int
	 */
	public static function getByteOrder()
	{
		if (!isset(self::$_byte_order)) {
			// Check if "pack" gives the required IEEE 64bit float
			$teststr = pack("d", 1.2345);
			$number  = pack("C8", 0x8D, 0x97, 0x6E, 0x12, 0x83, 0xC0, 0xF3, 0x3F);
			if ($number == $teststr) {
				$byte_order = 0;    // Little Endian
			} elseif ($number == strrev($teststr)){
				$byte_order = 1;    // Big Endian
			} else {
				// Give up. I'll fix this in a later version.
				throw new PHPExcel_Writer_Exception("Required floating point format not supported on this platform.");
			}
			self::$_byte_order = $byte_order;
		}

		return self::$_byte_order;
	}

	/**
	 * General storage function
	 *
	 * @param string $data binary data to append
	 * @access private
	 */
	function _append($data)
	{
		if (strlen($data) - 4 > $this->_limit) {
			$data = $this->_addContinue($data);
		}
		$this->_data		.= $data;
		$this->_datasize	+= strlen($data);
	}

	/**
	 * General storage function like _append, but returns string instead of modifying $this->_data
	 *
	 * @param string $data binary data to write
	 * @return string
	 */
	public function writeData($data)
	{
		if (strlen($data) - 4 > $this->_limit) {
			$data = $this->_addContinue($data);
		}
		$this->_datasize += strlen($data);

		return $data;
	}

	/**
	 * Writes Excel BOF record to indicate the beginning of a stream or
	 * sub-stream in the BIFF file.
	 *
	 * @param  integer $type Type of BIFF file to write: 0x0005 Workbook,
	 *                       0x0010 Worksheet.
	 * @access private
	 */
	function _storeBof($type)
	{
		$record  = 0x0809;			// Record identifier	(BIFF5-BIFF8)
		$length  = 0x0010;

		// by inspection of real files, MS Office Excel 2007 writes the following
		$unknown = pack("VV", 0x000100D1, 0x00000406);

		$build   = 0x0DBB;			//	Excel 97
		$year    = 0x07CC;			//	Excel 97

		$version = 0x0600;			//	BIFF8

		$header  = pack("vv",   $record, $length);
		$data    = pack("vvvv", $version, $type, $build, $year);
		$this->_append($header . $data . $unknown);
	}

	/**
	 * Writes Excel EOF record to indicate the end of a BIFF stream.
	 *
	 * @access private
	 */
	function _storeEof()
	{
		$record    = 0x000A;   // Record identifier
		$length    = 0x0000;   // Number of bytes to follow

		$header    = pack("vv", $record, $length);
		$this->_append($header);
	}

	/**
	 * Writes Excel EOF record to indicate the end of a BIFF stream.
	 *
	 * @access private
	 */
	public function writeEof()
	{
		$record    = 0x000A;   // Record identifier
		$length    = 0x0000;   // Number of bytes to follow
		$header    = pack("vv", $record, $length);
		return $this->writeData($header);
	}

	/**
	 * Excel limits the size of BIFF records. In Excel 5 the limit is 2084 bytes. In
	 * Excel 97 the limit is 8228 bytes. Records that are longer than these limits
	 * must be split up into CONTINUE blocks.
	 *
	 * This function takes a long BIFF record and inserts CONTINUE records as
	 * necessary.
	 *
	 * @param  string  $data The original binary data to be written
	 * @return string        A very convenient string of continue blocks
	 * @access private
	 */
	function _addContinue($data)
	{
		$limit  = $this->_limit;
		$record = 0x003C;         // Record identifier

		// The first 2080/8224 bytes remain intact. However, we have to change
		// the length field of the record.
		$tmp = substr($data, 0, 2) . pack("v", $limit) . substr($data, 4, $limit);

		$header = pack("vv", $record, $limit);  // Headers for continue records

		// Retrieve chunks of 2080/8224 bytes +4 for the header.
		$data_length = strlen($data);
		for ($i = $limit + 4; $i < ($data_length - $limit); $i += $limit) {
			$tmp .= $header;
			$tmp .= substr($data, $i, $limit);
		}

		// Retrieve the last chunk of data
		$header  = pack("vv", $record, strlen($data) - $i);
		$tmp    .= $header;
		$tmp    .= substr($data, $i, strlen($data) - $i);

		return $tmp;
	}

}
