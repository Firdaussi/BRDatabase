<?php
  require('lib/html_table.php');
//  $sql = $_GET['sql'];

  if ($sql != "")
  {
    $pdf=new PDF_HTML_Table();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',5);
    $pdf->WriteHTML("Start of the HTML table.<br />$sql<br />End of the table.");
    $pdf->Output();
  }
?>
