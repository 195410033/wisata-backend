<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function all(Request $request){
        $id = $request->input('id');
        $nama = $request->input('id');
        $show_objek = $request->input('show_objek');

        if($id){
            $kategori = Kategori::with(['objek'])->find($id);

            if($kategori){
                return ResponseFormatter::success(
                    $kategori,
                    'Data kategori berhasil diambil'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data kategori tidak ada',
                    404
                );
            }
        }

        $kategori = Kategori::query();

        if ($nama){
            $kategori->where('nama', 'like', '%' . $nama . '%');
        }

        if ($show_objek){
            $kategori->with('objek');
        }

        return ResponseFormatter::success(
            $kategori->paginate(),
            'Data kategori berhasil diambil'
        );
    }
}
