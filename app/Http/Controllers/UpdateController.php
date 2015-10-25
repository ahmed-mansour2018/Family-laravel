<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Update;
use App\User;
use App\Http\Requests\SaveUpdateRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class UpdateController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
//        $this->middleware('auth', ['except' => 'index']);
        //$this->middleware('auth', ['only' => 'create']);
    }

//
//    public function get_author ($update)
//    {
//        $author = $update->user_id;
//        return $author;
//    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $updates = DB::table('updates')
            ->join ('users', 'users.id', '=', 'updates.user_id')
            ->get();

        return view('update.index', compact('updates'));
    }

    public function pending()
    {
//        return 'pending updates';
        $updates = Update::latest('created_at')->pending()->get();
        return view('update.index', compact('updates'));
    }

//    //@TODO come back and try again when not tired- episode 14, 12:17
//    public function user_updates($user)
//    {
////        return all updates suggested by the specified user
//        $updates = $user->updates->get();
//        return view('update.index', compact('updates'));
//    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view ('update.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(SaveUpdateRequest $request)
    {
        $update = new Update($request->all());

        \Auth::user()->updates()->save($update); //this line will save the logged in user for user_id
//        Update::create($request->all());
        return redirect('updates');
    }
    /**
     * Display the specified resource.
     *
     * @param  Update $update
     * @return Response
     */
    public function show(Update $update)
    {
        return view ('update.show', compact('update'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Update $update)
    {
        return view('update.edit', compact('update'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(SaveUpdateRequest $request, Update $update)
    {
        $update->Update($request->all());

        return redirect('updates');
    }

//@FIXME: added this with update link on updates index page (not sure how to call the class' function)
//But error said UpdateController@setAdded not defined

    public function setAdded(Update $update)
    {
        $update->setAddedAttribute($update);

        return redirect('updates');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Update $update)
    {
        $update->delete();
        return redirect()->route('update.index');
    }
}
