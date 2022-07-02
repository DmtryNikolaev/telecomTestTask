<?php

namespace App\Http\Requests;

use App\Models\EquipmentType;
use Illuminate\Foundation\Http\FormRequest;

require_once(resource_path('src/FormattedJsonString.php'));

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
        $regularExpressions = [
            'N' => '[0-9]',
            'A' => '[A-Z]',
            'a' => '[a-z]',
            'X' => '[A-Z0-9]',
            'Z' => '[-_@]'
        ];
        $snMaskSplit = mb_str_split($serialNumberMask);
        $regex = collect($snMaskSplit)->map(function ($regex) use ($regularExpressions) {
            return $regularExpressions[$regex];
        })->implode('');

        return [
            'code_of_type_equipment' => 'required|min:0|max:100',
            'serial_number' => ['required', function ($attribute, $snUnformat, $fail) use ($regex, $serialNumberMask) {
                if (is_array(getFormattedJsonString($snUnformat))) {
                    $serialNumbers = getFormattedJsonString($snUnformat)['sn'];

                    foreach ($serialNumbers as $serialNumber) {
                        if (!preg_match_all("/^{$regex}/", $serialNumber)) {
                            $fail("sn {$serialNumber}: {$serialNumberMask} не соответствует выбранному типу оборудования");
                        }
                    }
                } elseif (!is_array(getFormattedJsonString($snUnformat))) {
                    $fail("{$attribute} должен быть массивом или json");
                }
            }],
            'note' => 'required|string'
        ];
    }
}
