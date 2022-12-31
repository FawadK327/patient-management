<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePrescription extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'patient_id'     => 'required',
            'prescription_date'  => 'required',
            'description'    => 'required',
        ];
    }

    public function data()
    {
        $data = [
            'patient_id'     => $this->get('patient_id'),
            'date' => str_slug($this->get('prescription_date')),
            'description'  => $this->get('description')
        ];

        return $data;
    }
}
