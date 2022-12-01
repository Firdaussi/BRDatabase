<?php
  $pdf=new PDF_HTML_Table();
  $pdf->AddPage();
  $pdf->SetFont('Arial','',10);
  $pdf->WriteHTML("Start of the HTML table.<br />$html_str<br />End of the table.");
  $pdf->Output("x", "S");
?>