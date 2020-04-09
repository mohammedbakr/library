<?php

namespace Tests\Feature;

use App\Author;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_author_cane_be_created()
    {
        // $this->withoutExceptionHandling();

        $response = $this->post('/authors', $this->data());

        $author =  Author::all();
        $this->assertCount(1, $author);
        $this->assertInstanceOf(Carbon::class, $author->first()->dob);
        $this->assertEquals('2020/08/04', $author->first()->dob->format('Y/d/m'));
    }

    /** @test */
    public function a_name_is_required()
    {
        $response = $this->post('/authors', array_merge($this->data(), ['name' => '']));

        $response->assertSessionHasErrors('name');

        $this->assertCount(0, Author::all());
    }

    /** @test */
    public function a_dob_is_required()
    {
        $response = $this->post('/authors', array_merge($this->data(), ['dob' => '']));

        $response->assertSessionHasErrors('dob');

        $this->assertCount(0, Author::all());
    }

    private function data()
    {
        return [
            'name' => 'Mohamed',
            'dob' => '04/08/2020',
        ];
    }
}
