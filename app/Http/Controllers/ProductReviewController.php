<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\Review;

class ProductReviewController extends Controller
{ 
    public function reviewProductPage(Product $product) // Display page for user to review the product
    {
        $user = auth()->user();
        return view('product-review', ['user' => $user, 'product' => $product]); 
    }

    public function listOfProductReviewsPage(Product $product) // Displays page of all the reviews for a product 
    {
        $reviews = Review::where('product_id', $product->id)->get();
        return view('products/reviews', ['reviews' => $reviews, 'product' => $product]);
    }

    public function addReview(Request $request)
    {
        $user_id = Auth::id();
        $rating = $request->input('product_rating');
        $product_id = $request->input('product_id');
        $comment = $request->input('comment');
        if($comment == NULL & $rating == null)
        {
            return redirect()->route('reviewProduct', $product_id)->with('alert', 'Comment cannot be blank and you must select a rating star!');
        }
        else if($comment == NULL)
        {
            return redirect()->route('reviewProduct', $product_id)->with('alert', 'You must input a comment!');
        }
        else if($rating == NULL)
        {
            return redirect()->route('reviewProduct', $product_id)->with('alert', 'You must select a rating star');
        }

        $product_check = Product::where('id', $product_id)->first(); // Checks if the product exists that the user is wanting to review 
        if($product_check)
        {
            $verify_order = Order::where('orders.user_id', $user_id)
                            ->join('order_items', 'orders.id', 'order_items.order_id')
                            ->where('order_items.product_id', $product_id)->get();  // Checks that a user has placed an order with the product that they are reviewing
            
            if($verify_order)
            {
                $existing_rating = Review::where('user_id', $user_id)->where('product_id', $product_id)->first(); // Checks if the user has already placed an order before to know whether to update or place a new review
                if($existing_rating)
                {
                    $existing_rating->rating = $rating;
                    $existing_rating->comment = $comment;
                    $existing_rating->update();
                    return redirect()->route('reviewProduct', $product_id)->with('alert', 'Your review has been updated. Thank you!');
                }
                else
                {
                    $review = new Review;
                    $review->rating = $rating;
                    $review->comment = $comment;
                    $review->user()->associate(Auth::user());
                    $review->product()->associate($product_check);
                    $review->save();
                    return redirect()->route('reviewProduct', $product_id)->with('alert', 'Your review has been left. Thank you!');
                }
            }
            else{
                return redirect()->route('orders')->with('alert', 'You cannot rate a product without a purchase!');
            }
        }
        else{
            return redirect()->route('orders')->with('alert', 'Link was broken!');
        }      
    }
}
