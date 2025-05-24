<?php

namespace App\Livewire;

use App\Models\Degree;
use App\Models\Question;
use Livewire\Component;

class ShowQuestion extends Component
{
    public $exam_id;
    public $student_id;
    public $data;
    public $counter = 0;
    public $questionCount = 0;
    public function mount()
    {

        $this->data = Question::where('quiz_id', $this->exam_id)->get();
        $this->questionCount = $this->data->count();
    }

    public function render()
    {
        return view('livewire.show-question', ['questions' => $this->data]);
    }
    public function nextQuestion($question_id, $score, $answer, $right_answer)
    {
        $studentDegree = Degree::where('student_id', $this->student_id)->where('quiz_id', $this->exam_id)->first();
        if ($studentDegree) {
            if ($studentDegree->question_id >= $this->data[$this->counter]->id) {
                $studentDegree->score = 0;
                $studentDegree->abuse = '1';
                $studentDegree->date = now();
                $studentDegree->save();
                flash()->addError(trans('message.examFailed'));
                return redirect()->route('student.exam.index');
            } else {
                if (strcmp(trim($answer), trim($right_answer)) === 0) {
                    $studentDegree->score += $score;
                } else {
                    $studentDegree->score = 0;
                }
                $studentDegree->date = now();
                $studentDegree->save();
            }
        } else {
            $studentDegree = new Degree();
            $studentDegree->student_id = $this->student_id;
            $studentDegree->quiz_id = $this->exam_id;
            $studentDegree->question_id = $question_id;
            $studentDegree->date = now();

            if (strcmp(trim($answer), trim($right_answer)) === 0) {
                $studentDegree->score += $score;
            } else {
                $studentDegree->score = 0;
            }
            $studentDegree->save();
        }
        if ($this->counter < $this->questionCount - 1) {
            $this->counter++;
        } else {
            flash()->addSuccess(trans('message.examFinished'));
            return redirect()->route('student.exam.index');
        }
    }
}
