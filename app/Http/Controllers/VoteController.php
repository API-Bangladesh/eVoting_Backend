<?php

namespace App\Http\Controllers;

use App\Models\Vote;

class VoteController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiGetSingleVote($id)
    {
        try {
            $vote = Vote::find($id);
        } catch (\Exception $exception) {
            report($exception);

            return static::makeErrorResponse($exception->getMessage());
        }

        return static::makeSuccessResponse('Record fetched successfully', $vote);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllVoteIds()
    {
        try {
            $votes = Vote::get()->pluck('id');
        } catch (\Exception $exception) {
            report($exception);

            return static::makeErrorResponse($exception->getMessage());
        }

        return static::makeSuccessResponse('Record fetched successfully.', $votes);
    }
}
