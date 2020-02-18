<?php

namespace App\Rules;

use App\Team;
use Illuminate\Contracts\Validation\Rule;

class sameName implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        $team = Team::where('name', '=', $value)->count();
        return $team < 1;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute Cannot be the same name as an other team!';
    }
}
