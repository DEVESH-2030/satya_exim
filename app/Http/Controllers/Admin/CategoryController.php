<?php
namespace App\Http\Controllers\Admin;
use File;
use Validator;
use App\Models\Category;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Traits\MessageStatusTrait;

class CategoryController extends Controller
{
    use MessageStatusTrait;

    # Bind Type
    protected $type = 'Category ';

    # Bind location
    protected $view = 'admin.category.';

    # Bind Category
    protected $category;

    /**
     * default constructor
     * @param
     * @return
     */
    function __construct(Category $category)
    {
        $this->category = $category;
        #initilize pafination from config
        $this->page = config('paginate.pagination');
    }

    /**
     * index page of category
     * @param Illuminate\Http\Request;
     * @return Illuminate\Http\Response;
     */
    public function index(Request $request)
    {


        # Validate requests
        $query = $this->category;

        if (($request->status == '') and ($request->name == ''))
        {
            # if nothing is given in input then return all
            $categories = $query->orderBy('id', 'desc')->take('10')
                              ->paginate(10);
        }else{
            # Filtered Output
            $categories = $query->categoryAddedBetween($request->status, $request->name)
                                ->orderBy('id', 'desc')->take('10')
                              ->paginate(10);
        }

        # return to index page
        return view($this->view . 'index')->with([
                                                   'categories' => $categories,
                                                   'status' => $request->status ?? '', 
                                                   'name' => $request->name ?? ''
                                                ]);
    }

    /**
     * Create page open
     * @param Illuminate\Http\Request;
     * @return Illuminate\Http\Response;
     */
    public function create(Request $request)
    {
        return view($this->view . 'create');
    }

    /**
     * create category
     * @param Illuminate\Http\Request;
     * @return Illuminate\Http\Response;
     */
    public function store(Request $request)
    {

      $data = ['name' => 'required','image' => 'required'];

        # validation check
        $validator = Validator::make($request->all() , $data);
        if($validator->fails())
         {
            return response()->json([
                                      (string)$this->errorKey=>(string)$this->errorStatus, 
                                      'message' => 'Required field is missing.'
                                    ]);
         }

        try {
          
           $query = $this->category;
           
           # check the requested category already exist or not
           $checkCategory = $query->where('name', $request->name)->first();
           
           if($checkCategory)
            {   
              return response()->json([
                                        (string)$this->errorKey=>(string)$this->errorStatus, 
                                        'message' => 'Sorry, this category already exist.'
                                      ]);  
            }  

             # upload banner
            if ($request->hasfile('image'))
            {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $filename =((string)(microtime(true)*10000)).'.'.$extension;
                $file->move(public_path('images/category/'), $filename);
                $banner='images/category/'.$filename;
            }else{
                $banner = null;
            }


            $slug = strtolower(preg_replace('/[^a-zA-Z0-9_.]/', '_', $request->name));

            $final_slug = preg_replace('/_+/', '_', $slug);

            # request param
            $arrayData = [
                           'name'           => $request->name ?? null, 
                           'slug'           => $final_slug ?? null, 
                           'status'         => '1', 
                           'image'          => $banner,
                         ];     

            #store
            $createCategory = $query->create($arrayData);  
            
            return response()->json([
                                      (string)$this->successKey=>(string)$this->successStatus, 
                                      'message' => 'Category Added Successfully.'
                                    ]);                      

        } catch (Exception $e) {
           // dd($e);
            return response()->json([
                                      (string)$this->errorKey=>(string)$this->errorStatus, 
                                      'message' => 'Something went wrong.'
                                    ]);  
        }
       
    }

    /**
     * edit  page
     * @param Illuminate\Http\Request;
     * @return Illuminate\Http\Response;
     */
    public function update($id)
    {
        # Fetch category by id
        $category = $this->category
                         ->where('id', $id)
                         ->first();
        # code...
        return view($this->view . 'edit')->with(['category' => $category]);
    }

    /**
     * edit category
     * @param Illuminate\Http\Request;
     * @return Illuminate\Http\Response;
     */

   public function edit(Request $request, $id)
    {

      $data = ['name' => 'required'];

        # validation check
        $validator = Validator::make($request->all() , $data);
        if($validator->fails())
         {
            return response()->json([
                                      (string)$this->errorKey=>(string)$this->errorStatus, 
                                      'message' => 'Required field is missing.'
                                    ]);
         }

        try {
          
           $query = $this->category->where('id', $id)->first();
           
           # check the requested category already exist or not
           $checkCategory = $query->where('name', $request->name)
                                  ->where('id', '!=', $id)
                                  ->first();

           
           if($checkCategory)
            {   
              return response()->json([
                                        (string)$this->errorKey=>(string)$this->errorStatus, 
                                        'message' => 'Sorry, this category already exist.'
                                      ]);  
            }  

             # upload banner
            if ($request->hasfile('image'))
            {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $filename =((string)(microtime(true)*10000)).'.'.$extension;
                File::delete(public_path($query->image));
                $file->move(public_path('images/category/'), $filename);
                $banner='images/category/'.$filename;
            }else{
                $banner = $query->image;
            }

           
            $slug = strtolower(preg_replace('/[^a-zA-Z0-9_.]/', '_', $request->name));

            $final_slug = preg_replace('/_+/', '_', $slug);

            # request param
            $arrayData = [
                           'name'           => $request->name ?? null, 
                           'slug'           => $final_slug ?? null, 
                           'image'          => $banner
                         ];     

            #update
            $updateCategory = $query->update($arrayData);  
            
            return response()->json([
                                      (string)$this->successKey=>(string)$this->successStatus, 
                                      'message' => 'Category Updated Successfully.'
                                    ]);                      

        } catch (Exception $e) {
           // dd($e);
            return response()->json([
                                      (string)$this->errorKey=>(string)$this->errorStatus, 
                                      'message' => 'Something went wrong.'
                                    ]);  
        }
       
    }


   

    /**
     * delete category
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $query = $this->category;

        #update deleted by
        $query->where('id', $id)->update(['deleted_by' => Auth::user()->id]);

        # delete category by id
        $query->where('id', $id)->delete();

        # return success
        return [$this->successKey => $this->successStatus, $this->messageKey => $this->deleteMessage($this->type) ];
    }

    /**
     * active deactive
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        # initiate constructor
        $query = $this->category;

        # get the status
        $status = $query->where('id', $id)->first()->status;

        # check status, if active
        if ($status == '1')
        {
            #message
            $message = $this->inActiveMessage($this->type);

            # deactive( update status to zero)
            $statusCode = '0';
        }
        else
        {
            #message
            $message = $this->activeMessage($this->type);

            # active( update status to one)
            $statusCode = '1';
        }

        # update status code
        $query->where('id', $id)->update(['status' => $statusCode]);

        # return success
        return [$this->successKey => $this->successStatus, $this->messageKey => $message];
    }
}

