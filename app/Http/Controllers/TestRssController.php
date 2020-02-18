<?php

namespace App\Http\Controllers;

use App\Category;
use App\Flow;
use Illuminate\Http\Request;
use SimpleXMLElement;

class TestRssController extends Controller
{
    public function index()
    {
    }

    public function getMyJson($id) //en utilisant SimpleXML
    {
        $flow = Flow::findOrFail($id);
        $xml = $flow->url;

//        $xmlDoc = new \DOMDocument();
//        $xmlDoc->load($xml);

//        $channel=new \SimpleXMLElement($xmlDoc);
//	$xml = str_replace("content:encoded&gt;","content&gt;",$xml);
//	$xmlFlow = simplexml_load_string($xml);
//	$item = $xml-&gt;channel;
//
//	foreach($item-&gt;item AS $art)
//	{
//        $content = $art-&gt;content;
//		echo $content;
//	}


        $xmlFlow = new SimpleXMLElement($xml, null, true);


// Get the name of the cars element
        echo $xmlFlow->getName() . "<br>";

// Also print out the names of the children of the  element
        foreach ($xmlFlow->children() as $child) {
            echo "<b>" . $child->getName() . "</b><br>";
            foreach ($child->children() as $subchild) {
                echo $subchild->getName() . "<br>";
                foreach ($subchild->children() as $subsubchild) {
                    echo $subsubchild->getName() . "<br>";
                }
            }
        }


        dd($xmlFlow);
    }

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
//            $channel_link = $channel->getElementsByTagName('link')
//                ->item(0)->childNodes->item(0)->nodeValue;
            $channel_desc="";
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
//                "channel_link" => $channel_link,
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

