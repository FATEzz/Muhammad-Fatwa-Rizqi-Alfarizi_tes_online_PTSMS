<?php
// app/Http/Controllers/Api/ReportController.php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function reportPembelian(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'kode_barang' => 'nullable|string',
        ]);

        $query = DB::table('tbl_pembelian_header as h')
            ->join('tbl_pembelian_detail as d', 'h.id', '=', 'd.header_id')
            ->join('tbl_barang as b', 'd.barang_id', '=', 'b.id')
            ->select(
                'h.kode_transaksi',
                'h.tanggal_pembelian',
                'b.kode_barang',
                'b.nama_barang',
                'd.qty',
                'd.harga_satuan',
                'd.subtotal'
            )
            ->whereBetween('h.tanggal_pembelian', [$request->start_date, $request->end_date]);


        if ($request->kode_barang) {
            $query->where('b.kode_barang', $request->kode_barang);
        }

        $report = $query->get();

        return response()->json($report);
    }
}
