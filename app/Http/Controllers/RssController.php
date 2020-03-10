<?php

namespace App\Http\Controllers;

use App\Category;
use App\Flow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RssController extends Controller
{
    public function index()
    {
    }

    public function getJson($id)
    {
        $user = Auth::user();
        $categories = $user->categoriesOrderBy;
        $flow = Flow::findOrFail($id);

        //todo:vérifier que Auth guest = false (tableau)
//todo:vérifier que le flux appartient bien à l'utilisateur connecté, remonter aux catégories et à l'utilisateur, Auth::user()->id
        $xml = $flow->url;

        // pour définir un user-agent
        $opts = array('http' => array('user_agent' => 'PHP libxml agent',));
        $context = stream_context_create($opts);
        libxml_set_streams_context($context);

        $flowInfo = []; //flux
        $xmlDoc = new \DOMDocument();
        $xmlDoc->load($xml);

        // les informations sur le flux
        $channels = $xmlDoc->getElementsByTagName('channel');
        foreach ($channels as $channel) {
            $channel_title = $channel->getElementsByTagName('title')
                ->item(0)->childNodes->item(0)->nodeValue;

            $channel_link = "";
            if ($channel->getElementsByTagName('link')
                    ->item(0)->childNodes->count() > 0) {
                $channel_link = $channel->getElementsByTagName('link')
                    ->item(0)->childNodes->item(0)->nodeValue;
            }

            $channel_desc = "";
            if ($channel->getElementsByTagName('description')
                    ->item(0)->childNodes->count() > 0) {
                $channel_desc = $channel->getElementsByTagName('description')
                    ->item(0)->childNodes->item(0)->nodeValue;
            }

            // les articles du flux
            $articles = [];

            $x = $xmlDoc->getElementsByTagName('item');
            for ($i = 0; $i < $x->length; $i++) { //toutes les news
                $item_title = $x->item($i)->getElementsByTagName('title')
                    ->item(0)->childNodes->item(0)->nodeValue;
                $item_link = $x->item($i)->getElementsByTagName('link')
                    ->item(0)->childNodes->item(0)->nodeValue;
                $date = $x->item($i)->getElementsByTagName('pubDate')
                    ->item(0)->childNodes->item(0)->nodeValue;


//                $item_date=\Carbon\Carbon::createFromFormat('Y-m-d H',$date);
                $date = \Carbon\Carbon::parse($date);
                $date->locale('fr_FR');
                $item_date = $date->isoFormat('LLLL');
//                $item_date = $item_date->format('l j F Y H:i:s');
//                dd($date, $item_date);
                $item_timestamp = $date->timestamp;
                $item_desc = "";
                if ($x->item($i)->getElementsByTagName('description')
                        ->item(0)->childNodes->count() > 0) {
                    $item_desc = $x->item($i)->getElementsByTagName('description')
                        ->item(0)->childNodes->item(0)->nodeValue;
                }

                array_push($articles, [
                    "article_title" => $item_title,
                    "article_link" => $item_link,
                    "article_description" => $item_desc,
                    "article_date" => $item_date,
                    "article_timestamp" => $item_timestamp
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

