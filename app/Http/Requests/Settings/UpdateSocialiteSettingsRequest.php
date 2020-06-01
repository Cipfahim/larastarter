<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateSocialiteSettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        Gate::authorize('app.settings.update');
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
            'facebook_client_id' => 'string|nullable',
            'facebook_client_secret' => 'string|nullable',

            'google_client_id' => 'string|nullable',
            'google_client_secret' => 'string|nullable',

            'github_client_id' => 'string|nullable',
            'github_client_secret' => 'string|nullable',
        ];
    }
}
