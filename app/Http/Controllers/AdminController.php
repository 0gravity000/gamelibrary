<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use App\Game;
use App\Platform;
use App\GametitleAliase;
use App\Maker;
use App\MobileGame;
use App\MobiletitleAliase;

class AdminController extends Controller
{

    public function download()
    {
        //
        $client = new Client();

        //TVゲーム	売れ筋ランキング	プレイステーション5	ゲームソフト p1
        $url[0] = 'https://www.amazon.co.jp/gp/bestsellers/videogames/8019286051/ref=zg_bs_nav_vg_2_8019279051';
        //TVゲーム	売れ筋ランキング	プレイステーション5	ゲームソフト p2
        $url[1] = 'https://www.amazon.co.jp/gp/bestsellers/videogames/8019286051/ref=zg_bs_pg_2?ie=UTF8&pg=2';
        //TVゲーム	売れ筋ランキング	プレイステーション4	ゲームソフト p1
        $url[2] = 'https://www.amazon.co.jp/gp/bestsellers/videogames/2494235051/ref=zg_bs_nav_vg_2_2494234051';
        //TVゲーム	売れ筋ランキング	プレイステーション4	ゲームソフト p2
        $url[3] = 'https://www.amazon.co.jp/gp/bestsellers/videogames/2494235051/ref=zg_bs_pg_2?ie=UTF8&pg=2';
        //TVゲーム	売れ筋ランキング	Nintendo Switch	ゲームソフト p1
        $url[4] = 'https://www.amazon.co.jp/gp/bestsellers/videogames/4731378051/ref=zg_bs_nav_vg_2_4731377051';
        //TVゲーム	売れ筋ランキング	Nintendo Switch	ゲームソフト p2
        $url[5] = 'https://www.amazon.co.jp/gp/bestsellers/videogames/4731378051/ref=zg_bs_pg_2?ie=UTF8&pg=2';

        $index = 0;
        for ($index=0; $index < 6; $index++) { 
            $crawler = $client->request('GET', $url[$index]);
            //dd($crawler);

            //#zg-ordered-list
            //#zg-ordered-list > li:nth-child(1)
            //#zg-ordered-list > li:nth-child(51)
            //title：#zg-ordered-list > li:nth-child(1) > span > div > span > a > div
            $title_lists[$index] = $crawler->filter('#zg-ordered-list > li')->each(function ($node) {
                return $node->filter('span > div > span > a > div')->text();
            });
            /*
            $title_lists[$index] = $crawler->filter('#zg-ordered-list > li')->each(function ($node) {
                return $node->text();
            });
            */
            //dd($title_lists[$index]);
            foreach ($title_lists[$index] as $title) {
                if (Game::where('title_original', $title)->doesntExist()) {
                    $game = new Game;
                    $game->title_original = $title;
                    switch ($index) {
                        case 0:
                        case 1:
                            //PlayStation 5
                            $game->platform_id = Platform::where('name', "PlayStation 5")->first()->id; 
                            break;
                        case 2:
                        case 3:
                            //PlayStation 4
                            $game->platform_id = Platform::where('name', "PlayStation 4")->first()->id; 
                            break;
                        case 4:
                        case 5:
                             //Nintendo Switch
                             $game->platform_id = Platform::where('name', "Nintendo Switch")->first()->id; 
                             break;
                        default:
                            $game->platform_id = '';
                            break;
                    }
                    //dd($game);
                    $game->save();
                }
            }
        }
        //dd($ordered_lists);
        return redirect('/admin');
    }

    public function download_android()
    {
        //
        $client = new Client();

        //Google Player ランキング ＞ 売上トップのゲーム
        //50件分のデータが取得できる
        $url = 'https://play.google.com/store/apps/collection/cluster?clp=0g4YChYKEHRvcGdyb3NzaW5nX0dBTUUQBxgD:S:ANO1ljLhYwQ&gsr=ChvSDhgKFgoQdG9wZ3Jvc3NpbmdfR0FNRRAHGAM%3D:S:ANO1ljIKta8&hl=ja';

        $crawler = $client->request('GET', $url);
        //dd($crawler);

        //タイトル
        #fcxH9b > div.WpDbMd > c-wiz:nth-child(4) > div > c-wiz > div > c-wiz > c-wiz > c-wiz > div > div.ZmHEEd > div:nth-child(1) > c-wiz > div > div > div.RZEgze > div > div > div.bQVA0c > div > div > div.b8cIId.ReQCgd.Q9MA7b > a > div

        #fcxH9b > div.WpDbMd > c-wiz:nth-child(4) > div > c-wiz > div > c-wiz > c-wiz > c-wiz > div > div.ZmHEEd > div:nth-child(2) > c-wiz > div > div > div.RZEgze > div > div > div.bQVA0c > div > div > div.b8cIId.ReQCgd.Q9MA7b > a > div
        $title_lists = $crawler->filter('#fcxH9b div.b8cIId.ReQCgd.Q9MA7b > a > div')->each(function ($node) {
            return $node->text();
        });
        //dd($title_lists);

        //メーカー
        #fcxH9b > div.WpDbMd > c-wiz.zQTmif.SSPGKf.I3xX3c.oCHqfe.BIIBbc > div > c-wiz > div > div > c-wiz > c-wiz:nth-child(4) > c-wiz > div > div.ZmHEEd.fLyRuc > div:nth-child(1) > c-wiz > div > div > div.RZEgze > div > div > div.bQVA0c > div > div > div.b8cIId.ReQCgd.KoLSrc > a > div
        $maker_lists = $crawler->filter('#fcxH9b div.b8cIId.ReQCgd.KoLSrc > a > div')->each(function ($node) {
            return $node->text();
        });
        //dd($maker_lists);

        //説明
        #fcxH9b > div.WpDbMd > c-wiz.zQTmif.SSPGKf.I3xX3c.oCHqfe.BIIBbc > div > c-wiz > div > div > c-wiz > c-wiz:nth-child(4) > c-wiz > div > div.ZmHEEd.fLyRuc > div:nth-child(1) > c-wiz > div > div > div.RZEgze > div > div > div.bQVA0c > div > div > div.b8cIId.f5NCO > a
        $discription_lists = $crawler->filter('#fcxH9b div.b8cIId.f5NCO > a')->each(function ($node) {
            return $node->text();
        });
        //dd($discription_lists);

        for ($idx=0; $idx < count($title_lists); $idx++) { 
            if (MobileGame::where('title', $title_lists[$idx])->doesntExist()) {
                $mobilegame = new MobileGame;
                $mobilegame->title = $title_lists[$idx];
                $mobilegame->platform_id = Platform::where('name', "Android")->first()->id;
                if (Maker::where('name', $maker_lists[$idx])->doesntExist()) {
                    $maker = new Maker;
                    $maker->name = $maker_lists[$idx];
                    $maker->save();
                }
                $mobilegame->maker_id = Maker::where('name', $maker_lists[$idx])->first()->id;
                $mobilegame->description = $discription_lists[$idx];

                //dd($mobilegame);
                $mobilegame->save();
            }
        }
        //dd($mobilegame);
        return redirect('/admin');
    }

