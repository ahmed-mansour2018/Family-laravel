<?php

//namespace App\Http\Requests;
namespace App\Http\Controllers;

use App\Family;
use App\Person;
use App\Image;
use App\Http\Requests;
use App\Http\Requests\SaveFamilyRequest;
use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;  //not sure if this is being used, PeopleController doesn't have it
use Acme\Mailers\UserMailer as Mailer;
use App\User;
use App\Note;

class FamilyController extends Controller
{

    protected $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->middleware('auth');

        $this->mailer= $mailer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $families = Family::all();

        $kaplan_families = Family::kaplans()->get();
        $keem_families = Family::keems()->get();
        $kemler_families = Family::kemlers()->get();
        $husband_families = Family::husbands()->get();

        return view('family.index', compact('families', 'kaplan_families', 'keem_families', 'kemler_families', 'husband_families'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view ('family.create');
    }

    private function createFamily(SaveFamilyRequest $request)
    {
        $family = Family::create($request->all());
        return $family;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveFamilyRequest $request)
    {
        $this->createFamily($request);

        flash()->overlay('You successfully added a family', 'Thank you');

        return redirect('families');
    }

    protected function get_kids_of_family($family)
    {
        $kids = Person::where('family_of_origin', $family->id)
            ->orderBy('sibling_seq', 'asc')
            ->get();
        return $kids;
    }

    protected function get_notes_about_family($family)
    {
        $notes = Note::Where('type', 2)
            ->leftjoin ('people', 'people.id', '=', 'notes.author')
            ->Where('ref_id', $family->id)
            ->orderBy('for_self', 'desc', 'date', 'asc')
            ->get();

        return $notes;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family)
    {
        $id = $family->id;

        $mother =  Person::where('id', '=', $family->mother_id)->first();
        $father =  Person::where('id', '=', $family->father_id)->first();
        $kids = FamilyController::get_kids_of_family($family);
        $notes = FamilyController::get_notes_about_family($family);

        $images = Image::where('family', $id)
            ->orderBy('year', 'asc')
            ->get();

        $featured_image = Image::where('featured', 1)
            ->Where('family', $id)
            ->orderBy('year', 'asc')
            ->get();

        return view ('family.show', compact('family', 'kids', 'images', 'mother', 'father', 'featured_image', 'notes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Family $family)
    {
        return view('family.edit', compact('family'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Family $family, SaveFamilyRequest $request)
    {
        $family->update($request->all());

        $user_who_made_update =  \Auth::user();
        $diane_user = User::find(1);

        $this->mailer->family_update_notify($diane_user, $request, $user_who_made_update, $family);
        $this->mailer->family_update_thankyou($user_who_made_update, $request, $family);

        flash()->success('Your edit has been saved');

        //        return redirect('people');
//        return redirect()->back();
//                return redirect('families');
        return redirect()->route('families.show', [$family]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Family $family)
    {
        $family->delete();
        return redirect()->route('family.index');
    }
}
