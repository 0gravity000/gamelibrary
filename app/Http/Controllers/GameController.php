<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\GametitleAliase;

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
        $count = 3;
        $gametitlealiases = GametitleAliase::inRandomOrder()->take($count)->get();

        //dd($this->apikeys);
        //$apikey = Storage::disk('local')->get('/keys/youtubeapi');
        $idx = 0;
        $gameitems = [$count];
        $titles = [$count];
        foreach ($gametitlealiases as $gametitlealiase) {
            //タイトルにスペースを含むとレスポンスにがNullになるので + に置換する
            $titles[$idx] = str_replace(array(" ", "  ", "　"), '+', $gametitlealiase->title);	//改行コード削除が必要？
            //api keyループ
            for ($apiidx=0; $apiidx < count($this->apikeys); $apiidx++) { 
                $request_url = 'https://www.googleapis.com/youtube/v3/search?part=snippet&order=rating&type=video&videoCategoryId=20&maxResults=10&q='.$titles[$idx].'&key='.$this->apikeys[$apiidx];
                //dd($request_url);
                $context = stream_context_create(array(
                  'http' => array('ignore_errors' => true)
                 ));
                $res = file_get_contents($request_url, false, $context);
                //dd($res);
                $respons = json_decode($res, false) ;
                //dd($respons, $this->apikeys[$apiidx]);
                if (array_key_exists('error', $respons)) {
                    //dd($respons, $this->apikeys[$apiidx]);
                    //エラー 次のapi keyループ
                    /*
                    +"error": {#299 ▼
                        +"code": 403
                        +"message": "The request cannot be completed because you have exceeded your <a href="/youtube/v3/getting-started#quota">quota</a>."
                        +"errors": array:1 [▶]
                    }
                    +"error": {#299 ▼
                        +"code": 400
                        +"message": "API key not valid. Please pass a valid API key."
                        +"errors": array:1 [▶]
                        +"status": "INVALID_ARGUMENT"
                    }
                    */
                } else {
                    //dd($respons, $this->apikeys[$apiidx]);
                    break;
                }
            }
            
            //dd($respons, $this->apikeys[$apiidx]);
            if (array_key_exists('items', $respons)) {
            } else {
                //全api keyで検索してもエラー
                $message="Sorry. Request exceeded limit. Please request tomorrow";
                //dd($respons);
                return view('welcome', compact('message'));
            }
            $tmpgameitems = $respons->items;    //配列が返る
            //dd($tmpgameitems);

            $arrays = array_rand($tmpgameitems, 2);
            //dd($arrays);
            $arrayidx = 0;
            for ($arrayidx=0; $arrayidx < count($arrays); $arrayidx++) { 
                $items[$arrayidx] = $tmpgameitems[$arrays[$arrayidx]] ;
            }
            $gameitems[$idx] = $items;
            //$gameitems = $tmpgameitems->random(1)->all();
            //$gameitems = $tmpgameitems[$idx]->random(1)->all();
            //dd($gameitems);
            $idx++;
        }
        //dd($gameitems);
        $gametitlealiases = GametitleAliase::all();
        return view('root', compact('gameitems','titles','gametitlealiases'));
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
        //api keyループ
        for ($apiidx=0; $apiidx < count($this->apikeys); $apiidx++) { 
            //Search: list
            $request_url = 'https://www.googleapis.com/youtube/v3/search?part=snippet&order=rating&type=video&videoCategoryId=20&maxResults=50&q='.$title.'&key='.$this->apikeys[$apiidx];
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
        if (array_key_exists('items', $respons)) {
        } else {
            //全api keyで検索してもエラー
            exit;
        }

        dd($respons);
        $kind = $respons->kind;
        try {
            $nextPageToken = $respons->nextPageToken;
        } catch (\Exception $e) {
            $nextPageToken = '';
        }
        try {
            $prevPageToken = $respons->prevPageToken;
        } catch (\Exception $e) {
            $prevPageToken = '';
        }
        $gameitems = $respons->items;
        //dd($gameitems);
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
