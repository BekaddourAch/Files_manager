<?php

namespace App\Http\Controllers;

use App\Models\Fichier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FichierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files=Fichier::all();
        return view("welcome",compact('files'));
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
        // $uploadedFile = $request->file('file');
        // $filename = time().$request->file('upload_file');
  
        // Storage::disk('local')->put(
        //   'files/'.$filename,
        //   $uploadedFile,
        //   $filename
        // );
        $request->validate([
            'file' => 'required|mimes:csv,txt,xlx,xls,pdf,jpg,xls,doc,png|max:2048'
            ]);
            $fileModel = new Fichier;
            if($request->file()) {
                $fileName = time().'_'.$request->file->getClientOriginalName();
                 $extension = File::extension($request->file->getClientOriginalName());
                $filePath = $request->file('file')->storeAs('uploads/', $fileName,'public');
                $fileModel->name = $request->name;
                $fileModel->file_name = $fileName;
                $fileModel->extention=$extension;
                $fileModel->size=$request->file->getSize();
                $fileModel->path = 'storage/' . $filePath;
                $fileModel->save();
                return redirect()->back();
         //return route("file.index");
                // return back()
                // ->with('success','File has been uploaded.')
                //->with('file', $fileName);
            } 
        //  $files=new Fichier();
        //  $files->name=$request->name;
        //  $files->extention=$request->extention;
        //  $files->size=22;
        //  $files->path='files/'.$filename;
        //  $files->save();
        //  return redirect("file.index")->back();
    }
    public function get_file($id)
    {
        $thi_file=Fichier::findorfail($id);

        $destination = storage_path('app\public\uploads\\');  
$filename = $thi_file->file_name;
$pathToFile = $destination.$filename;
return response()->download($pathToFile,$filename);
         //return  $id;
        /**this will force download your file**/
        //return response()->download($path);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $thi_file=Fichier::findorfail($id);
        $destination = storage_path('app\public\uploads\\');  
        $filename = $thi_file->file_name;
        $pathToFile = $destination.$filename; 
        // if(File::exists($pathToFile)){

        //     File::delete($pathToFile);
        if(file_exists($pathToFile)){
            unlink($pathToFile);
            /*

                Delete Multiple File like this way

                Storage::delete(['upload/test.png', 'upload/test2.png']);

            */

        }else{

            dd('File does not exists.'.$pathToFile);

        }
        $thi_file->delete();
        return redirect()->back();
    }
}
