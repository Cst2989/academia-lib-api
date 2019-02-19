<?php

namespace App\Http\Controllers;

use App\Book;
use App\LentBook;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index($sandbox) {
        $authors = Book::where('sandbox', $sandbox)->get();
        return json_encode($authors);
    }

    public function getBook($sandbox, $bookId) {
        $author = Book::where([
            ['id', '=', $bookId],
            ['sandbox', '=', $sandbox],
        ])->get();
        return json_encode($author);
    }

    public function create($sandbox, Request $request) {

        $data = $request->all();
        $data['sandbox'] = $sandbox;

        return response(Book::firstOrCreate($data), 201);
    }

    public function updateBook($sandbox, $bookId, Request $request) {
        $data = $request->all();

        $book =  Book::where([
            ['id', '=', $bookId],
            ['sandbox', '=', $sandbox],
        ])->first();

        $book->name = $data['name'];
        $book->total = $data['total'];
        $book->available = $data['available'];
        $book->authors = $data['authors'];
        $book->id = $data['id'];

        $book->save();

        return response($book, 201);
    }

    public function deleteBook($sandbox, $bookId) {

        $book =  Book::where([
            ['id', '=', $bookId],
            ['sandbox', '=', $sandbox],
        ])->first();

        $book->delete();

        return response([
            "success" => true
        ], 203);
    }

    public function lendBook($sandbox, $bookId, $userId) {

        $book =  Book::where([
            ['id', '=', $bookId],
            ['sandbox', '=', $sandbox],
        ])->first();


        $book->available = $book->available - 1;

        $book->save();
        $data = [
            'book_id' => $book->id,
            'user_id' => $userId,
        ];
        return response(LentBook::firstOrCreate($data), 204);
    }

    public function returnBook($sandbox, $bookId, $userId) {

        $book =  Book::where([
            ['id', '=', $bookId],
            ['sandbox', '=', $sandbox],
        ])->first();

        $book->available = $book->available + 1;


        $lentBook =  LentBook::where([
            ['book_id', '=', $bookId],
            ['user_id', '=', $userId],
        ])->first();

        $lentBook->delete();

        return response([
            "success" => true
        ], 204);
    }
}
