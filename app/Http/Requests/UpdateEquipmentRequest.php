<?php

namespace App\Http\Requests;

use App\Models\EquipmentType;
use Illuminate\Foundation\Http\FormRequest;
use Resources\EquipmentRequestHelper;

class UpdateEquipmentRequest extends FormRequest
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
        $serialNumberMask = EquipmentType::where('id', $this->input('equipment_type_id'))->first()->serial_number_mask;
        $helper = new EquipmentRequestHelper();

        return [
            'equipment_type_id' => 'required|min:0|max:100',
            'serial_number' => ['required', function ($attribute, $serialNumber, $fail) use ($serialNumberMask, $helper) {
                if ( $helper->checkSerialMask($serialNumber, $serialNumberMask) === false) {
                    $fail("sn {$serialNumber}: {$serialNumberMask} не соответствует выбранному типу оборудования");
                }
            }]
        ];
    }
}
