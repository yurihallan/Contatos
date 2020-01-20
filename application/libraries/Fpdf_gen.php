<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Fpdf_gen{

    public function __construct(){
        require_once APPPATH.'third_party/fpdf/fpdf.php';

        $pdf = new FPDF();
        $pdf->addPage();

        $CI =& get_instance();
        $CI->fpdf = $pdf;
    }

}