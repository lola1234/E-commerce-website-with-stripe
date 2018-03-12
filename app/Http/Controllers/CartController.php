<?php

namespace App\Http\Controllers;
use Session;
use App\Cart;
use App\Order;
use App\Customer;
use App\Product;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart(){
		if(Session::has('cart')){
			$oldCart=Session::get('cart');
			$cart = new Cart($oldCart);
			return view('frontend.cart',['products'=>$cart->items, 
					'totalPrice'=>$cart->totalPrice]);
		}
		return view('frontend.cart');
	}
	
	public function add(Request $request,$id){
		$product = Product::findOrFail($id);
		$oldCart = Session::has('cart') ? Session::get('cart'):null;
		$cart = new Cart($oldCart);
		$cart->add($product, $product->id);
		
		$request->session()->put('cart', $cart);
		return redirect()->back();
	}
	
	public function decr($id){
		$oldCart = Session::has('cart') ? Session::get('cart'):null;
		$cart = new Cart($oldCart);
		$cart->decrQty($id);
		
		if(count($cart->items) > 0){
			Session::put('cart', $cart);
		}else{
			Session::forget('cart');			
		}
		return redirect()->back();
	}
	
	public function remove($id){
		$oldCart = Session::has('cart') ? Session::get('cart'):null;
		$cart = new Cart($oldCart);
		$cart->removeItem($id);
		
		if(count($cart->items) > 0){
			Session::put('cart', $cart);
		}else{
			Session::forget('cart');			
		}		
		return redirect()->back();
	}
	
	public function checkout(){
		 if(!Session::has('cart')){
			return view('frontend.cart');
		}
		$oldCart = Session::get('cart');
		$cart = new Cart($oldCart);
		$total = $cart->totalPrice;
		return view('frontend.checkout',['total'=>$total]);
	}
	
	public function postCheckout(Request $request){
		 if(!Session::has('cart')){
			return view('frontend.cart');
		}
		$oldCart = Session::get('cart');
		$cart = new Cart($oldCart);
		
		Stripe::setApiKey("your_api_key");
		
		try{
			$charge = Charge::create(array(		    
		    "amount" => $cart->totalPrice * 100,
		    "currency" => "eur",
		    "description" => "Test charge",
		    "source" => $request->input('stripeToken')
           ));
		   
		   $customer= new Customer();
		   $customer->name = $request->name;
		   $customer->email = $request->email;
		   $customer->address = $request->address;
		   $customer->save();
		   
		   $order = new Order();
		   $order->cart = serialize($cart);
		   $order->payment_id = $charge->id;
		   $order->customer_id = $customer->id;
		   $order->save();
		   
		}catch(\Exception $e){
			 return redirect()->route('checkout')->with('error', $e->getMessage());
		}
		Session::forget('cart');
		Session::flash('success','Successfully purchased products!!');
		return redirect()->route('index');
	}
}
