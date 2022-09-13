<?php

namespace App\Http\Controllers\Client;
use App\Models\Tag;


use App\Models\Project;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user=Auth::user();
        $projects = Project::paginate();

        // $projects=$user->projects; //get all the projects


        //'with' for eager loading
        $projects=$user->projects()->with('category.parent')->paginate();

      

        return view('client.projects.index',[
            'projects'=>$projects
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types=['hourly','fixed'];

        $categories=Category::all();
        
        return view('client.projects.create',[
            'project'=>new Project(),
            'types'=>Project::types(),
            'categories'=>$categories,
            'tags'=>[]

        ]);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        //
        

        

        // 1st way to insert the user id to the data returned from the request
        // $request->merge([

        //     'user_id' => $request->user()->id, //Auth::id()
            
        // ]);

        // $project= Project::create($request->all());


        //2nd way
        
        $user=Auth::user(); //$request->user();     

        if($request->hasFile('attachments')){

        $files= $request->file('attachments');
        dd($files);
        foreach($files as $file){

        
            if($file->isValid()){
                //methods
                
                // $file->getClientOriginalName(); //get the real name if the file
                // $file->getClientOriginalExtension(); //get the original ex if the file ex: jpg png etc...
                // $file->getSize(); //get the size of the file
                // $file->getMTime(); //get the latest update on the file

                ////////////////////////////////////////////////////////////////

                $path =$file->store('/',[
                    'disk'=> 'public'
                ]);

                $request->merge([
                    'attachments'=>$path,
                ]);




            }

        }

        }

       
        $project= $user->projects()->create($request->all());
    

        $tags= explode(',',$request->input('tags'));

        

        
         

         $project->syncTags($tags);

        return redirect()->route('client.projects.index')->with('sucess','Project Added');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //my way
    // $user_id =Auth::id();
    // $project=Project::findOrFail($id);
    // if($project->user_id == $user_id){
    //     return view('client.projects.show',[
    //         'project'=> $project
    //     ]);
    // }

    $user=Auth::user();

    $project=$user->projects()->findOrFail($id);
   
    return view('client.projects.show',[
        'project'=> $project
    ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //my way
    // $user_id =Auth::id();
    // $project=Project::findOrfail($id);
    // if($project->user_id == $user_id){
    //     return view('client.projects.edit',[
    //         'project'=> $project
    //     ]);
    // }
    
     

    $user=Auth::user();
    $categories=Category::all();

    $project=$user->projects()->findOrFail($id);

    $tags= $project->tags()->pluck('name')->toArray();

   
    return view('client.projects.edit',[
        'project'=> $project,
        'types'=>Project::types(),
        'categories'=>$categories,
        'tags'=>$tags
    ]);
   
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, $id)
    {
        //
        $user=Auth::user();
         
        $project=$user->projects()->findOrFail($id);
        $project->update($request->all());
        $tags= explode(',',$request->input('tags'));

        $project->syncTags($tags);
        


        

        return redirect()->route('client.projects.index')->with('sucess','Project Updated');


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

        $project=Auth::user()->projects()->where('id',$id)->delete();

        return redirect()->route('client.projects.index')->with('sucess','Project Deleted');

    }
}
