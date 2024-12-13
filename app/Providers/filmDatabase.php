<?php


namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class filmDatabase extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('tmdb', function ($app) {
            $client = new Client();
            $apiKey = env('TMDB_API_KEY'); 

            return new class($client, $apiKey) {
                protected $client;
                protected $apiKey;

                public function __construct($client, $apiKey)
                {
                    $this->client = $client;
                    $this->apiKey = $apiKey;
                }

                /**
                 * Search for movies by name.
                 */
                public function searchMovies($query)
                {
                    $response = $this->client->get('https://api.themoviedb.org/3/search/movie', [
                        'query' => [
                            'api_key' => $this->apiKey,
                            'query' => $query,
                            'language' => 'en-US',
                            'page' => 1
                        ]
                    ]);

                    return json_decode($response->getBody()->getContents(), true);
                }
            };
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