    public function platform()
    {
        $platforms = Platform::all();
        return view('platform', compact('platforms'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $games = Game::all();
        return view('gametitle', compact('games'));
    }

    public function create_android()
    {
        //
        $games = MobileGame::all();
        return view('gametitle_android', compact('games'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_platform($id)
    {
        //
        if ($id== 0) {
            $platform = new Platform;
            $platform->name = rand();
            $platform->save();

            $platform = Platform::orderBy('id', 'desc')->first();
            $platform->name = "new platform" . $platform->id;
            $platform->save();
            //dd($platform);
        } else{
            $platform = Platform::where('id', $id)->first();
            //dd($platform);
        }
 
        return view('platform_update', compact('platform'));
    }

    public function show_game($id)
    {
        //
        $game = Game::where('id', $id)->first();
        //dd($platform);
 
        return view('game_update', compact('game'));
    }

    public function show_game_android($id)
    {
        //
        $game = MobileGame::where('id', $id)->first();
        //dd($platform);
 
        return view('game_update_android', compact('game'));
    }

    public function show_gamealias($id)
    {
        //
        $gametitlealiase = GametitleAliase::where('id', $id)->first();
        //dd($gametitlealiase);
 
        return view('gamealias_update', compact('gametitlealiase'));
    }

    public function show_gamealias_android($id)
    {
        //
        $gametitlealiase = MobiletitleAliase::where('id', $id)->first();
        //dd($gametitlealiase);
 
        return view('gamealias_update_android', compact('gametitlealiase'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
        $gametitlealiases = GametitleAliase::all();
        //dd($gametitlealiases);
        return view('gametitlealias', compact('gametitlealiases'));
    }

    public function edit_android()
    {
        //
        $gametitlealiases = MobiletitleAliase::all();
        //dd($gametitlealiases);
        return view('gametitlealias_android', compact('gametitlealiases'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_platform(Request $request)
    {
        //
        $platform = Platform::where('id', $request->InputId)->first();
        $platform->name = $request->InputName;
        $platform->save();

        return redirect('/admin/platform');
    }

    public function update_game(Request $request)
    {
        //
        //dd($request);
        //バリデーションチェック
        $validatedData = $request->validate([
            'InputTitle' => ['unique:gametitle_aliases,title']
        ]);

        $gametitlealiase = new GametitleAliase;
        $gametitlealiase->title = $request->InputTitle;
        $gametitlealiase->game_id = $request->InputId;
        $gametitlealiase->save();

        return redirect('/admin/create');
    }

    public function update_game_android(Request $request)
    {
        //
        //dd($request);
        //バリデーションチェック
        $validatedData = $request->validate([
            'InputTitle' => ['unique:mobiletitle_aliases,title']
        ]);

        $gametitlealiase = new MobiletitleAliase;
        $gametitlealiase->title = $request->InputTitle;
        $gametitlealiase->mobile_game_id = $request->InputId;
        $gametitlealiase->save();

        return redirect('/admin/create_android');
    }

    public function update_gamealias(Request $request)
    {
        //
        $gametitlealiase = GametitleAliase::where('id', $request->InputId)->first();
        //dd($gametitlealiase);
        $gametitlealiase->title = $request->InputTitle;
        $gametitlealiase->save();

        return redirect('/admin/edit');
    }

    public function update_gamealias_android(Request $request)
    {
        //
        $gametitlealiase = MobiletitleAliase::where('id', $request->InputId)->first();
        //dd($gametitlealiase);
        $gametitlealiase->title = $request->InputTitle;
        $gametitlealiase->save();

        return redirect('/admin/edit_android');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
