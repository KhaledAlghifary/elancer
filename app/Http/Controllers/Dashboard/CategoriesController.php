<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use App\Rules\FilterRule;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{

    protected $rules=[
        'name'=>['required',  'string', 'between:2,255','filter' //the filter what we make in AppServiceProvider
        ,'age'=>'required'
       
    
    ], 
        'parent_id'=>['required','nullable','int','exists:categories,id'],

        'description'=>['nullable','string'],


        'art_path'=>['nullable','image'],
        

    ];

    protected $messages=[
        'required'=>'The :attribute field is mandatory',
        'description.string'=>'The :d field can not be non-string'
    ]; //to replace the built in messages

    
    //Actions
    
    public function index()
    {
       //$categories= DB::table('categories')->get();
    //    $categories=Category::leftJoin('categories as parents','parents.id','=','categories.parent_id')
    //    ->select([
    //     'categories.*',
    //     'parents.name as parent_name'
    //    ])->paginate(3); //to determine how many category showed

       $title='Categories';
       $categories=Category::get();
       $category=new Category();
     
        
       //$flash_message=session('success');
    //    $flash_message=session()->get('success',false); //false: default value if not found

    //another same method
    //    $flash_message=Session::get('success');

    //Session::forget('success'); //delete the value from session used when using the put in session fascade
        return view('categories.index',compact('title','categories','category'));

        // same as above return
        //return view('categories',[
        //     'categories'=>$categories,
        //     'title'=> 'Categories'
        // ]);

        //View::make 'facade view'
        //Response::view 'facade view'
    }


    public function table(Request $request){

        $category=new Category();

        // $categories->leftJoin('categories as parents','parents.id','=','categories.parent_id')
        //     ->select([
        //      'categories.*',
        //      'parents.name as parent_name'
        //     ]);
       
        $categories=Category::with('parent')->orderByDesc('id');
                    
        // $categories=Category::query();
            
        
        
        $categories->when($request->input('name'), function ($query, $xName) {
            $query->where('name', 'LIKE', "%$xName%");
        });

        return view('categories.categoriesTable',[

            'categories'=>$categories->paginate(3),

        ]);


    }

    public function show(Category $category)
    {
        
        // $category= DB::table('categories')->where('id','=',$id)->first();
        // $category=Category::where('id','=',$id)->first();
        //$category=Categor::find($id); //same 
        if($category==null){
            abort(404);
        }
        // return view('categories.show',compact('category'));
        return $category;
    }

    public function create(){
        $categories=Category::get();
        $category=new Category();
        return view('categories.create',compact('categories','category'));
    }

    public function store(Request $request){
        //validation
       
        $clean=$request->validate($this->rules(),$this->messages);

        
        

        //$clean=$this->validate($request,$rules,$messages);//this means controller

        //The main approach
        // $validator=Validator::make($request->all(),$rules,$messages);
        // $clean=$validator->validate();
        

        //to see the erros by boolean function
        
    //    if($validator->fails()){//return true or false
    //     return redirect()->back()->withErrors($validator); //this what really happens when calling validate
    //      }

   // $validator->failed(); //return the rows failed

        //*************************************************************************** */
        
        //  dd($request->name);
        // same wa ys to get data as above
        //  $request->input('name')
        //  $request->post('name')
        //  $request->get('name')
        //  $request['name']
        //  $request->query('name')

        // DB::table('categories')->insert([
        //     'name'=$request->name,
            
        // ]);

        // $category= new Category();
        // $category->name=$request->name;
        // $category->description=$request->description;
        // $category->parent_id=$request->parent_id;
        // $category->slug=Str::slug($request->name);


        // $category->save();

        $data=$request->all();
        if(!$data['slug']){
            $data['slug']=Str::slug($data['name']);
        }
    

        $category=Category::create($data); // create an object but take the _token with, we can specify the inputs in model


        //PRG Post Redirect Get
        return redirect('/dashboard/categories')->with('success','Category Created!');

    }

    public function edit(Category $category){
        // $category=Category::findOrFail($id);
        $categories=Category::get();
        return view('categories.edit',compact('category','categories'));


    }

    public function update(Request $request,Category $category){
      
        // $category=Category::findOrFail($id);
        $clean=$request->validate($this->rules(),$this->messages);

        
        $category->name=$request->name;
        $category->description=$request->description;
        $category->parent_id=$request->parent_id;
        $category->slug=Str::slug($request->name);
        

        $category->save();
        //PRG Post Redirect Get
        // return redirect('/dashboard/categories')->with('success','Category Updated!');
        return $category;

    }


    public function destroy(Category $category){

        // DB::table('categories')->where('id',$id)->delete();
        //  Category::where('id',$id)->delete();

        // $category= Category::findOrFail($id);
        $category->delete();

       // Category::destroy($id);


        // session()->flash('success','Category deleted!');
        // Session::flash('success','Category deleted!');

        //we cant write in session

        //Session::put('success','Category Deleted!');


        // return redirect('/dashboard/categories');
        // ->with('sucess','Category Deleted!');

        return $category;

    }
    
    protected function rules(){
        $rules=$this->rules;
        //this method is locally
        // $rules['name'][]= function($attribute,$value,$fail){
        //     if($value=='god'){
        //         $fail('this word is not allowed');
        //     }

        // };



        //the same code using rule
        $rules['name'][]= new FilterRule('m7md');


        // $rules['name'][]= 'filter';


        return $rules;

    }

    
}
