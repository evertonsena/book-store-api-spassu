<?php

namespace App\Http\Controllers;

use App\Models\BookStore;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    function report()
    {
        $data = $this->getDataForReport();
        return view('report', compact('data'));
    }

    function report_download()
    {
        $data = $this->getDataForReport();
        $pdf = PDF::loadView('report', compact('data'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->download(sprintf('%s_%s.pdf', $data['data'], $data['title']));

    }

    private function getDataForReport()
    {
        return [
            'title' => 'Relatório do sistema de Livraria - Test Spassu',
            'data' => date('Y_m_d_-_H_i_s'),
            'bookStore' => BookStore::all(),
        ];
    }
}
