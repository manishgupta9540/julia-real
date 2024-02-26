<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Wishlisht;
use Auth;


class WishlishtController extends Controller
{
    public function addToWishlisht(Request $request)
    {
        $product_id = $request->input('id');
    
        if(Auth::check())
        {
            $prod_check = Property::where('id',$product_id)->exists();

            if($prod_check)
            {
                if(Wishlisht::where('product_id',$product_id)->where('user_id',Auth::id())->exists())
                {
                    return response()->json([ 'success' =>false]);
                }
                else
                {
                    $cartItem = new Wishlisht();
                    $cartItem->product_id = $product_id;
                    $cartItem->user_id = Auth::user()->id;
                    $cartItem->save();
                    return response()->json([ 'success' =>true]);
                }  
            }
        }
        else
        {
            return response()->json(['success'=> false]);
        }
    }

    public function wishlishtDeleted(Request $request)
    {
        if(Auth::check())
        {
            $product_id = $request->input('product_id');
          
            if(Wishlisht::where('product_id',$product_id)->where('user_id',Auth::id())->exists())
            {
               $cartData =  Wishlisht::where('product_id',$product_id)->where('user_id',Auth::id())->first();
               $cartData->delete();
               return response()->json(['status'=>'Product Deleted Successfully']);
            }
        }
        else
        {
            return response()->json(['status'=>'Login To Continue']);
        }
    }
}
