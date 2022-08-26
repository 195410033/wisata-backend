<?php

namespace App\Http\Controllers;

use App\Http\Requests\ObjekImagesRequest;
use App\Models\Images;
use App\Models\Objek;
use Yajra\DataTables\Facades\DataTables;

class ObjekImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Objek $objek)
    {        
        if (request()->ajax()) {
            $query = Images::where('objek_id', $objek->id);

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <form class="inline-block" action="' . route('dashboard.images.destroy', $item->id) . '" method="POST">
                        <button class="border border-red-500 bg-red-500 text-white rounded-md px-2 py-1 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                            Hapus
                        </button>
                            ' . method_field('delete') . csrf_field() . '
                        </form>';
                })
                ->editColumn('images', function ($item) {
                    return '<img style="max-width: 150px;" src="'. $item->images .'"/>';
                })
                
                ->rawColumns(['action', 'images'])
                ->make();
        }

        return view('pages.dashboard.images.index', compact('objek'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Objek $objek)
    {
        return view('pages.dashboard.images.create', compact('objek'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ObjekImagesRequest $request, Objek $objek)
    {
        $files = $request->file('files');

        if($request->hasFile('files'))
        {
            foreach ($files as $file) {
                // $name = $file->getClientOriginalName();
                $path = $file->store('images','public');
                
                Images::create([
                    'objek_id' => $objek->id,
                    'images' => $path
                ]);
            }
        }

        return redirect()->route('dashboard.objek.images.index', $objek->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ObjekImages  $objekImages
     * @return \Illuminate\Http\Response
     */
    public function show(Images $objekImages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ObjekImages  $objekImages
     * @return \Illuminate\Http\Response
     */
    public function edit(Images $objekImages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ObjekImages  $objekImages
     * @return \Illuminate\Http\Response
     */
    public function update(ObjekImagesRequest $request, Images $objekImages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ObjekImages  $objekImages
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $images = Images::find($id);

        $images->delete();

        return redirect()->route('dashboard.objek.images.index', $images->objek_id);
    }
}
