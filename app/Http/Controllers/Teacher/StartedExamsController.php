<?php

namespace App\Http\Controllers\Teacher;

use App\Exam;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class StartedExamsController extends Controller
{

    /**
     * Start a new exam
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject_id' => ['required', 'int', 'exists:subjects,id'],
            'class_id' => ['required', 'int', 'exists:classes,id'],
        ]);

        list($subjectId, $classId) = $request->only('subject_id','class_id');

        $exam = Exam::canBeStarted()->where('subject_id',$subjectId)->where('class_id',$classId)->with('subject','class')->first();

        abort_if(! $exam, 404, "There are currently no exams that can be started for this class subject");
        abort_if(Gate::denies('view-subject-details', [$subjectId, $classId]), 403, "You are not authorized to start an exam for this class subject");

        $exam->start();

        return $this->sendSuccessResponse("Exam {$exam->subject->name} started successfully", $exam);
    }

    /**
     * End an already started exam
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $exam = Exam::started()->where('id', $id)->with('subject','class')->first();

        abort_if(! $exam, 404, "This exam does not exist as a started exam");
        abort_if(! Gate::denies('view-subject-details', [$exam->subject_id, $exam->class_id]), 403, "You are not authorized to end an exam for this class subject");

        $exam->end();

        $this->sendSuccessResponse("Exam {$exam->subject->name} ended successfully", $exam);
    }
}