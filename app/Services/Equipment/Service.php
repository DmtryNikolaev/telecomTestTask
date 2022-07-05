<?php

namespace App\Services\Equipment;

use App\Models\Equipment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class Service
{
    /**
     * @param Request $request
     * @return array
     */
    public function getSerialNumbers(Request $request): array
    {
        $serialNumbers = isset(getFormattedJsonString($request->serial_number)['sn']) ?
            getFormattedJsonString($request->serial_number)['sn'] :
            collect(getFormattedJsonString($request->serial_number))->pluck('sn');

        return $serialNumbers;
    }

    public function getSearchedData(string $search): Collection
    {
        $requiredData = Equipment::where('serial_number', 'LIKE', "%{$search}%")->orWhere('note', 'LIKE', "%{$search}%")->get();

        return $requiredData;
    }
}
