<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use GuzzleHttp\Client;
use Goutte\Client;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpClient\HttpClient;

class HttpController extends Controller
{

    public function __construct(Client $client)
    {
        $this->client = new Client(HttpClient::create(['timeout' => 120]));
        $this->urlDailyView = 'https://dailyview.tw';
    }

    public function test()
    {
        Log::info('Get to test~~~~');
        $array = ['a' => [0, 2, 4],
            'b' => [2, 5],
            'c' => [1, 3, 4]];

        return response()->json(['res' => true, 'data' => $array]);
    }

    public function index()
    {
        // 時事
        $crawler = $this->client->request('GET', $this->urlDailyView . '/History?popular=False&cate=news');
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

        // Today看世界
        $crawler = $this->client->request('GET', 'https://today.line.me/tw/v2/page/5ea798c4d8825541ac250c6a');

        $todayVideos = $crawler->filter('.listModule > .articleCard')->each(function ($node, $index) {
            return [
                'url' => $node->filter('a')->attr('href'),
                'title' => str_replace("【TODAY 看世界】", "", $node->filter('a > div.articleCard-content > h2')->text()),
//                'img' => $node->filter('a > div.articleCard-imageWrap')->html()
            ];
        });

        return view('test.http.index', compact('news', 'hotNews', 'banners', 'todayVideos'));
    }

