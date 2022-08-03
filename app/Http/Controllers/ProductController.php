<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
        $products = Product::all();
        
        $data = array();

        foreach($products as $product){
            $category=Category::where("id",$product->CategoryId)->get();
            if(!empty($category)){
                
                $category = $category[0];
                $updated_product = array(
                    "id" => $product->id,
                    "productName" => $product->ProductName,
                    "category" => $category->CategoryName      
                );
                array_push($data, $updated_product);
            }
        }
        Log::info($data);
        return view('productView',compact('data'));
        }catch(QueryException $error){
            error_log($error->getMessage());
           // handle error from cient side
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            $categories=Category::all();
        return view('product',compact('categories'));
        }catch(QueryException $error){
             error_log($error->getMessage());
            // handle error from cient side
         }
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // req -> category and productName

        $validator = Validator::make($request->all(),[
            "productName" => "required",
            "category" => "required"
        ]);

    
        if($validator->fails()){
            return redirect('product/create')
                        ->withErrors($validator)
                        ->withInput();
        }

         try{
             $products  = Product::create([
                 "ProductName" => $request->productName,
                 "CategoryId" => $request->category
             ]);
             return redirect('/product');
             // add validations

         }catch(QueryException $error){
             error_log($error->getMessage());
            // handle error from cient side
         }
               
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
        try{
        $product = Product::where('id', $id)->first();
        return view('productUpdate',compact('product'));
        }catch(QueryException $error){
            error_log($error->getMessage());
        }
    
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
        // req -> productName

        $validator = Validator::make($request->all(),[
            "productName" => "required"
        ]);

    
        if($validator->fails()){
            return redirect('product/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        try{
            Product::where('id',$id)->update(['ProductName'=>$request->productName]);
            return redirect('/product');
        }catch(QueryException $error){
            error_log($error->getMessage());
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        error_log('delete here');
        try{
            Product::where('id',$id)->delete();
            return redirect('/product');
        }catch(QueryException $error){
            error_log($error->getMessage());
        }
    }
}
