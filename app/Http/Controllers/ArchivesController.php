<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Vote;
use App\Models\Voter;
use App\Models\Ballot;
use App\Models\Setting;
use App\Models\Archives;
use App\Models\Position;
use App\Models\Candidate;
use App\Models\BallotItem;
use App\Models\Counter;
use App\Models\CounterOfficer;
use App\Models\EmailTemplate;
use App\Models\OfflineToken;
use App\Models\QrCode;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ArchivesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $archives=Archives::all();
        return view('admin.archive.archive_summary',compact('archives'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }
    public function archiveStore( Request $request)
    {

        $user=Auth::user();
        $check=Hash::check($request->password,$user->password);
        if(!$check){
            return static::makeErrorResponse('Password does not match');
        }
        $setting=Setting::first();
        $voter=Voter::all();
        $online_voters=Voter::where('is_online_voter',1)->get();
        $offline_voters=Voter::where('is_online_voter',null)->get();
        $position=Position::all();
        $candidate=Candidate::all();

        $vote=Vote::all();


            $ballotItems=Ballot::with('position','ballotItems')->get();
            //dd($ballotItems);
            $candidate_id=[];
            $candidate_name=[];
            $vote=[];
            foreach ($ballotItems as $key => $ballot) {

                foreach ($ballot->ballotItems as $key => $item) {
                    array_push($candidate_id,$item->candidate->id);
                    array_push($candidate_name,$item->candidate->name);
                    array_push($vote,$item->candidate->counter+$item->candidate->offline_vote_count);

                }
                // $position_name=$ballot->position->name;
                // array_push($position,$position_name);
            }

            $vote_by_candidate=array_combine($candidate_name,$vote);

            $data=[
                'total_voters'=>count($voter),
                'online_voters'=>count($online_voters),
                'offline_voters'=>count($offline_voters),
                'vote_cast_online'=>count($vote),
                'vote_cast_offline'=>$setting->vote_cast_offline,
                'total_vote_cast'=>count($vote)+$setting->vote_cast_offline,
                'total_candidate'=>count($candidate),
                'total_position'=>count($position),
                'vote_by_candidate'=>json_encode($vote_by_candidate)
            ];
            //dd($data);
            Archives::create($data);
            DB::table('votes')->delete();
            DB::table('voters')->delete();
            DB::table('application_submissions')->delete();
            DB::table('candidates')->delete();
            DB::table('ballots')->delete();
            DB::table('ballot_items')->delete();
            DB::table('qr_codes')->delete();
            DB::table('tokens')->delete();
            DB::table('emails')->delete();
            DB::table('positions')->delete();
            DB::table('counters')->delete();
            DB::table('offline_tokens')->delete();
            DB::table('counters')->delete();
            DB::table('counter_officers')->delete();

            return static::makeSuccessResponse('Archive Successfuly');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Archives  $archives
     * @return \Illuminate\Http\Response
     */
    public function show(Archives $archives)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Archives  $archives
     * @return \Illuminate\Http\Response
     */
    public function edit(Archives $archives)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Archives  $archives
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Archives $archives)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Archives  $archives
     * @return \Illuminate\Http\Response
     */
    public function destroy(Archives $archives)
    {
        //
    }
}
