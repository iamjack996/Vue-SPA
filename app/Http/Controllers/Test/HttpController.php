<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use GuzzleHttp\Client;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
use function Sodium\compare;

class HttpController extends Controller
{

    public function __construct(Client $client)
    {
        $this->client = new Client(HttpClient::create(['timeout' => 60]));
        $this->urlDailyView = 'https://dailyview.tw';
    }


    public function index()
    {
        $crawler = $this->client->request('GET', $this->urlDailyView . '/History?popular=False&cate=news');

        // 時事
        $news = $crawler->filter('#history_body > .history-left-block')->each(function ($node, $index) {
            if ($index < 6) {
                $postHref = $node->filter('a')->attr('href');
                $array = explode('/', $postHref);
                $array = array_splice($array, 2);
                $date = implode('/', $array);
                return [
                    'title' => $node->filter('.history-left-mid > div > a.black')->text(),
                    'date' => $date,
                    'count' => $node->filter('.history-left-bootom > .event-temp > span.redword > span.bigword')->text(),
                    'href' => $this->urlDailyView . $postHref,
                    'img' => $node->filter('a > img')->attr('src')
                ];
            }
        });
        $news = array_splice($news, 0, 6);


        // div.render-target-active > div.TW > div:nth-child(2) > div#YDC-Col1 > div#Main
        // > #mrt-node-Col1-2-StreamContainer > ul#stream-container-scroll-template > li.StreamMegaItem
        //div:nth-child(3) :nth-last-child(2)
//        $getHotNews = $crawler->filter('div.render-target-active > div.TW > div:nth-last-child(2)')->each(function ($node) {
//            print_r($node->text() . '<br>');
////            return [
////                'name' => $node->filter('.right-wrapper > .flexbox > h3 > span')->text(),
////                'sound' => $node->filter('.right-wrapper > .volume-rank-info-container > .sound > .info > span')->text(),
////            ];
//        });

        // 熱門新聞
//        $crawler = $this->client->request('GET', $this->urlDailyView . '/HotArticle/HotNews');
//
//        $getHotNews = $crawler->filter('div.container > div.col-md-12 > div.rank > .most_feedback > div.item > div.box')->each(function ($node, $index) {
//            if ($index < 10) {
//                print_r($node->text() . '<br>');
//                return [
//                    'title' => $node->filter('a > div.text > p')->text(),
//                    'from' => $node->filter('a > div.number > h6')->text(),
//                    'count' => $node->filter('a > div.number > span > p')->text(),
//                    'href' => $node->filter('a')->attr('href')
//                ];
//            }
//        });
//
//        dd($getHotNews);


        return view('test.http.index', compact('news'));
    }

    public function getHttpIndexData(Request $request)
    {
        // Yahoo十大熱門搜尋
        $crawler = $this->client->request('GET', 'https://tw.search.yahoo.com/search?p=1231VEAGeaaww2&fr=yfp-search-tn&fr2=fp-hotsearch');

        $getYahooHotSearchTen = $crawler->filter('.trendingNow > div.compList > ul')->each(function ($node) {
            return $node->filter('ul.d-ib > li')->each(function ($node) {
                return ['text' => $node->filter('span')->attr('title')];
            });
        });
        $yahooHotSearch = array_merge($getYahooHotSearchTen[0], $getYahooHotSearchTen[1]);

        // 網紅排名
        $crawler = $this->client->request('GET', $this->urlDailyView . '/top100/topic/112');

        $getNetFamous = $crawler->filter('.t100 > .col-md-8 > .topic-rank-group-container > .volume-ranks-container > a')->each(function ($node) {
            return [
                'name' => $node->filter('.right-wrapper > .flexbox > h3 > span')->text(),
                'sound' => $node->filter('.right-wrapper > .volume-rank-info-container > .sound > .info > span')->text(),
            ];
        });

        // 熱門新聞
        $crawler = $this->client->request('GET', $this->urlDailyView . '/HotArticle/HotNews');

        $getHotNews = $crawler->filter('div.container > div.col-md-12 > div.rank > .most_feedback > div.item > div.box')->each(function ($node, $index) {
            if ($index < 10) {
                return [
                    'title' => $node->filter('a > div.text > p')->text(),
                    'from' => $node->filter('a > div.number > h6')->text(),
                    'count' => $node->filter('a > div.number > span > p')->text(),
                    'href' => $node->filter('a')->attr('href')
                ];
            }
        });
        $getHotNews = array_splice($getHotNews, 0, 10);

        return response()->json(['yahooHot' => $yahooHotSearch, 'netFamous' => $getNetFamous, 'hotNews' => $getHotNews]);
    }
}
