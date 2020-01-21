<?php

namespace App\Http\Controllers;

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

    public function getJson($id)
    {
        $flow = Flow::findOrFail($id);
        $xml = $flow->url;
//        $xml=("http://news.google.com/news?ned=us&topic=h&output=rss");
        //
//find out which feed was selected


        $news = [];
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
            array_push($news, [
                "channel_title" => $channel_title,
                "channel_link" => $channel_link,
                "channel_description" => $channel_desc]);


            // les articles et informations contenus dans le flux
            $x = $xmlDoc->getElementsByTagName('item');
            for ($i = 0; $i <= 4; $i++) {
                $item_title = $x->item($i)->getElementsByTagName('title')
                    ->item(0)->childNodes->item(0)->nodeValue;
                $item_link = $x->item($i)->getElementsByTagName('link')
                    ->item(0)->childNodes->item(0)->nodeValue;
                $item_desc = $x->item($i)->getElementsByTagName('description')
                    ->item(0)->childNodes->item(0)->nodeValue;
                array_push($news, [
                    "article_title" => $item_title,
                    "article_link" => $item_link,
                    "article_description" => $item_desc
                ]);
            }
        }


        return response()->json($news);
    }
}
//        return view('testrss');
//

