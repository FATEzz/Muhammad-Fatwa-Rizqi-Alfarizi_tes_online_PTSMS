<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PembelianHeader;
use App\Models\Barang;
use App\Http\Controllers\Controller;

class PembelianController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_pembelian' => 'required|date',
            'details' => 'required|array|min:1',
            'details.*.barang_id' => 'required|exists:tbl_barang,id',
            'details.*.qty' => 'required|integer|min:1',
        ]);

        $totalHarga = 0;
        DB::beginTransaction();

        try {

            foreach ($request->details as $detail) {
                $barang = Barang::findOrFail($detail['barang_id']);
                
                $subtotal = $barang->harga * $detail['qty'];
                $totalHarga += $subtotal;
            }

            // 2. Insert Header
            $header = PembelianHeader::create([
                'kode_transaksi' => 'TRX-' . time(),
                'tanggal_pembelian' => $request->tanggal_pembelian,
                'user_id' => $request->user()->id,
                'total_harga' => $totalHarga,
            ]);

            foreach ($request->details as $detail) {
                $barang = Barang::findOrFail($detail['barang_id']);
                $subtotal = $barang->harga * $detail['qty'];

                $header->details()->create([
                    'barang_id' => $detail['barang_id'],
                    'qty' => $detail['qty'],
                    'harga_satuan' => $barang->harga,
                    'subtotal' => $subtotal,
                ]);
                
                $barang->stok += $detail['qty'];
                $barang->save();
            }

            // Jika semua berhasil, commit
            DB::commit();

            return response()->json([
                'message' => 'Pembelian berhasil diinsert.', 
                'data' => $header
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Gagal melakukan transaksi pembelian.', 
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
