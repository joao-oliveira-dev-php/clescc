<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * CodeIgniter PDF Library
 *
 * Generate PDF in CodeIgniter applications.
 *
 * @package			CodeIgniter
 * @subpackage		Libraries
 * @category		Libraries
 * @author			CodexWorld
 * @license			https://www.codexworld.com/license/
 * @link			https://www.codexworld.com
 */

// reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf{
	public function __construct(){
		
		// include autoloader
		require_once dirname(__FILE__).'/dompdf/autoload.inc.php';

		$options = new Options();
		$options->set('defaultFont', 'Courier');
		$options->set('isRemoteEnabled', TRUE);
		$options->set('debugKeepTemp', TRUE);
		$options->set('isHtml5ParserEnabled', true);
		//$options->set('chroot', '');
		//$dompdf = new Dompdf($options);
		
		// instantiate and use the dompdf class
		$pdf = new DOMPDF($options);
		
		$CI =& get_instance();
		$CI->dompdf = $pdf;
		
	}
}
?>