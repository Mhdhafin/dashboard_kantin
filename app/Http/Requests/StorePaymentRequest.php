<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
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
            'bill_id' => 'required|exists:bills,id',
            'amount' => 'required|min:1',
            'payment_proof' => 'nullable|image|mimes:jpg,png,jpeg,svg,gif|max:2048',
            'paid_at' => 'required|date',
            'notes' => 'nullable',
        ];
    }
}
