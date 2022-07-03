<?php

namespace App\Http\Requests;

use App\Models\EquipmentType;
use Illuminate\Foundation\Http\FormRequest;
use function Resources\SerialMaskValidate\checkSerialMask;

require_once(resource_path('src/SerialMaskValidate.php'));

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
        $serialNumberMask = EquipmentType::where('id', $this->input('code_of_type_equipment'))->first()->serial_number_mask;

        return [
            'code_of_type_equipment' => 'required|min:0|max:100',
            'serial_number' => ['required', function ($attribute, $serialNumber, $fail) use ($serialNumberMask) {
                if (checkSerialMask($serialNumber, $serialNumberMask) === false) {
                    $fail("sn {$serialNumber}: {$serialNumberMask} не соответствует выбранному типу оборудования");
                }
            }],
            'note' => 'required|string'
        ];
    }
}
