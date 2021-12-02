<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Product extends Controller
{
    var $tblName = 'products';
    var $jsonFileName = 'data.json';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->getData();

        return view('products.list', [
            'products' => $products
        ]);
    }

    /**
     * Get Products with Import JSON file.
     *
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    private function getData()
    {
        if (Storage::disk('public')->exists($this->jsonFileName)) {

            $this->dataImportToDB();

        }

        $products = \App\Model\Product::paginate(10);

        return $products;
    }

    /**
     * Import Products from JSON file.
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    private function dataImportToDB()
    {
        $dataJSON = Storage::disk('public')->get($this->jsonFileName);
        $dataArray = json_decode($dataJSON);
        $dataSet = array();

        foreach ($dataArray as $d) {

            $dataSet[] = array(
                'cod' => $d->cod,
                'desc' => $d->des
            );

        }

        DB::table($this->tblName)->truncate();
        DB::table($this->tblName)->insert($dataSet);

        Storage::disk('public')->delete($this->jsonFileName);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
