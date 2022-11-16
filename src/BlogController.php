<?php

namespace CT\Blog;

use Illuminate\Support\Facades\File;  
use Illuminate\Support\Facades\Lang;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use CT\Blog\blog_category;
//use App\Http\Requests;
use CT\Blog\author;
use CT\Blog\blog;
use CT\Blog\type;
use CT\Blog\SEO;
use Redirect;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $model = blog_category::whereNull('cat_id')->get();
        $author = author::all();
        $data = blog_category::whereNotNull('cat_id')->get();
        return view('Blog::blogs.add',compact(['model','author','data']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create(){
        $author = author::all();
        $model = blog_category::whereNull('cat_id')->get();
        $data = blog_category::whereNotNull('cat_id')->get();
        return view('Blog::add',compact(['model','author','data']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $flag =0;
        // $request->validate([
        //     'author'=>'required',
        //     'title'=>'required|min:3',
        //     'content' =>'required',
        // ],
        // [
        //     'author'=>'You cant leave author field empty',
        //     'title'=>'You cant leave title field empty',
        //     'content'=>'The field content is required',
        // ]);

        $messsages = array(
            'author'=>'You cant leave author field empty',
            'title'=>'You cant leave title field empty',
            'content'=>'The field content is required',
        );
        $rules = array(
            'author'=>'required',
            'title'=>'required|min:3',
            'content' =>'required',
        );
        $errors = [];
        foreach($request->post() as $key => $err){
            if(($key == 'title' || $key == 'content' || $key == 'author') && ($err == null || $err == 'Select Author')){
                $errors[$key] = $messsages[$key];
                $flag = 1;
            }
        }
        if($flag == 1){
            return back();
        }

            $model = new blog();

            if(empty($request->slug)){
                $slug = preg_replace('/[@\.\;\#]+/','', $request->title);
                $slug = strtolower($slug);
                $slug = str_replace(" ", "_", $slug);
            }
            else{
                $slug = preg_replace('/[@\.\;\#]+/','', $request->slug);
                $slug = strtolower($slug);
                $slug = str_replace(" ", "_", $slug);
            }

            $data = blog::all();
            foreach($data as $d){
                if($d->slug == $slug){
                    return back()->with('slug', 'This slug is already Exist Please add Different Slug ');
                }
            }

            if(!empty($request->file('image'))){

                $fileName = $request->file('image')->getClientOriginalName();
                $fileName = date('d-m-Y-H-i').'-'.$fileName;
                $path = public_path('root/blog/image/');

                if(!File::isDirectory($path))
                {
                    File::makeDirectory($path, 0777, true, true);
                    $request->file('image')->move($path, $fileName);
                }
                else
                {
                    $request->file('image')->move($path, $fileName);
                }

                $model->image = $fileName;
            }
            if(!empty($request->file('video'))){


                $fileName2 = $request->file('video')->getClientOriginalName();
                $fileName2 = date('d-m-Y-H-i').'-'.$fileName2;
                $path = public_path('root/blog/video/');

                if(!File::isDirectory($path))
                {
                    File::makeDirectory($path, 0777, true, true);
                    $request->file('video')->move($path, $fileName2);
                }
                else
                {
                    $request->file('video')->move($path, $fileName2);
                }
                $model->video = $fileName2;
            }

            $model->title = $request->title;
            $model->slug = $slug;

            $model->content = $request->content;
            $model->author = $request->author;
            $model->category = serialize($request->category);
            $model->status = 'Publish';
            if(empty($request->publish)){
                $model->publish_date = date('Y-m-d');
            }else{
                $date = date('Y-m-d',strtotime($request->publish));
                $model->publish_date = $date;
            }

        if($model->save()){
            $b_id = blog::latest()->first();
            $data = new SEO();
            if(empty($request->meta_title)){
                $data->title = $request->title;
            }
            else{
                $data->title = $request->meta_title;
            }

            if(empty($request->meta_disc)){
                $datas = substr($request->content, 0,150);
                $data->discription = $datas; 
            }
            else{
                $data->discription  = $request->meta_disc;

            }

            if(empty($request->meta_keyword)){
                $data->key_word = $request->title;
            }
            else{
                $data->key_word = $request->meta_keyword;
            }

            $data->type = 'Blog';
            $data->type_id = 1;
            $data->blog_id = $b_id->id;
            // exit();
            // echo $b_id->id;
            if($data->save()){
                return back()->with('done','Blog is Published Successfully');
            }
            else{
                return back()->with('done','Blog is not Publish Due to some issue <br>Something Went wrong!');
            }

        }
        else{
            return back()->with('done','Blog is not Publish Due to some issue <br>Something Went wrong!');

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(blog $blog)
    {
        $blog = blog::all();
        $model = blog_category::whereNull('cat_id')->get();
        $author = author::all();
        $data = blog_category::whereNotNull('cat_id')->get();
        return view('Blog::blogs.blog_list',compact(['blog','model','data','author']));
    }

    public function publish($id){
        $blog = blog::where(['id' => $id])->first();
        $blog->status = 'Publish';
        if(empty($request->publish)){
            $blog->publish_date = date('Y-m-d');
        }else{
            $blog->publish_date = $request->publish;
        }
        $blog->save();
        return redirect()->back();
    }

    public function shows()
    {
        $blog = blog::all();
        $model = blog_category::whereNull('cat_id')->get();
        $author = author::all();
        $data = blog_category::whereNotNull('cat_id')->get();
        return view('Blog::blogs.blog_list',compact(['blog','model','data','author']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $blog = blog::where(['id' => $id])->first();
        $model = blog_category::whereNull('cat_id')->get();
        $author = author::all();
        $data = blog_category::whereNotNull('cat_id')->get();
        return view('Blog::blogs.add',compact(['blog','model','author','data']));   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        echo $id;
        echo "<pre>";
        print_r($request->file());
        exit();
        $get = blog::where(['id' => $id])->first();
        $model = blog_category::whereNull('cat_id')->get();
        $author = author::all();
        $data = blog_category::whereNotNull('cat_id')->get();
        return view('Blog::blogs.add',compact(['model','get','author','data']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $id = $request->delete_id;
        $model = blog::where(['id' => $id])->delete();
        return redirect('blog_list');
        
    }

    public function blog_list(){
        $blog = blog::all();
        $model = blog_category::whereNull('cat_id')->get();
        $author = author::all();
        $data = blog_category::whereNotNull('cat_id')->get();
        return view('Blog::blogs.blog_list',compact(['blog','model','data','author']));
    }

    public function draft(Request $request)
    {
        $flag = 0;
        $messsages = array(
            'author'=>'You cant leave author field empty',
            'title'=>'You cant leave title field empty',
            'content'=>'The field content is required',
            'image'=>'The field image is required',

        );
        $rules = array(
            'author'=>'required',
            'title'=>'required|min:3',
            'content' =>'required',
            'image' =>'required',

        );
        $errors = [];
        foreach($request->post() as $key => $err){
            if(($key == 'title' || $key == 'content' || $key == 'author') && ($err == null || $err == 'Select Author')){
                $errors[$key] = $messsages[$key];
                $flag = 1 ;
            }
        }
        if($flag == 1){
            return back();
        }

            $model = new blog();

            if(empty($request->slug)){
                $slug = preg_replace('/[@\.\;\#]+/','', $request->title);
                $slug = strtolower($slug);
                $slug = str_replace(" ", "_", $slug);
            }
            else{
                $slug = preg_replace('/[@\.\;\#]+/','', $request->slug);
                $slug = strtolower($slug);
                $slug = str_replace(" ", "_", $slug);
            }

            $data = blog::all();
            foreach($data as $d){
                if($d->slug == $slug){
                    return back()->with('slug', 'This slug is already Exist Please add Different Slug ');
                }
            }

            if(!empty($request->file('image'))){

                $fileName = $request->file('image')->getClientOriginalName();
                $fileName = date('d-m-Y-H-i').'-'.$fileName;
                $path = public_path('root/blog/image/');

                if(!File::isDirectory($path))
                {
                    File::makeDirectory($path, 0777, true, true);
                    $request->file('image')->move($path, $fileName);
                }
                else
                {
                    $request->file('image')->move($path, $fileName);
                }

                $model->image = $fileName;
            }
            if(!empty($request->file('video'))){

                $fileName2 = $request->file('video')->getClientOriginalName();
                $fileName2 = date('d-m-Y-H-i').'-'.$fileName2;
                $path = public_path('root/blog/video/');

                if(!File::isDirectory($path))
                {
                    File::makeDirectory($path, 0777, true, true);
                    $request->file('video')->move($path, $fileName2);
                }
                else
                {
                    $request->file('video')->move($path, $fileName2);
                }
                $model->video = $fileName2;
            }

            $model->title = $request->title;
            $model->slug = $slug;

            $model->content = $request->content;
            $model->author = $request->author;
            $model->category = serialize($request->category);

        if($model->save()){
            $data = new SEO();
            if(empty($request->meta_title)){
                $data->title = $request->title;
            }
            else{
                $data->title = $request->meta_title;
            }

            if(empty($request->meta_disc)){
                $datas = substr($request->content, 0,150);
                $data->discription = $datas; 
            }
            else{
                $data->discription  = $request->meta_disc;

            }

            if(empty($request->meta_keyword)){
                $data->key_word = $request->title;
            }
            else{
                $data->key_word = $request->meta_keyword;
            }

            $data->type = 'Blog';
            $data->type_id = 1;
            if($data->save()){
                return back()->with('done','Blog is Saved Successfully');
            }
            else{
                return back()->with('done','Blog is not save Due to some issue <br>Something Went wrong!');
            }

        }
        else{
            return back()->with('done','Blog is not saved Due to some issue <br>Something Went wrong!');

        }
    }


    public function category(){
        $cat_id = $_GET['cat_id'];
        $data = blog_category::where(['cat_id'=>$cat_id])->get();

        foreach($data as $d){

            echo '<input type="checkbox" class= "m-1 text" value="'.$d->title.'" name="category[]">'.$d->title;

       }
    }

    public function add_category(Request $request){
        $model = new blog_category();
        $model->title = $request->category;
        $model->discription  = $request->disc;

        $fileName = $request->file('image')->getClientOriginalName();
        $fileName = date('d-m-Y-H-i').'-'.$fileName;
        $path = public_path('root/blog_category/image/');
        if(!File::isDirectory($path))
        {
            File::makeDirectory($path, 0777, true, true);
            $request->file('image')->move($path, $fileName);
        }
        else
        {
            $request->file('image')->move($path, $fileName);
        }
        $model->image = $fileName;
        $model->save();

    }

    public function add_sub_cat(Request $request){
        $model = new blog_category();
        $model->title = $request->category;
        $model->discription  = $request->disc;
        $model->cat_id  = $request->parent_cat;

        $fileName = $request->file('image')->getClientOriginalName();
        $fileName = date('d-m-Y-H-i').'-'.$fileName;
        $path = public_path('root/blog_category/image/');

        if(!File::isDirectory($path))
        {
            File::makeDirectory($path, 0777, true, true);
            $request->file('image')->move($path, $fileName);
        }
        else
        {
            $request->file('image')->move($path, $fileName);
        }
        $model->image = $fileName;
        $model->save();

    }

    public function display(){
        $date = date('Y-m-d');
        $category = blog_category::all();
        $data = blog::where('publish_date','<=',$date)->get();
        return view('Blog::User.Blog_list',compact(['data','category']));
    }

    public function filter(Request $request){

        return redirect('blog_category/'.$request->category);
    }
    public function cat_filter($cat){
        $date = date('Y-m-d');
        $category = blog_category::all();
        $data = blog::where('category', 'like', '%' . $cat .'%')
                    ->where('publish_date','<=',$date)
                    ->get();
        return view('Blog::User.Blog_list',compact(['category','data']));
    }

    public function detail($slug){
        $data = blog::where(['slug' => $slug])->get();
        return view('Blog::User.blog_detail',compact('data'));
    }
}
