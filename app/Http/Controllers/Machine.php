<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Machine extends Controller
{
    var $type_array = array(
        'Atomizzatore',
        'Polverizzatore'
        /*'Atomizzatori trainati',
        'Atomizzatori portati',
        'Polverizzatori semiportati',
        'Polverizzatori portati',
        'Gruppo portato'*/
    );

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
        $machines = \App\Model\Machine::orderBy('id', 'DESC');

        if ($request->input('s') || $request->input('type')) {

            $machines = $machines->where('name', 'LIKE', '%' . $request->input('s') . '%')
                ->where('type', 'LIKE', '%' . $request->input('type') . '%');

        }

        $machines = $machines->paginate(10);

        return view('machines.list', [
            'machines' => $machines,
            's' => $request->input('s'),
            'type' => $request->input('type'),
            'type_array' => $this->type_array
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('machines.form', [
            'type_array' => $this->type_array
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
        /*$machine->year = $request->input('year');*/
        $machine->number = $this->getNumber($request->input('type'));
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
        $machine = \App\Model\Machine::find($id);

//        dd(json_decode($machine->json, true));

        return view('machines.form', [
            'machine' => $machine,
            'json' => json_decode($machine->json, true),
            'type_array' => $this->type_array
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
        /*$machine->year = $request->input('year');
        $machine->number = $request->input('number');*/
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
        if ($request->input('q') == '') {

            $products = \App\Model\Product::where('cod', 'LIKE', $request->input('cod') . '%')
                ->get();

        } else {

            $products = \App\Model\Product::where('cod', 'LIKE', $request->input('cod') . '%')
                ->where(function ($query) use ($request) {

                    $search_keyword = explode(' ', $request->input('q'));

                    foreach ($search_keyword as $keyword) {

                        $query->where('desc', 'LIKE', '%' . $keyword . '%');

                    }

                    $query->orWhere('cod', 'LIKE', '%' . $request->input('q') . '%');

                })
                ->get();
        }

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

    public function getNumber($type)
    {
        $macchina = \App\Model\Machine::select('number')
            ->where('type', $type)
            ->orderBy('id', 'DESC')
            ->first();

        $number = 1;

        if (isset($macchina->number)) {
            $number += $macchina->number;
        }

        return $number;
    }
}
