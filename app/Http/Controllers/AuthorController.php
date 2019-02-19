<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;
class AuthorController extends Controller
{
    public function index($sandbox) {
        $authors = Author::where('sandbox', $sandbox)->get();
        return json_encode($authors);
    }

    public function getAuthor($sandbox, $authorId) {
        $author = Author::where([
            ['id', '=', $authorId],
            ['sandbox', '=', $sandbox],
        ])->get();
        return json_encode($author);
    }

    public function create($sandbox, Request $request) {

        $data = $request->all();
        $data['sandbox'] = $sandbox;

        return response(Author::firstOrCreate($data));
    }

    public function updateAuthor($sandbox, $authorId, Request $request) {
        $data = $request->all();

        $author =  Author::where([
            ['id', '=', $authorId],
            ['sandbox', '=', $sandbox],
        ])->first();

        $author->firstName = $data['firstName'];
        $author->lastName = $data['lastName'];
        $author->id = $data['id'];

        $author->save();

        return response($author);
    }

    public function deleteAuthor($sandbox, $authorId) {

        $author =  Author::where([
            ['id', '=', $authorId],
            ['sandbox', '=', $sandbox],
        ])->first();

        $author->delete();

        return response([
            "success" => true
        ]);
    }
}
