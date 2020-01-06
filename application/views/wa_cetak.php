<?php

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF
{

  //Page header
  public function Header()
  {
    $this->ln(2);
    $this->SetFont('Helvetica', '', 9);
    $this->cell(22);
    $this->Cell(0, 5, 'RSUD Wonosari ', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    // $this->ln();
    // $this->SetFont('Helvetica', 'B', 11);
    // $this->cell(22);
    // $this->Cell(0, 5, 'LEONISA', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->ln();
    $this->SetFont('Helvetica', '', 8);
    $this->cell(22);
    $this->Cell(0, 5, 'Jl.Taman Bhakti No.06 Wonosari Gunungkidul', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->ln();
    $this->cell(22);
    // $this->Cell(0,0,'Website: Http://dinkes.gunungkidulkab.go.id , email:...@gmail.com ',0,true,'C',0,'',0,false,'M','M');
    $this->ln(1);
    $this->Cell(1);
    $this->Cell(0, 1, '', 'T', 0);
    $this->ln(0.8);
    $this->Cell(1);
    $this->Cell(0, 1, '', 'T', 0);
    $this->ln(0.2);
    $this->Cell(1);
    $this->Cell(0, 0, '', 'T', 0);
    $this->ln(1);
  }

  // Page footer
  public function Footer()
  {
    // Position at 15 mm from bottom
    $this->SetY(-15);
    // Set font
    $this->SetFont('helvetica', 'I', 8);
    // Page number
    $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
  }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('IT');
$pdf->SetTitle('Laporan Antrian WA ');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
  require_once(dirname(__FILE__) . '/lang/eng.php');
  $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 8);

// add a page
$pdf->AddPage();
$i = 0;
// set some text to print
$html = '<h3>Laporan antrian pasien WA pada  ' . $tgl . '</h3>
<table cellspacing="1" bgcolor="#666666" cellpadding="1" >
  <tr bgcolor="#cccccc" style="font-weight:bold">
    <th width="5%" align="center">No</th>
    <th width="10%" align="center">No RM</th>
    <th width="25%">Nama Pasien</th>
    <th width="35%">Alamat</th>
    <th width="17%">Poliklinik</th>
    <th width="8%" align="center">Antrian TPP</th>
  </tr>';
foreach ($wa as $row) {
  $i++;
  $html .= '<tr bgcolor="#ffffff">
    <td align="center">' . $i . '</td>
    <td>' . $row['no_rm'] . '</td>
    <td>' . $row['pasien_nm'] . '</td>
    <td>' . $row['alamat'] . '</td>
    <td>' . $row['medunit_nm'] . '</td>
    <td align="center">' . $row['no_antrian_tpp'] . '</td>
  </tr>
  ';
}
$html.='</table>';


// print a block of text using Write()
// $pdf->writeHTML(0, $html, '', 0, 'C', true, 0, false, false, 0);
$pdf->writeHTMLCell(0, 6, '', '', $html, 0, 1, 0, true, '', true);
// ---------------------------------------------------------
ob_end_clean();
//Close and output PDF document
$ket = date('m-Y');
$pdf->Output('cetak_wa' . $tgl, 'I');

//============================================================+
// END OF FILE
//============================================================+
