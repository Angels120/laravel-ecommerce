<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', '=', '1')->get();
        $products = Product::where('status', '=', '1')->get();
        $latestProducts = Product::latest()->take(4)->get();
        $brands = Brand::where('status', '=', '1')->get();
        return view('customer.home', compact('categories', 'products', 'latestProducts', 'brands'));
    }
    public function addToWishlist(Request $request)
    {
        if (Auth::check() == false) {
            session(['url.intended' => url()->previous()]);
            return response()->json([
                'status' => false
            ]);
        }
        Wishlist::updateOrCreate(
            [
                'user_id' => Auth::user()->id,
                'product_id' => $request->id
            ],
            [
                'user_id' => Auth::user()->id,
                'product_id' => $request->id,
            ]
        );

        return response()->json([
            'status' => true,
            'message' => 'Product added in your wishlist',
        ]);
    }
    public function page($slug){
        $breadcrumb = [
            'breadcrumbs' => [
                'WebMart' => route('home.page'),
                $slug   => route('footer.page', $slug),
            ],
        ];

        $page=Page::where('slug',$slug)->first();
        if($page==null){
            abort(404);
        }
        return view('customer.page', compact('page','breadcrumb'));
    }
    public function sendContactEmail(Request $request){

        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);
        $mailData=[
            'name'=> $request->name,
            'email'=> $request->email,
            'subject'=> $request->subject,
            'message'=> $request->message,
            'url'=>'http://127.0.0.1:8000/',
            'mail_subject'=>'You have received a contact mail',
        ];
        $admin=User::where('id',1)->first();
        Mail::to($admin->email)->send(new ContactMail($mailData));
        return response()->json([
            'status' => true,
            'message' => 'Your Message is send successfully',
        ]);
    }
}

