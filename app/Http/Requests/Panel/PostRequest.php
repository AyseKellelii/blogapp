<?php

namespace App\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class PostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $post = $this->route('post');
        $postId = $post ? $post->id : null;

        return [
            'title' => 'required|unique:posts,title,' . $postId,
            'slug' => 'required|string',
            'body' => 'required',
            'categories' => 'required|array|min:1',
            'image' => 'nullable|image|max:2048'
        ];
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

    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->title),
            'user_id' => auth()->id(),
        ]);
    }
}
