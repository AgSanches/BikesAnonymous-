<?php


namespace App\Services;



use Barryvdh\DomPDF\Facade as PDF;

class ProccessPdf
{

    public function generatePdfReport($csvRowData) {
        $pdf = PDF::loadView('pdf.report', ['userData' => $csvRowData]);
        return $pdf->output();
    }

}
