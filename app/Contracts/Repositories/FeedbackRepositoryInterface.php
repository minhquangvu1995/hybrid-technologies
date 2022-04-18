<?php

namespace App\Contracts\Repositories;

interface FeedbackRepositoryInterface
{
    public function getList();

    public function reply($request);

    public function getReplyList($request);
}
