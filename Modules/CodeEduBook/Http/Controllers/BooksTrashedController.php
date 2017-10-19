<?php

namespace CodePub\Http\Controllers;


use CodePub\Criteria\FindOnlyTrashedCriteria;
use CodePub\Criteria\FindByTitleCriteria;
use CodePub\Http\Requests\BookCreateRequest;
use CodePub\Http\Requests\BookUpdateRequest;
use CodePub\Models\Book;

use CodePub\Repositories\BookRepository;
use CodePub\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class BooksTrashedController extends Controller
{
    /**
     * @var CategoryRepository
     */
    private $repository;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    public function __construct(BookRepository $repository)
    {
        $this->repository = $repository;

    }


    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $search = $request->get('search');

       $this->repository->onlyTrashed( FindOnlyTrashedCriteria::class);

        $books = $this->repository->paginate(10);
        return view('trashed.books.index', compact('books','search'));

    }

    public function  update(Request $request,$id){
        $this->repository->onlyTrashed();
        $this->repository->restore($id);
        $request->session()->flash('message','Livro Restaurado com sucesso');
        $url=$request->get('redirect_to',route('trashed.books.index'));

        return redirect()->to($url);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

}
