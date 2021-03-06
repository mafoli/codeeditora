<?php

namespace Modules\CodePub\Http\Controllers;


use CodePub\Criteria\FindByTitleCriteria;
use CodePub\Http\Requests\BookCreateRequest;
use CodePub\Http\Requests\BookUpdateRequest;
use CodePub\Models\Book;

use CodePub\Repositories\BookRepository;
use CodePub\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * @var CategoryRepository
     */
    private $repository;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    public function __construct(BookRepository $repository, CategoryRepository $categoryRepository)
    {
        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
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

       //$this->repository->pushCriteria(new FindByTitleCriteria($search));

        $books = $this->repository->paginate(10);
        return view('books.index', compact('books','search'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->lists('name','id');
        return view('books.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookCreateRequest $request)
    {
        $data = $request->all();
        $data['author_id'] = \Auth::user()->id;
        $this->repository->create($data);
        $request->session()->flash('message','Livro Cadastrado com sucesso');
        $url=$request->get('redirect_to',route('books.index'));
        return redirect()->to($url);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)

    {
        $book = $this->repository->find($id);
        $this->categoryRepository->withTrashed();
        $categories = $this->categoryRepository->listsWithMutators('name','id');
        return view('books.edit',compact('book','categories'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookUpdateRequest $request,$id)
    {

        $data = $request->except(['author_id']);

        $this->repository->update($data,$id);
        $request->session()->flash('message','Livro Alterado com sucesso');
        $url=$request->get('redirect_to',route('books.index'));
        return redirect()->to($url);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        \Session::flash('message','Livro Excluso com sucesso.');
        return redirect()->to(\URL::previous());

    }
}
