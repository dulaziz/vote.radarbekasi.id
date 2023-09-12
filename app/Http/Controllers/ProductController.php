<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;

class ProductController extends Controller
{
    public function save(Request $request){
        $validator = \Validator::make($request->all(),[
           'product_name'=>'required|string|unique:products',
           'product_image'=>'required|image'
        ],[
            'product_name.required'=>'Product name is required',
            'product_name.string'=>'Product name must be a string',
            'product_name.unique'=>'This product name is already taken',
            'product_image.required'=>'Product image is required',
            'product_image.image'=>'Product file must be an image',
        ]);
        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
            $path = 'files/';
               $file = $request->file('product_image');
               $file_name = time().'_'.$file->getClientOriginalName();

            //    $upload = $file->storeAs($path, $file_name);
            $upload = $file->storeAs($path, $file_name, 'public');

               if($upload){
                   Product::insert([
                       'product_name'=>$request->product_name,
                       'product_image'=>$file_name,
                   ]);
                   return response()->json(['code'=>1,'msg'=>'New product has been saved successfully']);
                }
        }
    }

    public function fetchProducts(){
        $products = Product::all();
        $data = \View::make('all_products')->with('products', $products)->render();
        return response()->json(['code'=>1,'result'=>$data]);
    }

    public function getProductDetails(Request $request){
        $product = Product::find($request->product_id);
        return response()->json(['code'=>1,'result'=>$product]);
    }

    public function updateProduct(Request $request){
        $product_id = $request->pid;
        $product = Product::find($product_id);
        $path = 'files/';

        //Validate input    
        $validator = \Validator::make($request->all(),[
            'product_name'=>'required|string|unique:products,product_name,'.$product_id,
            'product_image_update'=>'image',
         ],[
             'product_image_update.image'=>'Product file must be an image',
         ]);

         if(!$validator->passes()){
            return response()->json(['code'=>0, 'error'=>$validator->errors()->toArray()]);
         }else{
            //Update product
            if($request->hasFile('product_image_update')){
                $file_path = $path.$product->product_image;
                //Delete old image
                if($product->product_image != null && \Storage::disk('public')->exists($file_path)){
                    \Storage::disk('public')->delete($file_path);
                }

                //Upload new image
                $file = $request->file('product_image_update');
                $file_name = time().'_'.$file->getClientOriginalName();
                $upload = $file->storeAs($path, $file_name, 'public');

                if($upload){
                    $product->update([
                        'product_name'=>$request->product_name,
                        'product_image'=>$file_name,
                    ]);
                    return response()->json(['code'=>1, 'msg'=>'Product has been update']);
                }

            }else{
                $product->update([
                    'product_name'=>$request->product_name,
                ]);

                return response()->json(['code'=>1, 'msg'=>'Product has been update successfully']);
            }
         }
    }

    public function deleteProduct(Request $request){
        $product = Product::find($request->product_id);
        $path = 'files/';
        $image_path = $path.$product->product_image;
        if($product->product_image != null && \Storage::disk('public')->exists($image_path)){
            \Storage::disk('public')->delete($image_path);
        }
        $query = $product->delete();
        if($query){
            return response()->json(['code'=>1, 'msg'=>'Product has been deleted successfully']);
        }else{
            return response()->json(['code'=>0, 'msg'=>'Something went wrong']);
        }
    }

}
