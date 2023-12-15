<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\ExamQuestion;
use Illuminate\Support\Facades\Auth;

class Uncommon implements DataAwareRule, ValidationRule
{
    protected $data = [];
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        foreach (ExamQuestion::where([['user_id', Auth::id()], ['exam_id', $this->data['exam_id']]])->get('question') as $prop) {
            if (empty($this->data['question_id']) && $prop->question == $value) {
                $fail('The '.$attribute.' has already been taken.');
            }
        }
    }

    public function setData(array $data): static
    {
        $this->data = $data;
        return $this;
    }
}
