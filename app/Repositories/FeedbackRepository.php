<?php

namespace App\Repositories;

use App\Contracts\Repositories\FeedbackRepositoryInterface;
use App\Models\Feedback;
use Illuminate\Support\Arr;

class FeedbackRepository extends Repository implements FeedbackRepositoryInterface
{
    public $model;

    public function __construct(Feedback $model)
    {
        parent::__construct($model);
    }

    public function getList()
    {
        return $this->model
            ->with('user')
            ->where('parent_id', 0)
            ->latest()
            ->get();
    }

    public function reply($request)
    {
        return $this->model->create($request);
    }

    public function getReplyList($request)
    {
        $feedbackId = Arr::get($request, 'feedback_id');

        if ($feedbackId) {
            return $this->model
                ->with('user')
                ->where('parent_id', $feedbackId)
                ->latest()
                ->get();
        }

        return null;
    }
}
