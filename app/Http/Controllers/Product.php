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
    public function index(Request $request)
    {
        $products = $this->getData($request);

        return view('products.list', [
            'products' => $products,
            's' => $request->input('s')
        ]);
    }

    /**
     * Get Products with Import JSON file.
     *
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    private function getData(Request $request)
    {
        if (Storage::disk('public')->exists($this->jsonFileName)) {

            $this->dataImportToDB();

        }

        $products = \App\Model\Product::where('cod', 'LIKE', '%' . $request->input('s') . '%')
            ->orWhere('name', 'LIKE', '%' . $request->input('s') . '%')
            ->orderBy('id', 'DESC')
            ->paginate(10);

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

            $product = \App\Model\Product::where('cod', $d->cod)->first();

            if (!isset($product->id)) {

                $product = new \App\Model\Product();

            }

            $product->cod = $d->cod;
            $product->name = $d->des;
            $product->desc = $d->des;

            $product->save();

        }

        /*DB::table($this->tblName)->truncate();
        DB::table($this->tblName)->insert($dataSet);*/

        Storage::disk('public')->delete($this->jsonFileName);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $json = (object) array(
            'conn_element_name' => array(''),
            'conn_element_search_code' => array(''),
        );

        return view('products.form', [
            'json' => $json
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // JSON Multi Connect
        $json_request = $request->input('json');

        if (count($json_request['conn_element_name']) < 2 && $json_request['conn_element_name'][0] == '') {

            $json = null;

        } else {

            $json = json_encode($json_request);
        }

        \App\Model\Product::create([
            'cod' => $request->input('cod'),
            'name' => $request->input('name'),
            'desc' => $request->input('desc'),
            'price' => str_replace(',', '.', $request->input('price')),
            /*'conn_element_name' => $request->input('conn_element_name'),
            'conn_element_search_code' => $request->input('conn_element_search_code'),*/
            'json' => $json,
        ]);

        return redirect()->route('products');
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
        $product = \App\Model\Product::find($id);

        if (!isset($product->json)) {

            $json = (object) array(
                'conn_element_name' => array(''),
                'conn_element_search_code' => array(''),
            );

        } else {

            $json = json_decode($product->json);
        }

        return view('products.form', [
            'product' => $product,
            'json' => $json
        ]);
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
        $product = \App\Model\Product::find($id);
        $product->cod = $request->input('cod');
        $product->name = $request->input('name');
        $product->desc = $request->input('desc');
        $product->price = str_replace(',', '.', $request->input('price'));
        /*$product->conn_element_name = $request->input('conn_element_name');
        $product->conn_element_search_code = $request->input('conn_element_search_code');*/

        // JSON Multi Connect
        $json_request = $request->input('json');

        if (count($json_request['conn_element_name']) < 2 && $json_request['conn_element_name'][0] == '') {

            $json = null;

        } else {

            $json = json_encode($json_request);
        }

        $product->json = $json;

        $product->save();

        return redirect()->route('products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \App\Model\Product::destroy($id);

        return redirect()->route('products');
    }
}
