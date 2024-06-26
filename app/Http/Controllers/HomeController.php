<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index ()
    {
        $hotProducts = Product::where('product_type','hot')->orderBy('id','desc')->get();
        $newProducts = Product::where('product_type','new')->orderBy('id','desc')->get();
        $regularProducts = Product::where('product_type','regular')->orderBy('id','desc')->get();
        $discountProducts = Product::where('product_type','discount')->orderBy('id','desc')->get();
       
        return view ('home.index',compact('hotProducts','newProducts','regularProducts','discountProducts'));
    }


    public function productDetails ($slug)
    {
        $product = Product::where('slug',$slug)->with('color','size','galleryImage')->first();
       
        return view ('home.Product-details',compact('product'));
    }


    public function viewCart ()
    {
        return view ('home.view-cart');
    }

    public function productCheckout ()
    {
        return view ('home.product-checkout');
    }

    public function shopProduct ()
    {
        return view ('home.shop-page');
    }

    public function returnProduct ()
    {
        return view ('home.return-product');
    }

    public function privacyPolicy ()
    {
        return view ('home.privacy-policy');
    }


    //Add to Cart...

    public function addtoCartDetails(Request $request ,$id)
    {
        $cartProducut = Cart::where('product_id' ,$id)->where('ip_address',$request->ip())->first();
        $product = Product::where('id',$id)->first();
        $action = $request->action;
       

        if($cartProducut == null){
            $cart = new Cart();
            $cart->product_id = $id;
            $cart->ip_address = $request->ip();
            $cart->qty = $request->qty;
            if($product->discount_price != null){
                $cart->price = $product->discount_price;
            }
            elseif($product->discount_price == null){
                $cart->price = $product->regular_price;
            }

            $cart->size = $request->size;
            $cart->color = $request->color;

            $cart->save();

            if($action == 'addToCart'){
                toastr()->success('Added to Cart');
                return redirect()->back();
            }
            else{
                toastr()->success('Added to Checkout');
                return redirect('/product/check-out');
            }
        }
        elseif($cartProducut != null){
            $cartProducut->qty = $cartProducut->qty + $request->qty;
            $cartProducut->save();
            if($action == 'addToCart'){
                toastr()->success('Added to Cart');
                return redirect()->back();
            }
            else{
                toastr()->success('Added to Checkout');
                return redirect('/product/check-out');
            }
        }
    }

    //Add to Cart..

    public function addtoCart (Request $request , $id)
    {
        $cartProducut = Cart::where('product_id' ,$id)->where('ip_address',$request->ip())->first();
        $product = Product::where('id',$id)->first();

        if($cartProducut == null){
            $cart = new Cart();
            $cart->product_id = $id;
            $cart->ip_address = $request->ip();
            $cart->qty = 1;
            if($product->discount_price != null){
                $cart->price = $product->discount_price;
            }
            elseif($product->discount_price == null){
                $cart->price = $product->regular_price;
            }

            $cart->save();
            toastr()->success('Added to Cart');
            return redirect()->back();
       
       
        }
        elseif($cartProducut != null){
            $cartProducut->qty = $cartProducut->qty + 1;
            $cartProducut->save();

            toastr()->success('Added to Cart');
            return redirect()->back();



        }
    }

  
}
