<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithDrawings;

use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StockExport implements FromView, ShouldAutoSize, WithStyles, WithDrawings
{
    public $stocks;
    public $grandTotalAmount;
    public $grandTotalPurchasedAmount; // ← Add this
    public $month;

    public function __construct($stocks, $grandTotalAmount, $grandTotalPurchasedAmount, $month)
    {
        $this->stocks = $stocks;
        $this->grandTotalAmount = $grandTotalAmount;
        $this->grandTotalPurchasedAmount = $grandTotalPurchasedAmount;
        $this->month = $month;
    }

    public function view(): View
    {
        return view('exports.inventory_exports', [
            'stocksByCategory' => $this->stocks,
            'grandTotalAmount' => $this->grandTotalAmount,
            'grandTotalPurchasedAmount' => $this->grandTotalPurchasedAmount, // ← Pass it to view
            'month' => $this->month,
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            4 => ['font' => ['bold' => true]],
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
