<?php


/**  Require mPDF library */
$pdfRendererClassFile = PHPExcel_Settings::getPdfRendererPath() . '/mpdf.php';
if (file_exists($pdfRendererClassFile)) {
    require_once $pdfRendererClassFile;
} else {
    throw new PHPExcel_Writer_Exception('Unable to load PDF Rendering library');
}

class PHPExcel_Writer_PDF_mPDF extends PHPExcel_Writer_PDF_Core implements PHPExcel_Writer_IWriter
{
    /**
     *  Create a new PHPExcel_Writer_PDF
     *
     *  @param  PHPExcel  $phpExcel  PHPExcel object
     */
    public function __construct(PHPExcel $phpExcel)
    {
        parent::__construct($phpExcel);
    }

    /**
     *  Save PHPExcel to file
     *
     *  @param     string     $pFilename   Name of the file to save as
     *  @throws    PHPExcel_Writer_Exception
     */
    public function save($pFilename = NULL)
    {
        $fileHandle = parent::prepareForSave($pFilename);

        //  Default PDF paper size
        $paperSize = 'LETTER';    //    Letter    (8.5 in. by 11 in.)

        //  Check for paper size and page orientation
        if (is_null($this->getSheetIndex())) {
            $orientation = ($this->_phpExcel->getSheet(0)->getPageSetup()->getOrientation()
                == PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE)
                    ? 'L'
                    : 'P';
            $printPaperSize = $this->_phpExcel->getSheet(0)->getPageSetup()->getPaperSize();
            $printMargins = $this->_phpExcel->getSheet(0)->getPageMargins();
        } else {
            $orientation = ($this->_phpExcel->getSheet($this->getSheetIndex())->getPageSetup()->getOrientation()
                == PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE)
                    ? 'L'
                    : 'P';
            $printPaperSize = $this->_phpExcel->getSheet($this->getSheetIndex())->getPageSetup()->getPaperSize();
            $printMargins = $this->_phpExcel->getSheet($this->getSheetIndex())->getPageMargins();
        }
        $this->setOrientation($orientation);

        //  Override Page Orientation
        if (!is_null($this->getOrientation())) {
            $orientation = ($this->getOrientation() == PHPExcel_Worksheet_PageSetup::ORIENTATION_DEFAULT)
                ? PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT
                : $this->getOrientation();
        }
        $orientation = strtoupper($orientation);

        //  Override Paper Size
        if (!is_null($this->getPaperSize())) {
            $printPaperSize = $this->getPaperSize();
        }

        if (isset(self::$_paperSizes[$printPaperSize])) {
            $paperSize = self::$_paperSizes[$printPaperSize];
        }

        //  Create PDF
        $pdf = new mpdf();
        $ortmp = $orientation;
        $pdf->_setPageSize(strtoupper($paperSize), $ortmp);
        $pdf->DefOrientation = $orientation;
        $pdf->AddPage($orientation);

        //  Document info
        $pdf->SetTitle($this->_phpExcel->getProperties()->getTitle());
        $pdf->SetAuthor($this->_phpExcel->getProperties()->getCreator());
        $pdf->SetSubject($this->_phpExcel->getProperties()->getSubject());
        $pdf->SetKeywords($this->_phpExcel->getProperties()->getKeywords());
        $pdf->SetCreator($this->_phpExcel->getProperties()->getCreator());

        $pdf->WriteHTML(
            $this->generateHTMLHeader(FALSE) .
            $this->generateSheetData() .
            $this->generateHTMLFooter()
        );

        //  Write to file
        fwrite($fileHandle, $pdf->Output('', 'S'));

		parent::restoreStateAfterSave($fileHandle);
    }

}
