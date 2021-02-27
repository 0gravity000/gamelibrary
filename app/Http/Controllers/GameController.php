<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        //dd($request->InputGameName1);
        //$game = Game::where('title', $title)->first();
        //タイトルにスペースを含むとレスポンスにがNullになるので + に置換する
        $title = str_replace(array(" ", "  ", "　"), '+', $request->InputGameName1);	//改行コード削除が必要？
        $apikey = Storage::disk('local')->get('/keys/youtubeapi');
        //dd($apikey);

        //Search: list
        $request_url = 'https://www.googleapis.com/youtube/v3/search?part=snippet&type=video&videoCategoryId=20&maxResults=50&q='.$title.'&key='.$apikey;
        //dd($request_url);
        $context = stream_context_create(array(
          'http' => array('ignore_errors' => true)
         ));
        $res = file_get_contents($request_url, false, $context);
        //dd($res);
        $respons = json_decode($res, false) ;
        //dd($respons);
        $gameitems = $respons->items;
        //dd($gameitems);
        $serachgamename = $request->InputGameName1;
        //dd($serachgamename);
        return view('gamelist', compact('gameitems', 'serachgamename'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  $serachgamename, $videoid
     * @return \Illuminate\Http\Response
     */
    public function show($serachgamename, $videoid)
    {
        //video:list
        //https://developers.google.com/youtube/v3/docs/videos/list
        //
        $apikey = Storage::disk('local')->get('/keys/youtubeapi');
        //dd($apikey);

        //Search: list
        //パラメータ値に指定できる part 名は、id、 snippet、 contentDetails、 fileDetails、 liveStreamingDetails、 player、 processingDetails、 recordingDetails、 statistics、 status、 suggestions、 topicDetails などです。
    	//videoid 例) t3cLDDwLeJA        
        $request_url = 'https://www.googleapis.com/youtube/v3/videos?part=player,snippet,contentDetails&id='.$videoid.'&key='.$apikey;

        $context = stream_context_create(array(
            'http' => array('ignore_errors' => true)
           ));
        $res = file_get_contents($request_url, false, $context);
        //dd($res);
        $respons = json_decode($res, false) ;
        //dd($respons);
        $videoitems = $respons->items;
        //dd($videoitems);
        //dd($serachgamename);
        return view('gamedetail', compact('videoitems', 'serachgamename'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        //
    }
}
