<?php

namespace App\Services\Equipment;

use App\Models\Equipment;
use Illuminate\Database\Eloquent\Collection;
use \Illuminate\Support\Collection as SupportCollection;
use Resources\EquipmentRequestHelper;

class Service
{
    public function getSerialNumbers(string $serialNumber): SupportCollection
    {
        $formattedJson = (new EquipmentRequestHelper())->getFormattedJsonString($serialNumber);

        $serialNumbers = isset($formattedJson['sn']) ?
            $formattedJson['sn'] :
            collect($formattedJson)->pluck('sn');

        return $serialNumbers;
    }

    /**
     * @param string $search
     * @return Collection
     */
    public function getSearchedData(string $search): Collection
    {
        $requiredData = Equipment::where('serial_number', 'LIKE', "%{$search}%")->orWhere('note', 'LIKE', "%{$search}%")->get();

        return $requiredData;
    }
}
