<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlShortnerPostRequest;
use App\Models\UrlShortner;
use Illuminate\Support\Str;

class UrlShortnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home', [
            'shortLinks' => UrlShortner::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\UrlShortnerPostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UrlShortnerPostRequest $request)
    {
        UrlShortner::firstOrCreate([
            'link' => $request->link,
            'code' => Str::random(6),
        ]);

        return redirect('/')
            ->with('success', 'Short Link Generated Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $code
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $shortLink = UrlShortner::where('code', $code)->first();
        $shortLink->touch();

        return redirect($shortLink->link);
    }
}
