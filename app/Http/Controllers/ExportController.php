<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Payment;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
class ExportController extends Controller
{
    public function exportPayments()
  {
    $spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set header kolom Excel
$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'Reseller');
$sheet->setCellValue('C1', 'Tanggal Pembayaran');
$sheet->setCellValue('D1', 'Produk');
$sheet->setCellValue('E1', 'Jumlah');
$sheet->setCellValue('F1', 'Harga Produk');
$sheet->setCellValue('G1', 'Jumlah Pembayaran');

// Styling untuk header (baris 1)
$headerStyle = [
    'font' => ['bold' => true],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => 'D9E1F2'],
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
        'wrapText' => true,
    ],
    'borders' => [
        'allBorders' => ['borderStyle' => Border::BORDER_THIN],
    ],
];

$sheet->getStyle('A1:G1')->applyFromArray($headerStyle);
$sheet->getRowDimension(1)->setRowHeight(25);

// Ambil data pembayaran
$payments = Payment::with(['bill.reseller', 'bill.sale.saleItems.product'])->get();

$row = 2; // Mulai dari baris ke-2 setelah header
foreach ($payments as $index => $payment) {
    $resellerName = $payment->bill->reseller->name ?? '-';
    $paymentAmount = number_format($payment->amount, 2, ',', '.');
    $tanggal = \Carbon\Carbon::parse($payment->paid_at)->format('d-m-Y');

    $productRows = [];
    foreach ($payment->bill->sale as $sale) {
        foreach ($sale->saleItems as $item) {
            $productRows[] = [
                'product' => $item->product->name ?? '-',
                'qty' => $item->quantity,
                'price' => number_format($item->product->price, 2, ',', '.'),
            ];
        }
    }

    $firstProduct = true;
    foreach ($productRows as $product) {
        $sheet->setCellValue('A' . $row, $firstProduct ? $index + 1 : '');
        $sheet->setCellValue('B' . $row, $firstProduct ? $resellerName : '');
        $sheet->setCellValue('C' . $row, $firstProduct ? $tanggal : '');
        $sheet->setCellValue('D' . $row, $product['product']);
        $sheet->setCellValue('E' . $row, $product['qty']);
        $sheet->setCellValue('F' . $row, $product['price']);
        $sheet->setCellValue('G' . $row, $firstProduct ? $paymentAmount : '');

        // Center-align jumlah dan harga
        foreach (['E', 'F', 'G'] as $col) {
            $sheet->getStyle($col . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }

        // Tambahkan border dan wrapText ke semua cell di baris ini
        foreach (range('A', 'G') as $col) {
            $sheet->getStyle($col . $row)->applyFromArray([
                'alignment' => [
                    'wrapText' => true,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => ['borderStyle' => Border::BORDER_THIN],
                ],
            ]);
        }

        $row++;
        $firstProduct = false;
    }
}

// Auto-size kolom
foreach (range('A', 'G') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Export ke file Excel
$writer = new Xlsx($spreadsheet);
$fileName = 'payments_' . now()->format('Ymd_His') . '.xlsx';
$filePath = storage_path($fileName);
$writer->save($filePath);

// Unduh dan hapus file setelah dikirim
return response()->download($filePath)->deleteFileAfterSend(true);
  }
    public function exportOrders()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header kolom Excel
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Reseller');
        $sheet->setCellValue('C1', 'Tanggal Pembayaran');
        $sheet->setCellValue('D1', 'Produk');
        $sheet->setCellValue('E1', 'Jumlah');
        $sheet->setCellValue('F1', 'Harga Produk');
        $sheet->setCellValue('G1', 'Jumlah Pembayaran');

        // Style Header (Baris 1)
        $headerStyle = [
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'D9E1F2'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN],
            ],
        ];

        $sheet->getStyle('A1:G1')->applyFromArray($headerStyle);
        $sheet->getRowDimension(1)->setRowHeight(30);

        // Ambil data pembayaran beserta relasi reseller (lewat bill)
        $payments = Payment::with(['bill.reseller'])->get();

        // Masukkan data pembayaran ke dalam Excel
        $row = 2 + $payments->count();
        foreach ($payments as $index => $payment) {
            $resellerName = $payment->bill->reseller->name ?? '-';
            foreach ($payment->bill->sale as $sale) {
                foreach ($sale->saleItems as $item) {
                    $productName = $item->product->name;
                    $quantity = $item->quantity;
                    $productPrice = $item->product->price;
                }
            }

            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $resellerName);
            $sheet->setCellValue('C' . $row, \Carbon\Carbon::parse($payment->paid_at)->format('d-m-Y'));
            $sheet->setCellValue('D' . $row, $productName ?? '-');
            $sheet->setCellValue('E' . $row, $quantity ?? '-');
            $sheet->setCellValue('F' . $row, number_format($productPrice, 0, ',', '.'));
            $sheet->setCellValue('G' . $row, number_format($payment->amount, 2, ',', '.'));
            $row++;

            // Set border dan wrapText untuk semua data
            $dataRange = 'A2:J' . ($row - 1);

            $sheet->getStyle($dataRange)->applyFromArray([
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_TOP,
                    'wrapText' => true,
                ],
                'borders' => [
                    'allBorders' => ['borderStyle' => Border::BORDER_THIN],
                ],
            ]);
        }

        // Export ke file
        $writer = new Xlsx($spreadsheet);
        $fileName = 'payments_' . now()->format('Ymd_His') . '.xlsx';
        $filePath = storage_path($fileName);
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function exportBills()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header kolom
        $headers = [
            'A1' => 'No',
            'B1' => 'Reseller',
            'C1' => 'Tanggal Pesanan',
            'D1' => 'Produk',
            'E1' => 'Jumlah',
            'F1' => 'Harga Produk',
            'G1' => 'Total Produk',
            'H1' => 'Jumlah Tagihan',
            'I1' => 'Jumlah Pembayaran',
            'J1' => 'Status Tagihan',
        ];
        foreach ($headers as $cell => $text) {
            $sheet->setCellValue($cell, $text);
        }

        // Style Header
        $sheet->getStyle('A1:J1')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'D9E1F2'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN],
            ],
        ]);
        $sheet->getRowDimension(1)->setRowHeight(30);

        // Ambil data Bill yang tidak soft-deleted
        $bills = Bill::with(['sale.saleItems.product', 'reseller.product'])
            ->whereNotIn('status', ['Dihapus'])
            ->whereNull('deleted_at')
            ->get();

        $row = 2; // mulai dari baris ke-2 setelah header

        foreach ($bills as $index => $bill) {
            $resellerName = $bill->reseller->name ?? '-';
            $status = $bill->status === 'Belum Bayar' ? 'Belum Bayar' : 'Lunas';
            $terbayar = $bill->amount_paid;
            $tanggalPesanan = $bill->created_at->format('d M Y');

            // Ambil produk dari setiap penjualan
            $productRows = [];
            foreach ($bill->sale as $sale) {
                foreach ($sale->saleItems as $item) {
                    $productRows[] = [
                        'product' => $item->product->name ?? '-',
                        'qty' => $item->quantity,
                        'price' => number_format($item->product->price, 2, ',', '.'),
                    ];
                }
            }

            $firstProduct = true;
            $totalProducts = count($productRows);
            $productIndex = 0;

            foreach ($productRows as $product) {
                $productIndex++;

                $sheet->setCellValue('A' . $row, $firstProduct ? $index + 1 : '');
                $sheet->setCellValue('B' . $row, $firstProduct ? $resellerName : '');
                $sheet->setCellValue('C' . $row, $firstProduct ? $tanggalPesanan : '');
                $sheet->setCellValue('D' . $row, $product['product']);
                $sheet->setCellValue('E' . $row, $product['qty']);
                $sheet->setCellValue('F' . $row, $product['price']);
                $sheet->setCellValue('G' . $row, $firstProduct ? $bill->total_quantity : '');
                $sheet->setCellValue('H' . $row, $firstProduct ? number_format($bill->total_amount, 2, ',', '.') : '');
                $sheet->setCellValue('I' . $row, $firstProduct ? number_format($terbayar, 2, ',', '.') : '');
                $sheet->setCellValue('J' . $row, $firstProduct ? $status : '');

                // Center untuk jumlah & total produk
                $sheet
                    ->getStyle('E' . $row)
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet
                    ->getStyle('G' . $row)
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Border & wrap
                foreach (range('A', 'J') as $col) {
                    $cell = $col . $row;

                    $borderStyle = [
                        'allBorders' => ['borderStyle' => Border::BORDER_THIN],
                    ];

                    // Jika bukan baris terakhir dari produk reseller dan kolom tertentu, hilangkan border bawah
                    if ($productIndex < $totalProducts && in_array($col, ['D', 'E', 'F'])) {
                        $borderStyle = [
                            'top' => ['borderStyle' => Border::BORDER_THIN],
                            'left' => ['borderStyle' => Border::BORDER_THIN],
                            'right' => ['borderStyle' => Border::BORDER_THIN],
                            // bottom ditiadakan
                        ];
                    }

                    $sheet->getStyle($cell)->applyFromArray([
                        'alignment' => ['wrapText' => true, 'vertical' => Alignment::VERTICAL_CENTER],
                        'borders' => $borderStyle,
                    ]);
                }

                $row++;
                $firstProduct = false;
            }
        }

        // Auto-size semua kolom
        foreach (range('A', 'J') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Simpan dan download
        $writer = new Xlsx($spreadsheet);
        $fileName = 'bills_' . now()->format('Ymd_His') . '.xlsx';
        $filePath = storage_path($fileName);
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
