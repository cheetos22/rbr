<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Post;
use App\Models\User;

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
            $postId = Post::select('post_id')->where('post_id' , $postData['id'])->first();
            //dd($postID);
            if ($postId === null) {
                Post::create([
                    'user_id' => $postData['userId'],
                    'post_id' => $postData['id'],
                    'title' => $postData['title'],
                    'body' => $postData['body'],
                ]
            );

            };
        };

        //synchronize usersData
        $usersResponse = Http::get('https://jsonplaceholder.typicode.com/users')->json();
        //dd($usersResponse);
        foreach ($usersResponse as $userData) {
            //dd($userData);
            $userId = User::select('user_id')->where('user_id' , $userData['id'])->first();
            //dd($postID);
            if ($userId === null) {
                User::create([
                    'user_id' => $userData['id'],
                    'name' => $userData['name'],
                    'user_name' => $userData['username'],
                    'email' => $userData['email'],
                    'company_bs' => $userData['company']['bs'],
                    'company_catchPhrase' =>  $userData['company']['catchPhrase'],
                    'company_name' =>  $userData['company']['name'],
                    'website' =>  $userData['website'],
                    'phone' =>  $userData['phone'],
                    'adress_geo_lng' =>  $userData['address']['geo']['lng'],
                    'adress_geo_lat' =>  $userData['address']['geo']['lat'],
                    'addres_zipcode' =>  $userData['address']['zipcode'],
                    'adress_city' =>  $userData['address']['city'],
                    'adress_suite' =>  $userData['address']['suite'],
                    'adress_street' =>  $userData['address']['street'],
                ]
            );

            };
        };

        dump('Succes');
    }
}
