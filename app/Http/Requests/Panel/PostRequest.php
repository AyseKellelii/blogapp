<?php

namespace App\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id');

        if ($this->isMethod('post')) {
            return [
                'title' => 'required|unique:posts,title',
                'body' => 'required',
                'categories' => 'required|array|min:1',
                'image' => 'nullable|image|max:2048'
            ];
        }

        if ($this->isMethod('put')) {
            return [
                'title' => 'required|unique:posts,title,' . $id,
                'body' => 'required',
                'categories' => 'required|array|min:1',
                'image' => 'nullable|image|max:2048'
            ];
        }

        return [];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Başlık zorunludur.',
            'title.unique' => 'Bu başlık zaten mevcut.',
            'body.required' => 'İçerik zorunludur.',
            'categories.required' => 'En az bir kategori seçmelisiniz.',
            'image.image' => 'Yüklenen dosya geçerli bir resim olmalıdır.',
        ];
    }
}
