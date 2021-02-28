<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;

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
        }
        //dd($ordered_lists);
        return view('gametitle', compact('title_lists'));
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
