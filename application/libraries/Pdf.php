<?php
use Dompdf\Dompdf;

require_once APPPATH . 'third_party/dompdf/autoload.inc.php';

class Pdf extends Dompdf {
    public function __construct() {
        parent::__construct();
    }
}
