<?php

namespace App\Http\Controllers\Admin;

use File;
use Validator;
use App\User;
use App\Models\Product;
use App\Models\RatingReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Traits\MessageStatusTrait;

class RatingReviewController extends Controller
{
 use MessageStatusTrait;

 # Bind Type
 protected $type = 'User';


 # Bind location
 protected $view = 'admin.rating-review.';


 
#Bind User
 protected $user;
 protected $ratingreview;
 /**
  * default constructor
  * @param
  * @return
  */
   function __construct(
                          User      		$user, 
                          RatingReview  $ratingreview
                        )
     {
        $this->user         	= $user;
        $this->ratingreview   = $ratingreview;

        #initilize pafination from config
        $this->page = config('paginate.pagination');
     }
 
 	/**
  	* index page of user
  	* @param Illuminate\Http\Request;
  	* @return Illuminate\Http\Response;
  	*/
 	public function index(Request $request)
 	{  
 		$relation = [
 			'userData',
 			'productData',
 		];
     
      	# fetch sub ratingreview list 
      	$query = $this->ratingreview->with($relation)->where('status', 1)->get();
      	$rating = $this->ratingreview;
      	if (($request->status  == '') AND ($request->product_id == '') AND ($request->user_id == '')) {
        	# if nothing is given in input then return all
        	$ratingreview = $rating->orderBy('id','desc')	
                                  ->paginate(10);
      	} else {
        # Filtered Output
        $ratingreview = $rating->RatingreviewAddedBetween($request->status, $request->product_id, $request->user_id)
                                ->orderBy('id','desc')
                                ->paginate(10);
      	}
      	// dd($ratingreview);                  

    	return view($this->view.'index')->with([
                                        'rating'         	=> $rating ?? [],
                                        'query'         	=> $query ?? [],
                                        'ratingreview'  	=> $ratingreview ?? [],
                                        'status'        	=> $request->status ?? '',
                                        'product_id'      => $request->product_id ?? '',
                                        'user_id'       	=> $request->user_id ?? '',
                                         ]);
   	}

    /**
    * delete subcategory
    * @param $id
    * @return \Illuminate\Http\Response
    */
   	public function delete($id)
   	{
      $query = $this->user;

      #update deleted by
      $query->where('id', $id)->update(['deleted_by' => Auth::user()->id]);

      # delete subcategory by id
      $query->where('id', $id)->delete();
      
      # return success
      return  [$this->successKey  =>  $this->successStatus,  $this->messageKey  => $this->deleteMessage($this->type)];
   	}

    /**
    * active deactive
    * @param $id
    * @return \Illuminate\Http\Response
    */ 
   	public function status($id)
   	{
      # initiate constructor
      $query =  $this->ratingreview;

      # get the status 
      $status =  $query->where('id', $id)->first()->status;

      # check status, if active
      if ($status == '1') {
         #message
         $message = $this->inActiveMessage($this->type);

         # deactive( update status to zero)
         $statusCode = '0';
      } else {
         #message
         $message = $this->activeMessage($this->type);

         # active( update status to one)
         $statusCode = '1';
      }
     
         # update status code
         $query->where('id', $id)->update(['status' => $statusCode]);

      # return success
      return  [$this->successKey  =>  $this->successStatus,  $this->messageKey  => $message];
   	}



    /**
    * json responce of ratingreview id by ajax for dependent dropdown respons
    * @param
    * @return \Illuminate\Http\Response in json
    */
     public function jsonSubcategory(Request $request)
   	{
      # fetch ratingreview 
      $ratingreview = $this->ratingreview
                     ->where('category_id',$request->category_id)
                     ->where('status', '1')
                     ->select('id', 'name')
                     ->get();

      # return json responce
      return response()->json($ratingreview);
   	
   	} 


    /**
  * Create page
  * @param Illuminate\Http\Request;
  * @return Illuminate\Http\Response;
  */
  public function viewRating($id)
  {
      $rating = $this->ratingreview
                        ->where('id', $id)
                        ->first(); 
      # Return data on edit page
      return view($this->view.'view')->with(['rating' => $rating]);
 }

}
