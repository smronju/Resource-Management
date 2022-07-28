<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateResourceRequest extends FormRequest
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
    public function rules() {
        $rules = [
            'title' => 'required|max:255',
            'type' => 'required|string',
        ];

        $type = $this->request->get('type');

        if ($type === 'link') {
            $rules['link'] = 'required|url';
            $rules['new_tab'] = 'nullable';
        } else if ($type === 'snippet') {
            $rules['description'] = 'required|min:10';
            $rules['snippet'] = 'nullable';
        } else if ($type === 'pdf') {
            $rules['file'] = 'required|mimes:pdf|max:5120';
        }

        return $rules;
    }

    // public function rules()
    // {
    //     return match ($this->method()) {
    //         'POST' => $this->store(),
    //         'PUT', 'PATCH' => $this->update(),
    //         'DELETE' => $this->destroy(),
    //         default => $this->view()
    //     };
    //
    // }
    //
    // /**
    //  * Get the validation rules that apply to the get request.
    //  *
    //  * @return array
    //  */
    // public function view()
    // {
    //     return [
    //
    //     ];
    // }
    //
    // /**
    //  * Get the validation rules that apply to the post request.
    //  *
    //  * @return array
    //  */
    // public function store()
    // {
    //     return [
    //         //
    //     ];
    // }
    //
    // /**
    //  * Get the validation rules that apply to the put/patch request.
    //  *
    //  * @return array
    //  */
    // public function update()
    // {
    //     return [
    //         //
    //     ];
    // }
    //
    // /**
    //  * Get the validation rules that apply to the delete request.
    //  *
    //  * @return array
    //  */
    // public function destroy()
    // {
    //     return [
    //         //
    //     ];
    // }

}
