<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\AuthorModel;
use App\Model;
use DB;

class AuthorController extends Controller
{
    use ApiResponser;
    private $request;
    
     
    public function __construct(Request $request)
    {
        $this->request = $request;
        
    }


    public function getAuthors()
    {
        $authors =  DB::connection('mysql')
        ->select("Select * from tblauthors");

        return $this->successResponse($authors);
    }


    public function index()
    {
        $authors = AuthorModel
    ::all();

        return $this->successResponse($authors);
    }


    public function add(Request $request)
    {
        $rules = [

            'fullname' => 'required|max:20',
            'gender' => 'required|in:Male,Female',
            'birthday' => 'required|date|date_format:Y-m-d',
            //'yearpublish' => 'required|numeric|min:1|not_in:0',
            //'gender' => 'required|in:Male,Female',

        ];


        $this->validate($request, $rules);
        $authors = AuthorModel
    ::create($request->all());
        return $this->successResponse($authors, Response::HTTP_CREATED);
    }

    /**
        * Obtains and show one book
        * @return Illuminate\Http\Response
        */


    public function show($id)
    {
        $authors = AuthorModel
    ::where('author_id', $id)->first();
        if($authors){
            return $this->successResponse($authors);
        }
    
        {
            return $this->errorResponse('Book ID Does Not Exist', Response::HTTP_NOT_FOUND);

        }

    }

    /**
        * Update an existing author
        * @return Illuminate\Http\Response
        */
    
    public function update(Request $request, $id)
    {

        $rules = [

            'bookname' => 'max:20',
            'yearpublish' => 'numeric|min:1|not_in:0',
            'birthday' => 'date|date_format:Y-m-d',
            //'gender' => 'in:Male,Female',

        ];

        $this->validate($request, $rules);

        $authors = AuthorModel
    ::findOrFail($id);

        $authors->fill($request->all());
        
        $authors->save();
        if($authors){
            return $this->successResponse($authors);
        }
    
        {
            return $this->errorResponse('Book ID Does Not Exist', Response::HTTP_NOT_FOUND);

        }
    }

    public function delete($id)
    {
        $authors = AuthorModel
    ::where('author_id', $id)->first();
        if($authors){
            $authors->delete();
            return $this->successResponse($authors);
        }
    
        {
            return $this->errorResponse('Book ID Does Not Exist', Response::HTTP_NOT_FOUND);

        }

    }    
}

?>