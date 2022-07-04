<?php

namespace App\Http\Requests;

use App\Models\EquipmentType;
use Illuminate\Foundation\Http\FormRequest;
use function Resources\SerialMaskValidate\checkSerialMask;

require_once(resource_path('src/FormattedJsonString.php'));
require_once(resource_path('src/SerialMaskValidate.php'));

class StorePostRequest extends FormRequest
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
        $serialNumberMask = EquipmentType::where('id', $this->input('code_of_type_equipment'))->first()->serial_number_mask;
        $validateSerialNumber = function ($attribute, $snNotFormat, $fail) use ($serialNumberMask) {
            if (is_array(getFormattedJsonString($snNotFormat))) {
                $serialNumbers = isset(getFormattedJsonString($snNotFormat)['sn']) ? getFormattedJsonString($snNotFormat)['sn'] : collect(getFormattedJsonString($snNotFormat))->pluck('sn');

                foreach ($serialNumbers as $serialNumber) {
                    if (checkSerialMask($serialNumber, $serialNumberMask) === false) {
                        $fail("sn {$serialNumber}: {$serialNumberMask} не соответствует выбранному типу оборудования");
                    }
                }
            } elseif (!is_array(getFormattedJsonString($snNotFormat))) {
                $fail("{$attribute} должен быть массивом или json");
            }
        };

        return [
            'code_of_type_equipment' => 'required|min:0|max:100',
            'serial_number' => ['required', $validateSerialNumber],
            'note' => 'required|string'
        ];
    }
}
