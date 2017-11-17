<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use \App\Traits\TalksToDriblyApiTrait;

class EmailUnique implements Rule
{
    use TalksToDriblyApiTrait;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        ;
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
        $passes = false;
        try
        {
            $passes = !$this->get($_ENV['SERVICE_USERS'] . '/api/v1/users/exists', ['query' => ["email" => $value]]);
        }
        catch (\Exception $e)
        {
            var_dump($e->getMessage(), $e->getFile(), $e->getLine());exit();
        }
        return $passes;
        //
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'That email address appears to have been used already';
    }
}
