<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\Task;
use App\Http\Requests\StoreOwnerRequest;
use App\Http\Requests\UpdateOwnerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $owner = Owner::all();
        return view('owner.index', ['owners' => $owner]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('owner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOwnerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    //min galime ivesti minimaliai simboliu
    //max kiek mes galime ivesti maksimaliai simboliu
    //alpha tikrina ar ivestos tik raides
    //alpha_num tikrina ar ivestos tik raides arba skaiciai
    //alpha_dash tikrina ar ivestos tik raides arba skaiciai, bet papildomai priima 2 simbolius: _, -
    //numeric - tikrina ar skaicius, integer(3.14, -5, 15, 0)
    //integer - tikrina ar sveikasis skaicius(-, 0, +)

    //naturalusis skaicius yra nuo 1 - +inf
    //gt(greater than)  gt:0
    //gte(greater than or equal) gte:0
    //lt(less than) lt:0
    //lte(less than or equal ) lte:0
    //integer| >0

    //date - tikrina ar data
    //date_equals -tikrina ar data lygi
    //before - tikrina ar data yra ansktesne nei nurodyta
    //before_or_equal -tikrina ar data yra ansktesne nei nurodyta arba lygi
    //after - tikrina ar data yra velesne nei nurodyta
    // after_or_equal - tikrina ar data yra velesne nei nurodyta arba lygi

    {
        $request->validate([

            "owner_name" => ['required', 'alpha', 'min:2', 'max:15'],
            "owner_surname" => ['required', 'alpha', 'min:2', 'max:15'],
            "owner_email" => ['required', 'email'],
            "owner_phone" => ['required', 'regex:/(86|\+3706)\d{7}/', 'min:9', 'max:12' ],

        ]);



        $owner = new Owner;
        $owner->name = $request->owner_name;
        $owner->surname = $request->owner_surname;
        $owner->email = $request->owner_email;
        $owner->phone = $request->owner_phone;

        $owner->save();

        return redirect()->route('owner.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function show(Owner $owner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function edit(Owner $owner)
    {
        return view('owner.edit', ['owner' => $owner]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOwnerRequest  $request
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Owner $owner)
    {
        $request->validate([

            "owner_name" => ['required', 'alpha', 'min:2', 'max:15'],
            "owner_surname" => ['required', 'alpha', 'min:2', 'max:15'],
            "owner_email" => ['required', 'email'],
            "owner_phone" => ['required', 'regex:/(86|\+3706)\d{7}/', 'min:9', 'max:12' ],

        ]);

        $owner->name = $request->owner_name;
        $owner->surname = $request->owner_surname;
        $owner->email = $request->owner_email;
        $owner->phone = $request->owner_phone;

        $owner->save();

        return redirect()->route('owner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Owner $owner)
    {
        $tasks = $owner->ownerTasks;
        if (count($tasks) != 0) {
            return redirect()->route('owner.index')->with('error_message', 'Delete is not possible while owner has tasks.');
        }
        $owner->delete();
        return redirect()->route('owner.index')->with('success_message', 'Owner was deleted.');
    }
}
