<?php

namespace Tests\Feature;

use App\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_book_can_be_added_to_the_library()
    {
        // $this->withoutExceptionHandling();

        $response = $this->post('/books', [
            'title' => 'Book One',
            'author' => 'Mohamed',
        ]);

        $book = Book::first();

        $this->assertCount(1, Book::all());
        $response->assertRedirect($book->path());
    }

    /** @test */
    public function a_title_is_required()
    {
        $response = $this->post('/books', [
            'title' => '',
            'author' => 'Mohamed',
        ]);

        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_author_is_required()
    {
        $response = $this->post('/books', [
            'title' => 'Book One',
            'author' => '',
        ]);

        $response->assertSessionHasErrors('author');
    }

    /** @test */
    public function a_book_can_be_updated()
    {
        // $this->withoutExceptionHandling();

        $this->post('/books', [
            'title' => 'Book One',
            'author' => 'Mohamed',
        ]);

        $book = Book::first();

        $response = $this->patch($book->path() , [
            'title' => 'Book One Updated',
            'author' => 'Hatem',
        ]);

        $this->assertEquals('Book One Updated', Book::first()->title);
        $this->assertEquals('Hatem', Book::first()->author);
        $response->assertRedirect($book->fresh()->path());
    }

    /** @test */
    public function a_book_can_be_deleted()
    {
        // $this->withoutExceptionHandling();

        $this->post('/books', [
            'title' => 'Book One',
            'author' => 'Mohamed',
        ]);

        $this->assertCount(1, Book::all());
        $book = Book::first();

        $response = $this->delete($book->path());

        $this->assertCount(0, Book::all());
        $response->assertRedirect('/books');
    }
}
