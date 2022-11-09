<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookReservationTest extends TestCase
{

    use RefreshDatabase;

    public function test_apakah_bisa_menambahkan_buku()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/books', [
            'title' => 'Teruslah Bermanfaat Bagi Sesama',
            'author' => 'Abdul Aziz',
        ]);

        $response->assertOk();

        $this->assertCount(1, Book::all());
    }

    public function test_apakah_judul_buku_harus_diisi()
    {

        $response = $this->post('/books', [
            'title' => '',
            'author' => 'Abdul Aziz',
        ]);

        $response->assertSessionHasErrors('title');
    }

    public function test_apakah_author_buku_harus_diisi()
    {

        $response = $this->post('/books', [
            'title' => 'Teruslah Belajar Selagi masih Sehat',
            'author' => '',
        ]);

        $response->assertSessionHasErrors('author');
    }

    public function test_apakah_author_bisa_diisi_angka()
    {
        $response = $this->post('/books', [
            'title' => 'Teruslah Belajar Selagi masih Sehat',
            'author' => 324895,
        ]);

        $response->assertSessionHasErrors('author');
    }

    public function test_apakah_bisa_mengupdate_buku()
    {

        $this->withoutExceptionHandling();

        $this->post('/books', [
            'title' => 'Belajar Menggunakan TDD',
            'author' => 'Abdul Aziz'
        ]);

        $book = Book::first();

        $res = $this->patch('books/' . $book->id, [
            'title' => 'Belajar Pemrograman Laravel',
            'author' => 'Muhammad Rois'
        ]);

        $this->assertEquals('Belajar Pemrograman Laravel', Book::first()->title);
        $this->assertEquals('Muhammad Rois', Book::first()->author);
    }
}

