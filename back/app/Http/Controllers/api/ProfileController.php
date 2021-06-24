<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Storage;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = Profile::all();
        return $profile;
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
    public function store(ProfileRequest $request, Profile $profile)
    {
        // $profile = $request->file('file');
        // $path = Storage::disk('s3')->put('profile', $profile, 'public');
        $profile = new Profile;
        $profile->fill($request->all());
        $profile->user_id = $request->user()->id;
        $profile->save();
        return $profile;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = Profile::Where('user_id', $id)->first();
        return $profile;
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
        $profile = Profile::find($id);
        $profile->fill($request->all())->save();
        return $profile;

        
    }

    public function updateimage(Request $request, $id)
    {
        $this->validate($request, [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024'
        ], [
            'file.required' => '画像が選択されていません',
            'file.image' => '画像ファイルではありません',
            "file.mines" => "指定された拡張子（PNG/JPG/GIF）ではありません。",
            "file.max" => "容量が1Ｍを超えています。",
        ]);

        $id = $request->user()->id;
        $profile = Profile::Where('user_id', $id)->first(); 
        $file = $profile->file_path;
        $s3_delete = Storage::disk('s3')->delete($file);
        $image = $request->file('file');
        $path = Storage::disk('s3')->put('profile', $image, 'public');
        // $profile->file_path = Storage::disk('s3')->url($path);
        $profile->file_path = $path;
        $profile->save();
        return $profile;
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
