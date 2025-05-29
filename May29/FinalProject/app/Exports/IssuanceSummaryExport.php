<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class IssuanceSummaryExport implements FromView, ShouldAutoSize, WithStyles
{
    protected $summary;

    public function __construct($summary)
    {
        $this->summary = $summary;
    }

    public function view(): View
    {
        return view('exports.issuance_exports', [
            'summary' => $this->summary
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('PSU Logo');
        $drawing->setDescription('Pangasinan State University Logo');
        $drawing->setPath(public_path('assets/psu.png')); 
        $drawing->setHeight(70);
        $drawing->setWidth(70);
        $drawing->setCoordinates('C1'); 
        return $drawing;
    }
}
