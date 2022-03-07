<?php

namespace App\Http\Controllers;

use App\Http\Requests\PokemonRequest;
use App\Http\Requests\UpdatePokemonRequest;
use App\Http\Resources\PokemonCollection;
use App\Http\Resources\PokemonResource;
use App\Models\Pokemon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestAlice;

class PokemonsController extends Controller
{
    /**
     * @param Request $request
     * @return PokemonCollection|Application|Factory|View
     */
    public function index(Request $request)
    {
        $pokemons = Pokemon::orderBy('order')->paginate(20);
        # Since we're expecting third party apps to
        # make request to this "api/pokemons" endpoint,
        # we're checking if it's an api request or a http request
        if (RequestAlice::wantsJson()) {
            # serialize the Pokemon collection
            return new PokemonCollection($pokemons);
        }

        return view('welcome', compact('pokemons'));
    }

    public function create(PokemonRequest $request): RedirectResponse
    {
        Pokemon::create($request->all());
        return redirect()->route('index')->with('success', 'created successfully');
    }

    public function show($id)
    {
        $pokemon = Pokemon::findOrFail($id);
        if (RequestAlice::wantsJson()) {
            # Serialize the pokemon object
            return new PokemonResource($pokemon);
        }
        return view('pokemon.show');
    }

    public function update(UpdatePokemonRequest $request, $id): RedirectResponse
    {
        Pokemon::find($id)->update($request->all());
        return redirect()->route('index')->with('success', 'updated successfully');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $pokemon = Pokemon::find($id);
        return view('pokemon.edit', compact('pokemon'));
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id): RedirectResponse
    {
        Pokemon::find($id)->delete();
        return redirect()->route('index')->with('success', 'deleted successfully');
    }
}
