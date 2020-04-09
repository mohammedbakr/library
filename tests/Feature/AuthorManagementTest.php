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

        $response = $this->post('/author', [
            'name' => 'Mohamed',
            'dob' => '04/08/2020',
        ]);

        $author =  Author::all();
        $this->assertCount(1, $author);
        $this->assertInstanceOf(Carbon::class, $author->first()->dob);
        $this->assertEquals('2020/08/04', $author->first()->dob->format('Y/d/m'));
    }
}
