<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdateEquipmentRequest;
use App\Http\Resources\EquipmentResource;
use App\Models\Equipment;
use App\Models\EquipmentType;
use Illuminate\Http\Request;

class EquipmentController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipment = new EquipmentResource(Equipment::all());

        return $equipment;
    }

    /**
     * Show the form for creating a new .resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $equipment = (new EquipmentResource(new Equipment()))->resource;
        return view('equipment.create', compact('equipment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $request->validated();
        $serialNumbers = $this->service->getSerialNumbers();

        foreach ($serialNumbers as $serialNumber) {
            $equipment = new Equipment();

            $equipment->code_of_type_equipment = $request->input('code_of_type_equipment');
            $equipment->serial_number = $serialNumber;
            $equipment->note = $request->input('note');

            $equipment->save();
        }

        return redirect()
            ->route('equipment.index', ['api_token' => $request->input('api_token')]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Equipment $equipment
     * @return \Illuminate\Http\Response
     */
    public function show(Equipment $equipment)
    {
        $equipment = (new EquipmentResource($equipment))->resource;

        return view('equipment.show', compact('equipment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Equipment $equipment
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipment $equipment)
    {
        $equipment = (new EquipmentResource($equipment))->resource;

        return view('equipment.edit', compact('equipment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Equipment $equipment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEquipmentRequest $request, Equipment $equipment)
    {
        $request->validated();

        $equipment->fill($request->all());
        $equipment->save();

        return redirect()
            ->route('equipment.index', ['api_token' => $request->input('api_token')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Equipment $equipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Equipment $equipment)
    {

        $equipment->delete();

        return redirect()
            ->route('equipment.index', ['api_token' => $request->input('api_token')]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function search(Request $request)
    {
        $search = $request->input('search');
        $requiredData = Equipment::where('serial_number', 'LIKE', "%{$search}%")->orWhere('note', 'LIKE', "%{$search}%")->get();
        $equipment = (new EquipmentResource($requiredData))->resource;

        return view('equipment.index', compact('equipment'));
    }
}
