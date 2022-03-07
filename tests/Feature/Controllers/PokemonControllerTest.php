<?php

namespace Tests\Feature\Controllers;

use App\Models\Pokemon;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class PokemonControllerTest extends TestCase
{
    public function test_unauthorized_request()
    {
        $response = $this->getJson('/api/pokemons');
        $response->assertStatus(ResponseAlias::HTTP_UNAUTHORIZED);
    }

    public function test_get_pokemons()
    {
        $user = User::find(1);
        $response = $this->actingAs($user, 'sanctum')->getJson('api/pokemons');
        $response->assertStatus(ResponseAlias::HTTP_OK);
        $jsonResponse = $response->json();
        $this->assertEquals(20, $jsonResponse['meta']['per_page']);
        $this->assertIsArray($jsonResponse);
    }

    public function test_get_one_pokemon()
    {
        $user = User::find(1);
        $pokemon = Pokemon::first();
        $response = $this->actingAs($user, 'sanctum')->getJson("/api/pokemons/$pokemon->id");
        $jsonResponse = $response->json();

        $this->assertEquals($pokemon->id, $jsonResponse['data']['id']);
        $this->assertIsArray($jsonResponse);

        $response->assertStatus(ResponseAlias::HTTP_OK);
    }

    public function test_validation_when_creating_pokemon()
    {

    }
}
