<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Session;

class HomeController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }
    
    /**
     * Call api : common function.
     *
     */

    public function getresult($method, $url, $body = null){
        $token = (Session::get('user'))?Session::get('user')->token_key:"";
        switch($method){
            case "post":
                $res = Http::withToken($token)->withBody($body, 'application/json')->post('https://symfony-skeleton.q-tests.com/api/v2/'.$url);
                break;
            case "delete":
                $res = Http::withToken($token)->delete('https://symfony-skeleton.q-tests.com/api/v2/'.$url);        
                break;
            default:
                $res = Http::withToken($token)->get('https://symfony-skeleton.q-tests.com/api/v2/'.$url);
                break;
        }
        if($res->successful()){
            return $res->object();
        }else{
            return false;
        }
    }

    // Landing page
    public function index()
    {        
        return view('welcome');
    }

    // User profile
    public function profile()
    {
        if(!Session::get('user')){
            return redirect(route('/home'));
        }
        return view('profile');
    }

    // User logout
    public function logout()
    {
        Session::flush();
        return redirect(route('/home'));
    }

    // User login
    public function userlogin(Request $request)
    {        
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        $body = json_encode([
                'email' => $request->email,
                'password' => $request->password
        ]);

        $data = $this->getresult('post','token', $body);
        if(!$data){
            return redirect()->back()->with('something went wrong!');
        }
        Session::put('user', $data);
        return redirect(url('home'));
    }

    // Show all authors
    public function authors(){
        if(!Session::get('user')){
            return redirect(route('home'));
        }
        $res = $this->getresult('get','authors');
        $data = $res->items;
        return view('authors', compact('data'));
    }

    // Auther detail
    public function author_view($id){
        if(!Session::get('user')){
            return redirect(route('home'));
        }
        $data = $this->getresult('get','authors/'.$id);
        if(!$data){
            return redirect()->back()->with('something went wrong!');
        }
        return view('author_view', compact('data'));
    }

    // Author delete
    public function author_delete($id){
        if(!Session::get('user')){
            return redirect(route('home'));
        }
        $res = $this->getresult('delete','authors/'.$id);
        return redirect('authors')->with('status', 'Author deleted successfully.');
    }
    
    // Book create view page
    public function book_create(){
        if(!Session::get('user')){
            return redirect(route('home'));
        }
        $res = $this->getresult('get','authors/');
        if(!$res){
            return redirect()->back()->with('something went wrong!');
        }
        $data = $res->items;
        return view('book_create', compact('data'));
    }
    
    // Book create
    public function book_store(Request $request){
        if(!Session::get('user')){
            return redirect(route('home'));
        }
        $this->validate($request, [
            'author' => 'required',
            'title' => 'required',
            'release_date' => 'required',
            'description' => 'required',
            'isbn' => 'required',
            'format' => 'required',
            'number_of_pages' => 'required',
        ]);
        
        $body = json_encode([
                'author' => ['id' => (int)$request->author],
                'title' => $request->title,
                'release_date' => date('Y-m-d H:i:s', strtotime($request->release_date)),
                'description' => $request->description,
                'isbn' => $request->isbn,
                'format' => $request->format,
                'number_of_pages' => (int)$request->number_of_pages,
        ]);

        $res = $this->getresult('post','books', $body);
        if(!$res){
            return redirect()->back()->with('something went wrong!');
        }
        return redirect()->back()->with('status', 'Book created successfully.');
    }

    // Book delete
    public function book_delete($id){
        if(!Session::get('user')){
            return redirect(route('home'));
        }
        $res = $this->getresult('delete','books/'.$id);
        if(!$res){
            return redirect()->back()->with('something went wrong!');
        }
        return redirect()->back()->with(['status' => 'Book deleted successfully!']);
    }
}
