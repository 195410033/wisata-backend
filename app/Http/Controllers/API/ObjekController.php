<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Objek;
use Illuminate\Http\Request;

class ObjekController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $nama = $request->input('id');
        $deskripsi = $request->input('deskripsi');
        $ltd = $request->input('ltd');
        $lngtd = $request->input('lngtd');
        $kategori = $request->input('kategori');

        if($id){
            $objek = Objek::with(['category', 'images'])->find($id);

            if($objek){
                return ResponseFormatter::success(
                    $objek,
                    'Data objek berhasil diambil'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data objek tidak ada',
                    404
                );
            }
        }

        $objek = Objek::with(['category', 'images']);

        if ($nama){
            $objek->where('nama', 'like', '%' . $nama . '%');
        }

        if ($deskripsi){
            $objek->where('deskripsi', 'like', '%' . $deskripsi . '%');
        }

        if ($ltd){
            $objek->where('ltd', 'like', '%' . $ltd . '%');
        }

        if ($lngtd){
            $objek->where('lngtd', 'like', '%' . $lngtd . '%');
        }

        if ($kategori){
            $objek->where('kategori_id', $kategori);
        }

        return ResponseFormatter::success(
            $objek->paginate(),
            'Data objek berhasil diambil'
        );
    }
}
