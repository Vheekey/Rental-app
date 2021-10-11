<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemSearchRequest;
use App\Models\Book;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    /**
     * Retrieve Items and Item searches
     *
     * @param ItemSearchRequest $request
     * @return void
     */
    public function index(ItemSearchRequest $request)
    {
        $result = [];
        if($request->parameter){
            $result = DB::table($request->search)->where($request->parameter, 'LIKE', '%'.$request->value.'%')->sole();
        }

        $books = Book::paginate(5);
        $equipments = Equipment::paginate(5);

        return view('items', compact('books', 'equipments', 'result'));
    }
}
