<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'label' => ['required','string', 'max:255'],
            'start_at' => ['required'],
            'end_at' => ['required'],
            'room' => ['required','string', 'max:255'],
            'user_id' => ['required','', 'max:255'],
            'password' => ['required','string', 'max:255'],
        ];
    }
   /* public function message(){

    }*/
}
