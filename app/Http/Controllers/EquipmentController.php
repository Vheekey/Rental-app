<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Equipment::paginate(20);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:equipment,name'
        ]);

        Equipment::create([
            'name' => $request->name
        ]);

        return $this->okResponse('New Equipment Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function show(Equipment  $equipment)
    {
        return $this->okResponse('Equipment Retrieved', $equipment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipment $equipment)
    {
        $request->validate([
            'name' => 'required|string|unique:equipment,name'
        ]);

        $equipment->update([
            'name' => $request->name
        ]);

        return $this->okResponse('Update Successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipment $equipment)
    {
        $equipment->delete();

        return $this->okResponse('Operation Successful');
    }
}
