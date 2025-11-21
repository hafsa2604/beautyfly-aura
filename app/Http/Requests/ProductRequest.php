<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ProductRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'title' => 'required|string|max:191',
            'type'  => 'required|in:dry,oily,combination',
            'price' => 'required|integer',
            'image' => 'nullable|image|max:2048',
            'desc'  => 'nullable|string',
            'benefits' => 'nullable|string',
            'usage' => 'nullable|string',
        ];
    }


}
