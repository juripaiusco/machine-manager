<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Machine extends Controller
{
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
        $machines = \App\Model\Machine::get();

        return view('machines.list', [
            'machines' => $machines
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $json = Storage::disk('public')->get('machines_json/atomizzatore.json');
        $fields_obj = json_decode($json);

        return view('machines.form', [
//            'fields_obj' => $fields_obj
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
        $machine = new \App\Model\Machine();

        $machine->type = $request->input('type');
        $machine->year = $request->input('year');
        $machine->number = $request->input('number');
        $machine->author = $request->input('author');
        $machine->name = $request->input('name');
        $machine->n_confirm = $request->input('n_confirm');
        $machine->quantity = $request->input('quantity');
        $machine->date_machine = date(
            'Ymd',
            strtotime(
                str_replace('/', '-', $request->input('date_machine'))
            )) . '000000';
        $machine->customer = $request->input('customer');

        $machine->json = json_encode($request->input('json'));

        $machine->save();

        return redirect()->route('machines');
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
        $json = Storage::disk('public')->get('machines_json/atomizzatore.json');
        $fields_obj = json_decode($json);

        $machine = \App\Model\Machine::find($id);

        return view('machines.form', [
            'machine' => $machine,
            'json' => json_decode($machine->json, true),
            'fields_obj' => $fields_obj
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
        $machine = \App\Model\Machine::find($id);

        $machine->type = $request->input('type');
        $machine->year = $request->input('year');
        $machine->number = $request->input('number');
        $machine->author = $request->input('author');
        $machine->name = $request->input('name');
        $machine->n_confirm = $request->input('n_confirm');
        $machine->quantity = $request->input('quantity');
        $machine->date_machine = date(
                                     'Ymd',
                                     strtotime(
                                         str_replace('/', '-', $request->input('date_machine'))
                                     )) . '000000';
        $machine->customer = $request->input('customer');

        $machine->json = json_encode($request->input('json'));

        $machine->save();

        return redirect()->route('machines');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \App\Model\Machine::destroy($id);

        return redirect()->route('machines');
    }

    public function search(Request $request)
    {
        $products = \App\Model\Product::where('cod', 'LIKE', $request->input('cod') . '%')
                                      ->where(function ($query) use ($request) {
                                          $query->where('desc', 'LIKE', '%' . $request->input('q') . '%')
                                                ->orWhere('cod', 'LIKE', '%' . $request->input('q') . '%');
                                        })
                                      ->take(5)
                                      ->get();

        /*$products = \App\Model\Product::where('cod', 'LIKE', $request->input('cod') . '%')
                                      ->where('desc', 'LIKE', '%' . $request->input('q') . '%')
                                      ->take(5)
                                      ->get();*/

        echo json_encode($products);
    }

    public function dynamicField($type, $id = '')
    {
        $json = Storage::disk('public')->get('machines_json/' . $type . '.json');
        $fields_obj = json_decode($json);

        $machine = '';
        $json = '';

        if ($id) {
            $machine = \App\Model\Machine::find($id);
            $json = json_decode($machine->json, true);
        }

        return view('machines.form-dynamic-field', [
            'machine' => $machine,
            'json' => $json,
            'fields_obj' => $fields_obj
        ]);
    }
}
