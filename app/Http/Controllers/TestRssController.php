<?php

namespace App\Http\Controllers;

use App\Category;
use App\Flow;
use Illuminate\Http\Request;

class TestRssController extends Controller
{
    public function index()
    {
//        $q=$_GET["q"];
//
////find out which feed was selected
//        if($q=="1") {
//            $xml=("http://news.google.com/news?ned=us&topic=h&output=rss");
//        } elseif($q=="2") {
//            $xml=("https://www.zdnet.com/news/rss.xml");
//        } elseif($q=="3"){
//            $xml=("https://petitlutinartiste.fr/feed/rss/tag/draw-this-again");
//        }
//        $news=[];
//        $xmlDoc = new DOMDocument();
//        $xmlDoc->load($xml);
//        $channels=$xmlDoc->getElementsByTagName('channel');
//        foreach ($channels as $channel){
//            $channel_title = $channel->getElementsByTagName('title')
//                ->item(0)->childNodes->item(0)->nodeValue;
//            $channel_link = $channel->getElementsByTagName('link')
//                ->item(0)->childNodes->item(0)->nodeValue;
//            $channel_desc = $channel->getElementsByTagName('description')
//                ->item(0)->childNodes->item(0)->nodeValue;
//            array_push($news, [
//                // "category"=>$channel_cat, categorie
//                "title"=>$channel_title,
//                "link"=>$channel_link,
//                "description"=>$channel_desc
//            ]);
//        }
//        echo json_encode($news);
//        return view('testrss');
    }

//    public function getAllJson()
//    {
//        $categories = Category::orderBy('name')->get();
//        foreach ($categories as $category) {
//            $category->flows;
//            foreach ($category->flows as $category->flow) {
//                $xml = $category->flow->url;
//
////        $xml = $flow->url;
//
//                $news = []; //flux
//                $xmlDoc = new \DOMDocument();
//                $xmlDoc->load($xml);
//                // les informations sur le flux
//                $channels = $xmlDoc->getElementsByTagName('channel');
//                foreach ($channels as $channel) {
//                    $channel_title = $channel->getElementsByTagName('title')
//                        ->item(0)->childNodes->item(0)->nodeValue;
//                    $channel_link = $channel->getElementsByTagName('link')
//                        ->item(0)->childNodes->item(0)->nodeValue;
//                    $channel_desc = $channel->getElementsByTagName('description')
//                        ->item(0)->childNodes->item(0)->nodeValue;
//
//
//                    // les articles et informations contenus dans le flux
//                    $articles = [];
//
//                    $x = $xmlDoc->getElementsByTagName('item');
//                    for ($i = 0; $i <= 4; $i++) {
//                        $item_title = $x->item($i)->getElementsByTagName('title')
//                            ->item(0)->childNodes->item(0)->nodeValue;
//                        $item_link = $x->item($i)->getElementsByTagName('link')
//                            ->item(0)->childNodes->item(0)->nodeValue;
//                        $item_date = $x->item($i)->getElementsByTagName('pubDate')
//                            ->item(0)->childNodes->item(0)->nodeValue;
//                        $item_desc = $x->item($i)->getElementsByTagName('description')
//                            ->item(0)->childNodes->item(0)->nodeValue;
//                        array_push($articles, [
//                            "article_title" => $item_title,
//                            "article_link" => $item_link,
//                            "article_description" => $item_desc,
//                            "article_date" => $item_date
//                        ]);
//                    }
//                    // un flux et ses articles
//                    array_push($news, [
//                        "channel_title" => $channel_title,
//                        "channel_link" => $channel_link,
//                        "channel_description" => $channel_desc,
//                        "news" => $articles
//                    ]);
////            array_push($news, [
////            $news["channel_title"] = $channel_title;
////            $news["channel_link"] = $channel_link;
////            $news["channel_description"] = $channel_desc;
////            $news["news"] = $articles;
//
//                }
//                return view('getjson')
////            ->withFlows($flows)
//                    ->withCategories($categories)
//                    ->withJsonCategories(json_encode($categories))
//                    ->withResponse(json($news));
//            }
//        }
//    }

    public
    function getJson($id)
    {
        $flow = Flow::findOrFail($id);
//        $category_id = $flow->category;
//        $categories = Category::orderBy('name')->get();
//        foreach ($categories as $category) {
//            $category_name = $category->name;
//        }
        $xml = $flow->url;

        $flowInfo = []; //flux
        $xmlDoc = new \DOMDocument();
        $xmlDoc->load($xml);
        // les informations sur le flux
        $channels = $xmlDoc->getElementsByTagName('channel');
        foreach ($channels as $channel) {
            $channel_title = $channel->getElementsByTagName('title')
                ->item(0)->childNodes->item(0)->nodeValue;
            $channel_link = $channel->getElementsByTagName('link')
                ->item(0)->childNodes->item(0)->nodeValue;
            $channel_desc = $channel->getElementsByTagName('description')
                ->item(0)->childNodes->item(0)->nodeValue;


            // les articles du flux
            $articles = [];

            $x = $xmlDoc->getElementsByTagName('item');
            for ($i = 0; $i < $x->length; $i++) { //toutes les news
                $item_title = $x->item($i)->getElementsByTagName('title')
                    ->item(0)->childNodes->item(0)->nodeValue;
                $item_link = $x->item($i)->getElementsByTagName('link')
                    ->item(0)->childNodes->item(0)->nodeValue;
                $item_date = $x->item($i)->getElementsByTagName('pubDate')
                    ->item(0)->childNodes->item(0)->nodeValue;
                $item_desc = $x->item($i)->getElementsByTagName('description')
                    ->item(0)->childNodes->item(0)->nodeValue;
                array_push($articles, [
                    "article_title" => $item_title,
                    "article_link" => $item_link,
                    "article_description" => $item_desc,
                    "article_date" => $item_date
                ]);
            }
            // un flux et ses articles
            array_push($flowInfo, [
                "channel_title" => $channel_title,
                "channel_link" => $channel_link,
                "channel_description" => $channel_desc,
                "news" => $articles
            ]);

//            foreach ($categories as $category) {
//                array_push($category, [
//                        "category_name" => $category_name,
//                        "category_id" => $category_id,
//                        [
//                            "flowInfo" => $flowInfo
//                        ]
//                    ]
//                );
//            };
//            array_push($news, [
//            $news["channel_title"] = $channel_title;
//            $news["channel_link"] = $channel_link;
//            $news["channel_description"] = $channel_desc;
//            $news["news"] = $articles;

        }


        return response()->json($articles);
    }
}
//        return view('testrss');
//

