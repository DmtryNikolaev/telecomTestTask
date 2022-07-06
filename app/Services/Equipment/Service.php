<?php

namespace App\Services\Equipment;

use App\Models\Equipment;
use Illuminate\Database\Eloquent\Collection;
use \Illuminate\Support\Collection as SupportCollection;
use Illuminate\Http\Request;

class Service
{
    /**
     * @param Request $request
     * @return array
     */
    public function getSerialNumbers(string $serialNumber): SupportCollection
    {
        $serialNumbers = isset(getFormattedJsonString($serialNumber)['sn']) ?
            getFormattedJsonString($serialNumber)['sn'] :
            collect(getFormattedJsonString($serialNumber))->pluck('sn');

        return $serialNumbers;
    }

    public function getSearchedData(string $search): Collection
    {
        $requiredData = Equipment::where('serial_number', 'LIKE', "%{$search}%")->orWhere('note', 'LIKE', "%{$search}%")->get();

        return $requiredData;
    }
}
