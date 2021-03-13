<?php

namespace App\Listeners;

use App\Events\DailyCheckGameTitle;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Goutte\Client;
use App\Game;
use App\Platform;
use App\Maker;
use App\MobileGame;

class StoreGameInfotoDB
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  DailyCheckGameTitle  $event
     * @return void
     */
    public function handle(DailyCheckGameTitle $event)
    {
        //TVゲーム情報のダウンロード
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

        //モバイルゲーム情報のダウンロード
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

    }

}