    public function getHttpIndexData(Request $request)
    {
        // Yahoo十大熱門搜尋
        $crawler = $this->client->request('GET', 'https://tw.search.yahoo.com/search?p=1231VEAGeaaww2&fr=yfp-search-tn&fr2=fp-hotsearch');

        $getYahooHotSearchTen = $crawler->filter('.trendingNow > div.compList > ul')->each(function ($node) {
            return $node->filter('ul.d-ib > li')->each(function ($node) {
                return [
                    'text' => $node->filter('span')->attr('title'),
                    'href' => 'https://tw.search.yahoo.com/search?p=' . $node->filter('span')->attr('title') . '&fr=yfp-search-tn&fr2=fp-hotsearch'
                ];
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

        // 分頁新聞
        $crawler = $this->client->request('GET', 'https://tw.yahoo.com/');

        $tabs = $crawler->filter('.Bxz-bb > #Main > #applet_p_1468442 > .App-Bd > div > div > div > ul.Tabs > li')->each(function ($node, $index) {
            return ['title' => $node->text()];
        });

        $pageNews = $crawler->filter('.Bxz-bb > #Main > #applet_p_1468442 > .App-Bd > div > div > div > div.Story-Items > div.Mt-0')->each(function ($node, $indexTab) {
            return $node->filter('div.today > div > div > div')->each(function ($node, $lRIndex) use ($indexTab) {
                return $node->filter('ul > li')->each(function ($node, $index) use ($lRIndex, $indexTab) {
                    if ($lRIndex < 1) {
                        if ($index > 0) {
                            if ($indexTab > 0) {
                                $getImg = $node->filter('div.W-100 > a > img')->attr('style');
                                $getImg = explode("background-image:url('", $getImg);
                                $getImg = explode("')", $getImg[1])[0];
                            } else {
                                $getImg = $node->filter('div.W-100 > a > img')->attr('src');
                            }
                            return [
                                'title' => $node->filter('div.MouseOver > a')->text(),
                                'href' => $node->filter('div.W-100 > a')->attr('href'),
                                'img' => $getImg,
                                'desc' => null
                            ];
                        } else {
                            if ($indexTab > 0) {
                                $getImg = $node->filter('div.W-100 > a > img')->attr('style');
                                $getImg = explode("background-image:url('", $getImg);
                                $getImg = explode("')", $getImg[1])[0];
                            } else {
                                $getImg = $node->filter('div > div.W-100 > a > img')->attr('src');
                            }
                            return [
                                'title' => $node->filter('div > a > div > p')->text(),
                                'href' => $node->filter('div.Bgc-w > a')->attr('href'),
                                'img' => $getImg,
                                'desc' => null
                            ];
                        }
                    } else {
                        return [
                            'title' => $node->filter('div.Bgc-w > span > a > span')->text(),
                            'href' => $node->filter('div.Bgc-w > span > a')->attr('href'),
                            'img' => null,
                            'desc' => $node->filter('div.Bgc-w > span > p > span')->text()
                        ];
                    }
                });
            });
        });


        return response()->json(['yahooHot' => $yahooHotSearch, 'netFamous' => $getNetFamous, 'hotNews' => $getHotNews, 'tabs' => $tabs, 'pageNews' => $pageNews]);
    }

    public function getCityData(Request $request)
    {
        $search = $request->input('search');

        $crawler = $this->client->request('GET', 'https://www.railway.gov.tw/tra-tip-web/tip/tip001/tip111/view');

        $array = $cityList = [];
        $crawler->filter('#content > .traincode_all')->each(function ($node) use (&$array, $search) {
            return $node->filter('.traincode_cen > .traincode_main > .traincode_name1')->each(function ($node) use (&$array, $search) {
                if ($search) {
//                    if($node->text() === '百福') dd(strpos($node->text(), $search));
                    if (strpos($node->text(), $search) !== false) {
                        array_push($array, $node->text());
                    }
                } else {
                    array_push($array, $node->text());
                }
            });
        });

        foreach ($array as $key => $value) {
            $city = new \stdClass();
            $city->id = $key + 1;
            $city->text = $value;
            $cityList[$key] = $city;
        }
        return response()->json(['results' => $cityList]);
    }

    public function testSubmit(Request $request)
    {
//        dd($request->all());
        $from = $request->input('from');
        $to = $request->input('to');
        $date = $request->input('date');

        print_r($from . ' => ' . $to . '; 日期：' . $date);

        // 解析站名
        $crawler = $this->client->request('GET', 'https://www.railway.gov.tw/tra-tip-web/tip/tip001/tip111/view');

        $findFrom = $findTo = [];
        $crawler->filter('#content > .traincode_all')->each(function ($node) use ($from, $to, &$findFrom, &$findTo) {
            if (!(count($findFrom) > 1 && count($findTo) > 1)) {
                return $node->filter('.traincode_cen > .traincode_main > div')->each(function ($node) use ($from, $to, &$findFrom, &$findTo) {
                    if (!(count($findFrom) > 1 && count($findTo) > 1)) {
                        if (count($findFrom) > 0 && count($findFrom) < 2) {
                            array_push($findFrom, $node->text());
                        }
                        if ($from == $node->text()) {
                            array_push($findFrom, $from);
                        }

                        if (count($findTo) > 0 && count($findTo) < 2) {
                            array_push($findTo, $node->text());
                        }
                        if ($to == $node->text()) {
                            array_push($findTo, $to);
                        }
                    }
                });
            }
        });

        $from = $findFrom[1] . '-' . $findFrom[0];
        $to = $findTo[1] . '-' . $findTo[0];

        $crawler = $this->client->request('GET', 'https://www.railway.gov.tw/tra-tip-web/tip/tip001/tip112/gobytime');

        $form = $crawler->selectButton('查詢')->form();

        $crawler = $this->client->submit($form, [
            'startStation' => $from,//'3300-臺中',
            'endStation' => $to,// '1000-臺北',
            'rideDate' => $date,//'2020/03/14',
            'startTime' => '00:00',
            'endTime' => '23:59',
            'trainTypeList' => 'ALL',
            'transfer' => 'ONE'
        ]);

//        $crawler->filter('#content > #errorDiv > p')->each(function ($node) {
//            print_r($node->html() . '<br>');
//        });

//        $url = $this->client->getHistory()->current()->getUri();
//        dd($url);

//        sleep(1); > div.search-trip > table > tbody > tr.trip-column
        $crawler->filter('#pageContent > div.search-trip > table > tbody > tr.trip-column')->each(function ($node) {
//            print_r(111 . '<br>');
            print_r($node->html() . '<br>');
        });

        dd('#');
    }
}
