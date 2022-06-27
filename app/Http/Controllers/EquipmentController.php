<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\EquipmentType;
use Illuminate\Http\Request;
use function MongoDB\BSON\toJSON;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipment = Equipment::all();

        return view('equipment.index', compact('equipment'));
    }

    /**
     * Show the form for creating a new .resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $equipment = new Equipment();
        return view('equipment.create', compact('equipment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $serialNumberMask = EquipmentType::where('id', $request->input('code_of_type_equipment'))->first()->serial_number_mask;

        function isValidatedSerialNumber($snMask, $sn)
        {
            function getFormattedJsonString($value)
            {
                $valueReplaced = str_replace("'", '"', $value);

                return json_decode($valueReplaced, true);
            }
            $regexInArr = [
                'N' => '[0-9]',
                'A' => '[A-Z]',
                'a' => '[a-z]',
                'X' => '[A-Z0-9]',
                'Z' => '[-_@]'
            ];
            $serialNumberFormatted = getFormattedJsonString($sn);
            $serialNumbers = collect($serialNumberFormatted)->keyBy('sn')->first();

            foreach ($serialNumbers as $snElem) {
                $serialNumbersSplit = mb_str_split($snElem);
                $snMaskSplit = mb_str_split($snMask);

                foreach ($snMaskSplit as $elemOfSnMask) {
                    if (!preg_match("/{$regexInArr[$elemOfSnMask]}/", $snElem)) {
                        return false;
                    }
                }
            }

            return true;
        }

        dd(isValidatedSerialNumber($serialNumberMask, $request->input('serial_number')));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Equipment $equipment
     * @return \Illuminate\Http\Response
     */
    public function show(Equipment $equipment)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Equipment $equipment
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipment $equipment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Equipment $equipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipment $equipment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Equipment $equipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipment $equipment)
    {
        //
    }
}
