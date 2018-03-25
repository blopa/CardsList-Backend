<?php

namespace App\Http\Controllers;

use App\CardsList;
//use App\Http\Request;
use App\Http\Resources\CardsList as CardsListResource;
use Illuminate\Http\Request;

class CardsListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cardsList = CardsList::paginate(15);
        return CardsListResource::collection($cardsList);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cardsList = new CardsList;
        $hash = substr(md5(uniqid(str_shuffle((string)microtime().rand()), true)), 0, 30);
        $cardsList->hash = $hash;
        $cardsList->type = $request->input('type');
        $cardsList->cards = $request->input('cards');

        if ($cardsList->save()) {
            return new CardsListResource($cardsList);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CardsList  $cardsList
     * @return \Illuminate\Http\Response
     */
    public function show($hash)
    {
        $cardsList = CardsList::where('hash', $hash)->first();
        return new CardsListResource($cardsList);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CardsList  $cardsList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CardsList $cardsList)
    {
        $hash = substr(md5(uniqid(str_shuffle((string)microtime().rand()), true)), 0, 30);
        $cardsList->hash = $hash;
        $cardsList->type = $request->input('type');
        $cardsList->cards = $request->input('cards');

        if ($cardsList->save()) {
            return new CardsListResource($cardsList);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CardsList  $cardsList
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cardsList = CardsList::findOrFail($id);

        if ($cardsList->delete()) {
            return new CardsListResource($cardsList);
        }
    }
}
