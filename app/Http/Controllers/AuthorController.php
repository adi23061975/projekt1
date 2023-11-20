<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Repositories\AuthorRepository;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Author::class);
        return view(
            'authors.index'
        );
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Author::class);
        return view(
            'authors.form'
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        $this->authorize('update', $author);
        return view(
            'authors.form',
            [
                'author' => $author
            ]
        );
    }
}
