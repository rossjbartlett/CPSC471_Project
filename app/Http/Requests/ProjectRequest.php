<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\validation\Rule;
use App\Book;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth()->user()->isManager()) {
            return true;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'budget' => 'required|numeric',
            'departmentId' => 'required|numeric|exists:departments,id'
        ];
    }

    // error messages
    // public function messages()
    // {
    //     return [
    //         'title.required'=>'Title is required',
    //         'title.min:3'=>'Title must be >3 characters',
    //         'body' => 'Body is required',
    //         'published_at.required'=>'Publish date is required',
    //     ];
    // } 
}
