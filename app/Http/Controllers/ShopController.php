<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Laravelista\Comments\Comment;
class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagination = 9;
        $categories = Category::all();
        if (request()->category) {
          $products = Product::with('categories')->whereHas('categories', function ($query){
            $query->where('slug', request()->category);
          });
          $categoryName = optional($categories->where('slug', request()->category)->first())->name;
        }else {
          $products = Product::with('onSale')->where('featured', true);
          $categoryName = 'Featured';
        }

        if (request()->sort == 'low_high') {
          $products = $products->orderBy('price')->paginate($pagination);
        }elseif (request()->sort == 'high_low') {
          $products = $products->orderBy('price', 'desc')->paginate($pagination);
        }else {
          $products = $products->paginate($pagination);
        }
        return view('shop', compact('products', 'categories', 'categoryName'));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
    */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->withCount('comments')->firstOrFail();
        $product->load('comments', 'onSale');
        $ratings = $product->comments->map(function ($item) {
            if ($item->rating) {
              return (int)$item->rating;
            }
        })->sum();

        $comments_count = $product->comments->pluck('rating')->filter()->count();

        if ($ratings > 0) {
          $ratings = round($ratings / $comments_count, 1);
        }

        $mightAlsoLike = Product::where('slug', '!=', $slug)->mightAlsoLike()->get();
        $stockLevel = getStockLevel($product->quantity);
        $categories = Category::all();
        return view('product', compact('product', 'mightAlsoLike', 'stockLevel', 'ratings', 'comments_count', 'categories'));
    }

    public function search(Request $request){

      $request->validate([
        'query' => 'required|min:3'
      ]);

      $query = $request->input('query');

      $products = Product::search($query)->paginate(10);

      return view('search-results', compact('products'));
    }

    public function searchAlgolia(Request $request){

      return view('search-results-algolia');
    }

    public function mostBuyable(){
      $mostBuyable = Product::leftJoin('order_product','products.id','=','order_product.product_id')
               ->selectRaw('products.*, COALESCE(sum(order_product.quantity),0) total')
               ->groupBy('products.id')
               ->orderBy('total','desc')
               ->take(10)
               ->get();
    }
}
