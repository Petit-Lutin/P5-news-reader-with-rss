<?php

use App\Category;
use Illuminate\Database\Seeder;

class FirstFlowsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo 'flow';
        \App\Flow::create(['name' => 'Google', 'url' => 'http://news.google.com/news?ned=us&topic=h&output=rss', 'category_id' => '1']);
    }
}

