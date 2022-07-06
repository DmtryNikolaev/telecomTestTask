<?php

namespace App\Http\Requests;

use App\Models\EquipmentType;
use Illuminate\Foundation\Http\FormRequest;
use Resources\EquipmentRequestHelper;

class StoreEquipmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $helper = new EquipmentRequestHelper();

        $serialNumberMask = EquipmentType::where('id', $this->input('code_of_type_equipment'))->first()->serial_number_mask;
        $validateSerialNumber = function ($attribute, $snNotFormat, $fail) use ($serialNumberMask, $helper) {
            if (is_array($helper->getFormattedJsonString($snNotFormat))) {
                $formattedJsonString = $helper->getFormattedJsonString($snNotFormat);

                $serialNumbers = isset($formattedJsonString['sn']) ? $formattedJsonString['sn'] : collect($formattedJsonString)->pluck('sn');

                foreach ($serialNumbers as $serialNumber) {
                    if ($helper->checkSerialMask($serialNumber, $serialNumberMask) === false) {
                        $fail("sn {$serialNumber}: {$serialNumberMask} не соответствует выбранному типу оборудования");
                    }
                }
            } elseif (!is_array($helper->getFormattedJsonString($snNotFormat))) {
                $fail("{$attribute} должен быть массивом или json");
            }
        };

        return [
            'code_of_type_equipment' => 'required|min:0|max:100',
            'serial_number' => ['required', $validateSerialNumber]
        ];
    }
}
