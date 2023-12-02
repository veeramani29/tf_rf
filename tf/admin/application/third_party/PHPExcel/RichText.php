<?php
class PHPExcel_RichText implements PHPExcel_IComparable
{
    /**
     * Rich text elements
     *
     * @var PHPExcel_RichText_ITextElement[]
     */
    private $_richTextElements;

    /**
     * Create a new PHPExcel_RichText instance
     *
     * @param PHPExcel_Cell $pCell
     * @throws PHPExcel_Exception
     */
    public function __construct(PHPExcel_Cell $pCell = null)
    {
        // Initialise variables
        $this->_richTextElements = array();

        // Rich-Text string attached to cell?
        if ($pCell !== NULL) {
            // Add cell text and style
            if ($pCell->getValue() != "") {
                $objRun = new PHPExcel_RichText_Run($pCell->getValue());
                $objRun->setFont(clone $pCell->getParent()->getStyle($pCell->getCoordinate())->getFont());
                $this->addText($objRun);
            }

            // Set parent value
            $pCell->setValueExplicit($this, PHPExcel_Cell_DataType::TYPE_STRING);
        }
    }

    /**
     * Add text
     *
     * @param PHPExcel_RichText_ITextElement $pText Rich text element
     * @throws PHPExcel_Exception
     * @return PHPExcel_RichText
     */
    public function addText(PHPExcel_RichText_ITextElement $pText = null)
    {
        $this->_richTextElements[] = $pText;
        return $this;
    }

    /**
     * Create text
     *
     * @param string $pText Text
     * @return PHPExcel_RichText_TextElement
     * @throws PHPExcel_Exception
     */
    public function createText($pText = '')
    {
        $objText = new PHPExcel_RichText_TextElement($pText);
        $this->addText($objText);
        return $objText;
    }

    /**
     * Create text run
     *
     * @param string $pText Text
     * @return PHPExcel_RichText_Run
     * @throws PHPExcel_Exception
     */
    public function createTextRun($pText = '')
    {
        $objText = new PHPExcel_RichText_Run($pText);
        $this->addText($objText);
        return $objText;
    }

    /**
     * Get plain text
     *
     * @return string
     */
    public function getPlainText()
    {
        // Return value
        $returnValue = '';

        // Loop through all PHPExcel_RichText_ITextElement
        foreach ($this->_richTextElements as $text) {
            $returnValue .= $text->getText();
        }

        // Return
        return $returnValue;
    }

    /**
     * Convert to string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getPlainText();
    }

    /**
     * Get Rich Text elements
     *
     * @return PHPExcel_RichText_ITextElement[]
     */
    public function getRichTextElements()
    {
        return $this->_richTextElements;
    }

    /**
     * Set Rich Text elements
     *
     * @param PHPExcel_RichText_ITextElement[] $pElements Array of elements
     * @throws PHPExcel_Exception
     * @return PHPExcel_RichText
     */
    public function setRichTextElements($pElements = null)
    {
        if (is_array($pElements)) {
            $this->_richTextElements = $pElements;
        } else {
            throw new PHPExcel_Exception("Invalid PHPExcel_RichText_ITextElement[] array passed.");
        }
        return $this;
    }

    /**
     * Get hash code
     *
     * @return string    Hash code
     */
    public function getHashCode()
    {
        $hashElements = '';
        foreach ($this->_richTextElements as $element) {
            $hashElements .= $element->getHashCode();
        }

        return md5(
              $hashElements
            . __CLASS__
        );
    }

    /**
     * Implement PHP __clone to create a deep clone, not just a shallow copy.
     */
    public function __clone()
    {
        $vars = get_object_vars($this);
        foreach ($vars as $key => $value) {
            if (is_object($value)) {
                $this->$key = clone $value;
            } else {
                $this->$key = $value;
            }
        }
    }
}
