<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

use Image;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $user = User::find( auth()->user()->id );
        $boss = User::find( $user->parentid );
        $Subordinates = User::where( 'parentid', auth()->user()->id )->get();

        return view('pages.profile')
            ->with( 'user', auth()->user() )
            ->with( 'boss', $boss )
            ->with( 'sub', $Subordinates );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required',
            'avatar' => 'max:2048|mimes:jpeg,png',
        ]);

        $user = User::find( $id );
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;

        if( !empty( $request->avatar ) )
        {
            if( !empty( $user->avatar ) )
            {
                $file = storage_path() . '/app/public/'. $user->avatar;
                $rmfile = unlink( $file );
            }

            // $croppedImage = Image::make( $request->file( 'avatar' ) );
            // $croppedImage->fit(50, 50);

            $path = $request->avatar->store( 'public/avatars' );
            $user->avatar = ltrim( $path , '/public/' );
        }

        $user->save();

        return redirect()->route( 'profile' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
