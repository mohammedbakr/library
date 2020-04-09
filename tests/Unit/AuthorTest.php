<?php

namespace Tests\Unit;

use App\Author;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_author_id_is_recorded()
    {
        Author::firstOrCreate([
            'name' => 'Mohamed',
        ]);

        $this->assertCount(1, Author::all());
    }
}
