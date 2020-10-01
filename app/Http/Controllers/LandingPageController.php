<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
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
        $categories = Category::all();
        $mostBuyableProducts = Product::leftJoin('order_product','products.id','=','order_product.product_id')
                 ->selectRaw('products.*, COALESCE(sum(order_product.quantity),0) total')
                 ->groupBy('products.id')
                 ->orderBy('total','desc')
                 ->take(4)
                 ->get();

        return view('landing-page', compact('products', 'posts', 'categories', 'mostBuyableProducts'));
    }
}
