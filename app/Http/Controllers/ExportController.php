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
        }

        // Export ke file
        $writer = new Xlsx($spreadsheet);
        $fileName = 'payments_' . now()->format('Ymd_His') . '.xlsx';
        $filePath = storage_path($fileName);
        $writer->save($filePath);

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

        // Set header kolom Excel
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Reseller');
        $sheet->setCellValue('C1', 'Tanggal Pesanan');
        $sheet->setCellValue('D1', 'Produk');
        $sheet->setCellValue('E1', 'Jumlah');
        $sheet->setCellValue('F1', 'Harga Produk');
        $sheet->setCellValue('G1', 'Total Produk');
        $sheet->setCellValue('H1', 'Jumlah Tagihan');
        $sheet->setCellValue('I1', 'Jumlah Pembayaran');
        $sheet->setCellValue('J1', 'Status Tagihan');

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

        $sheet->getStyle('A1:J1')->applyFromArray($headerStyle);
        $sheet->getRowDimension(1)->setRowHeight(30);

        // Ambil data pembayaran
        $bills = Bill::with(['sale.saleItems.product', 'reseller.product'])->get();

        $row = 2;

        foreach ($bills as $index => $bill) {
            $resellerName = $bill->reseller->name ?? '-';
            $status = $bill->status == 'Belum Bayar' ? 'Belum Bayar' : 'Lunas';
            $terbayar = $bill->amount_paid;
            $tanggalPesanan = $bill->created_at->format('d M Y');

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
            $currentProductIndex = 0;

            foreach ($productRows as $product) {
                $currentProductIndex++;

                $sheet->setCellValue('A' . $row, $firstProduct ? $index + 1 : '');
                $sheet->setCellValue('B' . $row, $firstProduct ? $resellerName : '');
                $sheet->setCellValue('C' . $row, $firstProduct ? $tanggalPesanan : '');
                $sheet->setCellValue('D' . $row, $product['product']);
                $sheet->setCellValue('E' . $row, $product['qty']);
                $sheet->setCellValue('F' . $row, $product['price']);
                $sheet->setCellValue('G' . $row, $firstProduct ? $bill->total_quantity ?? 0 : '');
                $sheet->setCellValue('H' . $row, $firstProduct ? number_format($bill->total_amount, 2, ',', '.') : '');
                $sheet->setCellValue('I' . $row, $firstProduct ? number_format($terbayar, 2, ',', '.') : '');
                $sheet->setCellValue('J' . $row, $firstProduct ? $status : '');

                // Tengah untuk jumlah & total produk
                $sheet
                    ->getStyle('G' . $row)
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet
                    ->getStyle('E' . $row)
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Wrap & border setiap kolom
                foreach (range('A', 'J') as $col) {
                    $cell = $col . $row;

                    // Default: semua sisi diberi border
                    $borderStyle = [
                        'allBorders' => ['borderStyle' => Border::BORDER_THIN],
                    ];

                    // Khusus kolom D, E, F: jika bukan baris terakhir dari reseller, hilangkan border bottom
                    if ($currentProductIndex < $totalProducts && in_array($col, ['D', 'E', 'F'])) {
                        $borderStyle = [
                            'top' => ['borderStyle' => Border::BORDER_THIN],
                            'left' => ['borderStyle' => Border::BORDER_THIN],
                            'right' => ['borderStyle' => Border::BORDER_THIN],
                            // No bottom border
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

        // Auto size kolom
        foreach (range('A', 'J') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Export ke file
        $writer = new Xlsx($spreadsheet);
        $fileName = 'bills_' . now()->format('Ymd_His') . '.xlsx';
        $filePath = storage_path($fileName);
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
