<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ZendeskSupportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
            'attachment' => 'nullable|file|max:20480|mimes:jpg,jpeg,png,pdf,doc,docx,txt,zip'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please enter your name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'subject.required' => 'Please enter a subject.',
            'message.required' => 'Please describe your issue.',
            'attachment.max' => 'File size must not exceed 20MB.',
            'attachment.mimes' => 'File must be: jpg, jpeg, png, pdf, doc, docx, txt, or zip.'
        ];
    }
}