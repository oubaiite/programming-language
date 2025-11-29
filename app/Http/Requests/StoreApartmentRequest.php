<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if($this->isMethod('post'))
        return [
          'site'=>'',
          'type'=>'',
          'number_of_room'=>'',
          'owner'=>'',
          'owner_phone'=>'',
          ''
        ];
        else
        {
            return [
                ''
            ];
        }
    }
}
