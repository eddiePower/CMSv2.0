<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkWithPage extends FormRequest
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
      "title" => "required",
      "url" => "required",
      "content" => "required|max:220",
    ];
    }

    public function message()
    {
        return [
      "title.required" => "You must Enter a Title.",
      "url.required" => "You must enter a URL",
      "content.required" =>
        "You must enter some page content thats no longer then 220 characters please.",
    ];
    }
}
