<?php

class PHPExcel_Writer_Excel5_Font
{
	/**
	 * Color index
	 *
	 * @var int
	 */
	private $_colorIndex;

	/**
	 * Font
	 *
	 * @var PHPExcel_Style_Font
	 */
	private $_font;

	/**
	 * Constructor
	 *
	 * @param PHPExcel_Style_Font $font
	 */
	public function __construct(PHPExcel_Style_Font $font = null)
	{
		$this->_colorIndex = 0x7FFF;
		$this->_font = $font;
	}

	/**
	 * Set the color index
	 *
	 * @param int $colorIndex
	 */
	public function setColorIndex($colorIndex)
	{
		$this->_colorIndex = $colorIndex;
	}

	/**
	 * Get font record data
	 *
	 * @return string
	 */
	public function writeFont()
	{
		$font_outline = 0;
		$font_shadow = 0;

		$icv = $this->_colorIndex; // Index to color palette
		if ($this->_font->getSuperScript()) {
			$sss = 1;
		} else if ($this->_font->getSubScript()) {
			$sss = 2;
		} else {
			$sss = 0;
		}
		$bFamily = 0; // Font family
		$bCharSet = PHPExcel_Shared_Font::getCharsetFromFontName($this->_font->getName()); // Character set

		$record = 0x31;		// Record identifier
		$reserved = 0x00;	// Reserved
		$grbit = 0x00;		// Font attributes
		if ($this->_font->getItalic()) {
			$grbit |= 0x02;
		}
		if ($this->_font->getStrikethrough()) {
			$grbit |= 0x08;
		}
		if ($font_outline) {
			$grbit |= 0x10;
		}
		if ($font_shadow) {
			$grbit |= 0x20;
		}

		$data = pack("vvvvvCCCC",
			$this->_font->getSize() * 20,						//	Fontsize (in twips)
			$grbit,
			$icv,												//	Colour
			self::_mapBold($this->_font->getBold()),			//	Font weight
			$sss,												//	Superscript/Subscript
			self::_mapUnderline($this->_font->getUnderline()),
			$bFamily,
			$bCharSet,
			$reserved
		);
		$data .= PHPExcel_Shared_String::UTF8toBIFF8UnicodeShort($this->_font->getName());

		$length = strlen($data);
		$header = pack("vv", $record, $length);

		return($header . $data);
	}

	/**
	 * Map to BIFF5-BIFF8 codes for bold
	 *
	 * @param boolean $bold
	 * @return int
	 */
	private static function _mapBold($bold) {
		if ($bold) {
			return 0x2BC;	//	700 = Bold font weight
		}
		return 0x190;		//	400 = Normal font weight
	}

	/**
	 * Map of BIFF2-BIFF8 codes for underline styles
	 * @static	array of int
	 *
	 */
	private static $_mapUnderline = array(	PHPExcel_Style_Font::UNDERLINE_NONE					=> 0x00,
											PHPExcel_Style_Font::UNDERLINE_SINGLE				=> 0x01,
											PHPExcel_Style_Font::UNDERLINE_DOUBLE				=> 0x02,
											PHPExcel_Style_Font::UNDERLINE_SINGLEACCOUNTING		=> 0x21,
											PHPExcel_Style_Font::UNDERLINE_DOUBLEACCOUNTING		=> 0x22,
										 );
	/**
	 * Map underline
	 *
	 * @param string
	 * @return int
	 */
	private static function _mapUnderline($underline) {
		if (isset(self::$_mapUnderline[$underline]))
			return self::$_mapUnderline[$underline];
		return 0x00;
	}

}
