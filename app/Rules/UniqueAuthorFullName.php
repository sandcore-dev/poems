<?php

namespace App\Rules;

use App\Models\Author;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class UniqueAuthorFullName implements Rule
{
    /**
     * @var Author
     */
    protected $ignoreAuthor;

    /**
     * @var Request
     */
    protected $request;

    /**
     * Create a new rule instance.
     *
     * @param Request|null $request
     */
    public function __construct(Request $request = null)
    {
        $this->ignoreAuthor = new Author();
        $this->request = $request ?? request();
    }

    /**
     * @param Author $author
     * @return self
     */
    public function ignore(Author $author): self
    {
        $this->ignoreAuthor = $author;
        return $this;
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
        return Author::where('title', '=', $this->request->input('title'))
            ->where('first_name', '=', $this->request->input('first_name'))
            ->where('middle_names', '=', $this->request->input('middle_names'))
            ->where('last_name', '=', $this->request->input('last_name'))
            ->where('id', '!=', (int)$this->ignoreAuthor->id)
            ->doesntExist();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The author name is not unique';
    }
}
