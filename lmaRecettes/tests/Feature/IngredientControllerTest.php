<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IngredientControllerTest extends TestCase
{

    use RefreshDatabase;

    public function testIndexMethod()
    {
        $response = $this->get('/recettes');
        $response->assertStatus(200);
        $response->assertViewIs('.recettes');
    }

    public function testFinalMethod()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewIs('.finalFront');
        $response->assertViewHasAll(['ingredients', 'images', 'categories']);
    }
}
