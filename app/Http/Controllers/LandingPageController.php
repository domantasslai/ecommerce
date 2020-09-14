<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use \TCG\Voyager\Models\Post;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('featured', true)->take(8)->inRandomOrder()->get();

        $posts = Post::take(3)->inRandomOrder()->get();
        // dd($posts);
        return view('landing-page', compact('products', 'posts'));
    }
}
