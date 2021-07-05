<?php
namespace App\Http\Controllers\Website;

use File;
use Validator;
use App\Models\Settings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\MessageStatusTrait;

class SettingControlloer extends Controller
{
    use MessageStatusTrait;

    # Bind Type
    protected $type = 'settings ';

    # Bind location
    protected $view = 'website.';

    # Bind banner
    protected $settings;

   

    /**
     * default constructor
     * @param
     * @return
     */
    function __construct(Settings $settings) 
    {
        $this->settings   = $settings;

        #initilize pafination from config
        $this->page = config('paginate.pagination');
    }

    /**
     * index page of banner
     * @param Illuminate\Http\Request;
     * @return Illuminate\Http\Response;
     */
    public function index()
    {
        $setting = $this->settings->where('status', '1')->first();
        // dd($setting);
        # if nothing is given in input then return all
        return view($this->view.'contact-us')->with([
                                                   'setting' => $setting
                                                ]);
    }

    /**
     * Create page open
     * @param Illuminate\Http\Request;
     * @return Illuminate\Http\Response;
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * create banner
     * @param Illuminate\Http\Request;
     * @return Illuminate\Http\Response;
     */
    public function store(Request $request)
    {
        //  
    }

    /**
     * edit  page
     * @param Illuminate\Http\Request;
     * @return Illuminate\Http\Response;
     */
    public function update($id)
    {
      //
    }

    /**
     * edit banner
     * @param Illuminate\Http\Request;
     * @return Illuminate\Http\Response;
     */

   public function edit(Request $request, $id)
    {
        //    
    }


   

    /**
     * delete banner
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
    }

    /**
     * active deactive
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        //
    }   

}
    
            