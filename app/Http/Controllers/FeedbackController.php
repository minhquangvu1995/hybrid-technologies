<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\FeedbackRepositoryInterface;
use App\Http\Requests\FeedbackRequest;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    protected $feedbackRepository;

    public function __construct(FeedbackRepositoryInterface $feedbackRepository)
    {
        $this->feedbackRepository = $feedbackRepository;
    }

    public function getList()
    {
        $feedbackList = $this->feedbackRepository->getList();
        return view('feedback', compact('feedbackList'));
    }

    public function reply(FeedbackRequest $request)
    {
        $this->feedbackRepository->reply($request->except('_token'));
        return redirect()->back()->with('success', 'Successful send !!!');
    }

    public function getReplyList(Request $request)
    {
        $replyList = $this->feedbackRepository->getReplyList($request);
        return view('reply', compact('replyList'));
    }
}
