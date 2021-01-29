<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
         $this->middleware('permission:product-create', ['only' => ['create','store']]);
         $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(5);
        return view('products.index',compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }


    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request)
    {
        // return Datatables::of(User::query())->make(true);


        $userdata = Product::select('products.id','products.name','products.detail','products.created_at', 'products.updated_at');
            
        return DataTables::of($userdata)
            ->filter(function ($query) use ($request) {
                // if ($request->has('role') && $request->get('role') != '') {
                //     $query->where(function ($q) use ($request) {
                //         $q->where('users.role', 'like', "%{$request->get('role')}%");
                //     });
                // }
                // if ($request->has('status') && $request->get('status') != '') {
                //     $query->where(function ($q) use ($request) {
                //         $q->where('users.status', 'like', "%{$request->get('status')}%");
                //     });
                // }
     
                if ($request->has('name') && $request->get('name') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('products.name', 'like', "%{$request->get('name')}%");
                    });
                }
                if ($request->has('detail') && $request->get('detail') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('products.detail', 'like', "%{$request->get('detail')}%");
                    });
                }
            })
            // ->addColumn('role', function ($userdata) {
            //       return $role = ($userdata->role==0) ? 'Admin' : 'User' ;;
            // })
            // ->addColumn('status', function ($userdata) {
            //       return $status = ($userdata->status==1) ? 'Active' : 'Inactive' ;;
            // })
            
            // ->addColumn('action', function ($userdata) {
            //    $link = '<a href="' . route('product.delete', $userdata->id) . '" class="btn btn-xs btn-danger"><i class="fas fa-eye"></i> Delete</a> ';
            //     return $link;
            // })
            // ->addColumn('Delete', function($user) {
            //     // return view('products.actions', ['name' => 'James']);
            //     // return View::make('home', ['name' => 'James']);
            //     // return view('home');
            // })
            ->addColumn('action', 'products.actions')
            // ->rawColumns(['actions'])
            ->make(true);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
    
        Product::create($request->all());
    
        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('products.edit',compact('product'));
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
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
    
        $product->update($request->all());
    
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product->delete();
    
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }
}
