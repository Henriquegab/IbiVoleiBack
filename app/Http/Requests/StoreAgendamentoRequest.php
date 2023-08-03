<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;

use Illuminate\Validation\Rule;

class StoreAgendamentoRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|min:3|max:50',
            'data' => 'required|date|date_format:Y-m-d H:i:s',
            'fim' => [
                'required',
                'date',
                'date_format:Y-m-d H:i:s',
                function ($attribute, $value, $fail) {
                    $data = Carbon::createFromFormat('Y-m-d H:i:s', $this->data);
                    $fim = Carbon::createFromFormat('Y-m-d H:i:s', $value);

                    // Verifica se há conflito com outros agendamentos
                    if ($this->hasConflictingSchedules($data, $fim)) {
                        $fail('O horário conflita com outro agendamento existente.');
                    }

                    // Verifica se a duração é de pelo menos uma hora
                    if ($data->diffInMinutes($fim) < 60) {
                        $fail('A duração do agendamento deve ser de pelo menos uma hora.');
                    }
                },
            ],
        ];
    }
    private function hasConflictingSchedules(Carbon $data, Carbon $fim): bool
    {
        // Faça a lógica para verificar se há conflito com outros agendamentos
        $existingSchedules = \App\Models\Agendamento::where(function ($query) use ($data, $fim) {
            $query->where('data', '<', $fim)
                ->where('fim', '>', $data);
        })->exists();

        return $existingSchedules;
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => $validator->errors()->first(),
            'data'      => $validator->errors()
        ],400));
    }
}
