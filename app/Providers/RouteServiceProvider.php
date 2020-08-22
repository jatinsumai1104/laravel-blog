<?php

namespace App\Providers;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use function Psy\bin;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();

//        Route::bind('blog', function($encryptedBlogId){
//            try{
//                $decryptedBlogId = decrypt($encryptedBlogId);
//            }catch (DecryptException $e){
//                Log::info("Error Generated While Descrypting blog id");
//                dd("Error!");
//            }
//            return \App\Blog::where('id', $decryptedBlogId)->first();
//        });
//
//        Route::bind('user', function($encryptedUserId){
//            try{
//                $decryptedUserId = decrypt($encryptedUserId);
//            }catch (DecryptException $e){
////                \App\Log::info("Error Generated While Descrypting blog id");
//                dd("Error!");
//            }
//            return \App\User::where('id', $decryptedUserId)->first();
//        });
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
