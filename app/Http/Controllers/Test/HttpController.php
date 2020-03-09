<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use GuzzleHttp\Client;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;

class HttpController extends Controller
{

    public function __construct(Client $client)
    {
        $this->client = new Client(HttpClient::create(['timeout' => 120]));
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

        // 熱門新聞
        $crawler = $this->client->request('GET', $this->urlDailyView . '/HotArticle/HotNews');

        $hotNews = $crawler->filter('div.container > div.col-md-12 > div.rank > .most_feedback > div.item > div.box')->each(function ($node, $index) {
            if ($index < 6) {
                return [
                    'title' => $node->filter('a > div.text > p')->text(),
                    'from' => $node->filter('a > div.number > h6')->text(),
                    'count' => $node->filter('a > div.number > span > p')->text(),
                    'href' => $node->filter('a')->attr('href'),
                    'img' => $node->filter('a > div.photo > img')->attr('src')
                ];
            }
        });
        $hotNews = array_splice($hotNews, 0, 6);

        // 輪播圖
        $crawler = $this->client->request('GET', $this->urlDailyView);

        $banners = $crawler->filter('.home_banner > .row > .col-md-8 > .carousel > .carousel-inner > .item')->each(function ($node, $index) {
            return [
                'title' => $node->filter('a > div.slider_img_bg_txt_new > h4')->text(),
                'img' => $node->filter('a > img')->attr('src'),
                'date' => $node->filter('a > div.slider_img_bg_txt_new > .slider_img_bg_date_new > h5')->text(),
                'count' => $node->filter('a > div.slider_img_bg_txt_new > .slider_img_bg_date_new > p > .random_num')->text(),
                'href' => $this->urlDailyView . $node->filter('a')->attr('href')
            ];
        });


        return view('test.http.index', compact('news', 'hotNews', 'banners'));
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
            if ($index < 6) {
                return [
                    'title' => $node->filter('a > div.text > p')->text(),
                    'from' => $node->filter('a > div.number > h6')->text(),
                    'count' => $node->filter('a > div.number > span > p')->text(),
                    'href' => $node->filter('a')->attr('href')
                ];
            }
        });
        $getHotNews = array_splice($getHotNews, 0, 6);


        return response()->json(['yahooHot' => $yahooHotSearch, 'netFamous' => $getNetFamous, 'hotNews' => $getHotNews]);
    }

    public function testSubmit(Request $request)
    {
//        dd($request->all());

        $crawler = $this->client->request('GET', 'https://www.railway.gov.tw/tra-tip-web/tip/tip001/tip112/querybytime');
        $form = $crawler->selectButton('查詢')->form();

        $crawler = $this->client->submit($form, [
            'startStation' => '3300-臺中',
            'endStation' => '1000-臺北',
            'rideDate' => '2020/03/09',
            'startTime' => '00:00',
            'endTime' => '23:59',
            'trainTypeList' => 'ALL',
            'transfer' => 'ONE'
        ]);
//        $url = $this->client->getHistory()->current()->getUri();
        $crawler->filter('#pageContent > div > table > tbody > tr.trip-column')->each(function ($node) {
            print_r($node->text() . '<br>');
        });

    }
}
