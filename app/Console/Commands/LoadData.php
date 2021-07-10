<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Post;

class LoadData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:load';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load required outside data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //synchronize postData
        $postsResponse = Http::get('https://jsonplaceholder.typicode.com/posts')->json();

        foreach ($postsResponse as $postData) {
            //dd($postData['id']);
            $postID = Post::select('post_id')->where('post_id' , $postData['id'])->first();
            //dd($postID);
            if ($postID === null) {
                Post::create([
                    'user_id' => $postData['userId'],
                    'post_id' => $postData['id'],
                    'title' => $postData['title'],
                    'body' => $postData['body'],
                ]
            );

            };
        };
        dump('Succes');
    }
}
