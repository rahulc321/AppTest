<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use App\Models\Books;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $this->data['books'] = Books::get();
        return view('home',$this->data);
    }


    // Custom logout
    public function customLogout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }

    // Import data from api 
    public function importData()
    {
        $api_url = 'https://run.mocky.io/v3/821d47eb-b962-4a30-9231-e54479f1fbdf';

        // Read JSON file
        $json_data = file_get_contents($api_url);

        // Decode JSON data into PHP array
        $response_data = json_decode($json_data);

    //echo '<pre>';print_r($response_data);
        foreach($response_data->items as $data){
            
            $checkBook = Books::where('bookId',$data->id)->first();

            if(!$checkBook){
            $book = new Books();
            $book->bookId = $data->id;
            $book->authors =implode(',', $data->volumeInfo->authors);
            $book->title =$data->volumeInfo->title;
            $book->subtitle =@$data->volumeInfo->subtitle;
            $book->thumbnail =@$data->volumeInfo->imageLinks->thumbnail;
            $book->smallThumbnail =@$data->volumeInfo->imageLinks->smallThumbnail;
            $book->save();

            }
        }
        \Session::flash('success', 'You have successfully Imported data from api.');
        return redirect()->route('home');

    }

    // Delete Book data
    public function delete($id)
    {
        $delete = Books::where('id',$id)->first();
        $delete->delete();
        \Session::flash('error', 'You have successfully deleted.');
        return redirect()->route('home');
    }
}
