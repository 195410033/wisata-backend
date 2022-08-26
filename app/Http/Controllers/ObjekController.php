<?php

namespace App\Http\Controllers;

use App\Http\Requests\ObjekRequest;
use App\Models\Kategori;
use App\Models\Objek;
use Yajra\DataTables\Facades\DataTables;

class ObjekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Objek::with('category');

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <a class="inline-block border border-green-500 bg-green-500 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline" 
                            href="' . route('dashboard.objek.images.index', $item->id) . '">
                            Image
                        </a>
                        <a class="inline-block border border-gray-700 bg-gray-700 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-gray-800 focus:outline-none focus:shadow-outline" 
                            href="' . route('dashboard.objek.edit', $item->id) . '">
                            Edit
                        </a>
                        <form class="inline-block" action="' . route('dashboard.objek.destroy', $item->id) . '" method="POST">
                        <button class="border border-red-500 bg-red-500 text-white rounded-md px-2 py-1 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                            Hapus
                        </button>
                            ' . method_field('delete') . csrf_field() . '
                        </form>';
                })
                
                ->rawColumns(['action'])
                ->make();
        }
        return view('pages.dashboard.objek.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('pages.dashboard.objek.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ObjekRequest $request)
    {
        $data = $request->all();

        Objek::create($data);

        return redirect()->route('dashboard.objek.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Objek  $objek
     * @return \Illuminate\Http\Response
     */
    public function show(Objek $objek)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Objek  $objek
     * @return \Illuminate\Http\Response
     */
    public function edit(Objek $objek)
    {
        $kategori = Kategori::all();
        return view('pages.dashboard.objek.edit',[
            'item' => $objek,
            'kategori' => $kategori
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Objek  $objek
     * @return \Illuminate\Http\Response
     */
    public function update(ObjekRequest $request, Objek $objek)
    {
        $data = $request->all();

        $objek->update($data);

        return redirect()->route('dashboard.objek.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Objek  $objek
     * @return \Illuminate\Http\Response
     */
    public function destroy(Objek $objek)
    {
        $objek->delete();

        return redirect()->route('dashboard.objek.index');
    }
}
