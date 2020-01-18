<?php
if(!defined('BASEPATH')) exit('NO DIRECT SCRIPT ACCESS ALLOWED');

require_once dirname(__FILE__) . '/html2pdf/src/Html2Pdf.php';

class PDF extends html2pdf{
    function __construct()
    {
        parent::__construct();
    }
}

?>