<?php

require_once(PHPEXCEL_ROOT . 'PHPExcel/Shared/trend/bestFitClass.php');

class PHPExcel_Linear_Best_Fit extends PHPExcel_Best_Fit
{
	/**
	 * Algorithm type to use for best-fit
	 * (Name of this trend class)
	 *
	 * @var	string
	 **/
	protected $_bestFitType		= 'linear';


	/**
	 * Return the Y-Value for a specified value of X
	 *
	 * @param	 float		$xValue			X-Value
	 * @return	 float						Y-Value
	 **/
	public function getValueOfYForX($xValue) {
		return $this->getIntersect() + $this->getSlope() * $xValue;
	}	//	function getValueOfYForX()


	/**
	 * Return the X-Value for a specified value of Y
	 *
	 * @param	 float		$yValue			Y-Value
	 * @return	 float						X-Value
	 **/
	public function getValueOfXForY($yValue) {
		return ($yValue - $this->getIntersect()) / $this->getSlope();
	}	//	function getValueOfXForY()


	/**
	 * Return the Equation of the best-fit line
	 *
	 * @param	 int		$dp		Number of places of decimal precision to display
	 * @return	 string
	 **/
	public function getEquation($dp=0) {
		$slope = $this->getSlope($dp);
		$intersect = $this->getIntersect($dp);

		return 'Y = '.$intersect.' + '.$slope.' * X';
	}	//	function getEquation()


	/**
	 * Execute the regression and calculate the goodness of fit for a set of X and Y data values
	 *
	 * @param	 float[]	$yValues	The set of Y-values for this regression
	 * @param	 float[]	$xValues	The set of X-values for this regression
	 * @param	 boolean	$const
	 */
	private function _linear_regression($yValues, $xValues, $const) {
		$this->_leastSquareFit($yValues, $xValues,$const);
	}	//	function _linear_regression()


	/**
	 * Define the regression and calculate the goodness of fit for a set of X and Y data values
	 *
	 * @param	float[]		$yValues	The set of Y-values for this regression
	 * @param	float[]		$xValues	The set of X-values for this regression
	 * @param	boolean		$const
	 */
	function __construct($yValues, $xValues=array(), $const=True) {
		if (parent::__construct($yValues, $xValues) !== False) {
			$this->_linear_regression($yValues, $xValues, $const);
		}
	}	//	function __construct()

}	//	class linearBestFit