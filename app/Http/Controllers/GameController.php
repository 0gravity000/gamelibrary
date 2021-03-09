<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\GametitleAliase;
use App\ApiRequest;
use App\Searchlist;
class GameController extends Controller
{
    private $apikeys;

    public function __construct() {
        $tmp = explode(",", Storage::disk('local')->get('/keys/youtubeapi'));
        $tmp = str_replace(array(" ", "  ", "　","\r\n"), '', $tmp);	//スペース、改行を除去
        $this->apikeys = $tmp;
    }

    public function random()
    {
        $count = 10;
        $searchlists = Searchlist::inRandomOrder()->take($count)->get();
        $gametitlealiases = GametitleAliase::all();

        return view('root', compact('searchlists', 'gametitlealiases'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param  $serachgamename
     * @return \Illuminate\Http\Response
     */
    public function index($serachgamename)
    {
        //
        //dd($request->InputGameName1);
        //$game = Game::where('title', $title)->first();
        //タイトルにスペースを含むとレスポンスにがNullになるので + に置換する
        $title = str_replace(array(" ", "  ", "　"), '+', $serachgamename);	//改行コード削除が必要？
        $apirequest = ApiRequest::where('id', 1)->first();
        
        //api keyループ
        for ($apiidx=0; $apiidx < count($this->apikeys); $apiidx++) { 
            //Search: list
            $request_url = $apirequest->url.
                '?part='.$apirequest->part.
                '&order='.$apirequest->order.
                '&type='.$apirequest->type.
                '&videoCategoryId='.$apirequest->videocategoryid.
                '&maxResults='.$apirequest->maxresults.
                '&q='.$title.
                '&key='.$this->apikeys[$apiidx];
            /*
            $request_url = 'https://www.googleapis.com/youtube/v3/search?part=snippet&order=rating&type=video&videoCategoryId=20&maxResults=50&q='.$title.'&key='.$this->apikeys[$apiidx];
             */
            //dd($request_url);
            $context = stream_context_create(array(
            'http' => array('ignore_errors' => true)
            ));
            $res = file_get_contents($request_url, false, $context);
            //dd(mb_detect_encoding($res));
            //dd($res);
            $respons = json_decode($res, false) ;
            //dd($respons);
            if (array_key_exists('error', $respons)) {
                //エラー 次のapi keyループ
            } else {
                break;
            }
        }

        $gametitlealias = GametitleAliase::where('title', $serachgamename)->first();

        if (array_key_exists('items', $respons)) {
            //api keyで検索可能時（api keyの上限に達していない）
            //searchlistテーブルに登録
            //dd($respons);
            $gameitems = $respons->items;
            foreach ($gameitems as $gameitem) {
                if (Searchlist::where('gametitle_aliase_id', $gametitlealias->id)
                    ->where('videoid', $gameitem->id->videoId)->exists()) {
                    $searchlist = Searchlist::where('gametitle_aliase_id', $gametitlealias->id)
                    ->where('videoid', $gameitem->id->videoId)->first();
                    //dd($searchlist);
                } else {
                    //新規追加
                    $searchlist = new Searchlist;
                }

                $searchlist->videoid = $gameitem->id->videoId;
                $searchlist->channelid = $gameitem->snippet->channelId;
                $searchlist->channeltitle = $gameitem->snippet->channelTitle;
                $searchlist->title = $gameitem->snippet->title;
                $searchlist->description = $gameitem->snippet->description;
                $searchlist->thumbnails_defaulturl = $gameitem->snippet->thumbnails->default->url;
                $searchlist->thumbnails_mediumurl = $gameitem->snippet->thumbnails->medium->url;
                $searchlist->thumbnails_highurl = $gameitem->snippet->thumbnails->high->url;
                $searchlist->description = $gameitem->snippet->description;
                $searchlist->publishtime = $gameitem->snippet->publishTime;
                $searchlist->api_request_id = $apirequest->id;
                $searchlist->kind = $respons->kind;
                try {
                    $searchlist->nextpagetoken = $respons->nextPageToken;
                } catch (\Exception $e) {
                    $searchlist->nextpagetoken = '';
                }
                try {
                    $searchlist->prevpagetoken = $respons->prevPageToken;
                } catch (\Exception $e) {
                    $searchlist->prevpagetoken = '';
                }
                $searchlist->gametitle_aliase_id = $gametitlealias->id;
                $searchlist->save();
            }

            $searchlists = Searchlist::where('gametitle_aliase_id', $gametitlealias->id)->get();

        } else {
            //全api keyで検索してもエラー
            //DBに該当ゲームの登録ありの場合、DBの内容を表示
            if (Searchlist::where('gametitle_aliase_id', $gametitlealias->id)->exists()) {
                $searchlists = Searchlist::where('gametitle_aliase_id', $gametitlealias->id)->get();
            } else {
               //DBに該当ゲームの登録なしの場合、エラーを表示
                $message="Sorry. Request exceeded limit. Please request tomorrow";
                //dd($respons);
                //return redirect()->route('welcome', 'message');
                return view('welcome', compact('message'));
            }
        }

        //dd($searchlists);
        return view('gamelist', compact('searchlists', 'serachgamename'));
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

        //api keyループ
        for ($apiidx=0; $apiidx < count($this->apikeys); $apiidx++) { 
            //Search: list
            //パラメータ値に指定できる part 名は、id、 snippet、 contentDetails、 fileDetails、 liveStreamingDetails、 player、 processingDetails、 recordingDetails、 statistics、 status、 suggestions、 topicDetails などです。
            //videoid 例) t3cLDDwLeJA        
            $request_url = 'https://www.googleapis.com/youtube/v3/videos?part=player,snippet,contentDetails&id='.$videoid.'&key='.$this->apikeys[$apiidx];

            $context = stream_context_create(array(
                'http' => array('ignore_errors' => true)
            ));
            $res = file_get_contents($request_url, false, $context);
            //dd($res);
            $respons = json_decode($res, false) ;
            //dd($respons);
            if (array_key_exists('error', $respons)) {
                //エラー 次のapi keyループ
            } else {
                break;
            }
        }
        if (array_key_exists('items', $respons)) {
        } else {
            //全api keyで検索してもエラー
            exit;
        }

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
