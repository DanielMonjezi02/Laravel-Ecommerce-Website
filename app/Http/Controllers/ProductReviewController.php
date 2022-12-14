<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\Review;

class ProductReviewController extends Controller
{
    public function displayProductReview(Product $product)
    {
        $user = auth()->user();
        return view('product-review', ['user' => $user, 'product' => $product]);
    }

    public function addReview(Request $request)
    {
        $user_id = Auth::id();
        $rating = $request->input('product_rating');
        $product_id = $request->input('product_id');

        $product_check = Product::where('id', $product_id)->first();
        if($product_check)
        {
            $verify_order = Order::where('orders.user_id', $user_id)
                            ->join('order_items', 'orders.id', 'order_items.order_id')
                            ->where('order_items.product_id', $product_id)->get();  // Check that a user has placed an order with the product that they are reviewing
            
            if($verify_order)
            {
                $existing_rating = Review::where('user_id', $user_id)->where('product_id', $product_id)->first();
                if($existing_rating)
                {
                    $existing_rating->rating = $rating;
                    $existing_rating->update();
                    return redirect()->route('productReview', $product_id)->with('alert', 'Your review has been updated. Thank you!');
                }
                else
                {
                    $review = new Review;
                    $review->rating = $rating;
                    $review->user()->associate(Auth::user());
                    $review->product()->associate($product_check);
                    $review->save();
                    return redirect()->route('productReview', $product_id)->with('alert', 'Your review has been left. Thank you!');
                }
            }
            else{
                return redirect()->route('orders')->with('alert', 'Your order ' . $order->id . ' was successful');
            }
        }
        else{
            return redirect()->route('orders')->with('alert', 'Your order ' . $order->id . ' was successful');
        }
        
    }
}
