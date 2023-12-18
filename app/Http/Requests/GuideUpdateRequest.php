<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class GuideUpdateRequest extends FormRequest
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
        return [
            'title' => ['required', 'string', 'between:3,100', Rule::unique('guides')->ignore($this->guide)],
            'icon' => ['nullable', 'string', 'between:3,30'],
            'program_link' => ['required', 'url', 'string', 'between:3,255', Rule::unique('guides')->ignore($this->guide)],
            'doc_link' => ['required', 'regex:/http:\/\/onlyoffice\.orlan\.in\/.*/', 'string', 'between:3,255', Rule::unique('guides')->ignore($this->guide)],
            'file' => ['nullable', File::types(['html'])->max(100 * 1024)],
            'sort' => ['nullable', 'integer', 'between:0,255'],
            'public' => ['required', 'boolean']
        ];
    }

    public function attributes()
    {
        return [
            'icon' => __('Icon'),
            'program_link' => __('Link to the program'),
            'doc_link' => __('Link to onlyoffice'),
            'file' => __('File'),
            'sort' => __('Sorting'),
            'public' => __('Public')
        ];
    }

    public function messages()
    {
        return [
            'file.max' => __('The file size in the "File" field cannot be more than 100 Megabytes'),
            'doc_link.regex' => __('Invalid format of the link to :link.', ['link' => '<a href="http://onlyoffice.orlan.in">http://onlyoffice.orlan.in</a>'])
        ];
    }
}
