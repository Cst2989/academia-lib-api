<?php

namespace App\Http\Controllers;

use App\LentBook;
use App\Book;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function update(Request $request)
    {
        $data = $request->all();

        $user =  $request->user();

        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->name = $data['name'];


        $user->save();

        return response($user);
    }

    public function getLentBooks(Request $request)
    {
        $user =  $request->user();

        $lentBooks = LentBook::where([
            ['user_id', '=', $user->id],
        ])->get();

        $books = [];
        foreach ($lentBooks as $book) {
            $book = Book::where([
                ['id', '=', $book->book_id],
            ])->first();

            array_push($books,$book);
        }

        return $books;
    }
}
