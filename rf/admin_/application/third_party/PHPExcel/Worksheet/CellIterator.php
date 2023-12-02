<?php
class PHPExcel_Worksheet_CellIterator implements Iterator
{
	/**
	 * PHPExcel_Worksheet to iterate
	 *
	 * @var PHPExcel_Worksheet
	 */
	private $_subject;

	/**
	 * Row index
	 *
	 * @var int
	 */
	private $_rowIndex;

	/**
	 * Current iterator position
	 *
	 * @var int
	 */
	private $_position = 0;

	/**
	 * Loop only existing cells
	 *
	 * @var boolean
	 */
	private $_onlyExistingCells = true;

	/**
	 * Create a new cell iterator
	 *
	 * @param PHPExcel_Worksheet 		$subject
	 * @param int						$rowIndex
	 */
	public function __construct(PHPExcel_Worksheet $subject = null, $rowIndex = 1) {
		// Set subject and row index
		$this->_subject 	= $subject;
		$this->_rowIndex 	= $rowIndex;
	}

	/**
	 * Destructor
	 */
	public function __destruct() {
		unset($this->_subject);
	}

	/**
	 * Rewind iterator
	 */
    public function rewind() {
        $this->_position = 0;
    }

    /**
     * Current PHPExcel_Cell
     *
     * @return PHPExcel_Cell
     */
    public function current() {
		return $this->_subject->getCellByColumnAndRow($this->_position, $this->_rowIndex);
    }

    /**
     * Current key
     *
     * @return int
     */
    public function key() {
        return $this->_position;
    }

    /**
     * Next value
     */
    public function next() {
        ++$this->_position;
    }

    /**
     * Are there any more PHPExcel_Cell instances available?
     *
     * @return boolean
     */
    public function valid() {
        // columnIndexFromString() returns an index based at one,
        // treat it as a count when comparing it to the base zero
        // position.
        $columnCount = PHPExcel_Cell::columnIndexFromString($this->_subject->getHighestColumn());

        if ($this->_onlyExistingCells) {
            // If we aren't looking at an existing cell, either
            // because the first column doesn't exist or next() has
            // been called onto a nonexistent cell, then loop until we
            // find one, or pass the last column.
            while ($this->_position < $columnCount &&
                   !$this->_subject->cellExistsByColumnAndRow($this->_position, $this->_rowIndex)) {
                ++$this->_position;
            }
        }

        return $this->_position < $columnCount;
    }

	/**
	 * Get loop only existing cells
	 *
	 * @return boolean
	 */
    public function getIterateOnlyExistingCells() {
    	return $this->_onlyExistingCells;
    }

	/**
	 * Set the iterator to loop only existing cells
	 *
	 * @param	boolean		$value
	 */
    public function setIterateOnlyExistingCells($value = true) {
    	$this->_onlyExistingCells = $value;
    }
}
