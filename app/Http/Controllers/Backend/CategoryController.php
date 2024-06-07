<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use function PHPUnit\Framework\fileExists;

class CategoryController extends Controller
{
    public function createCategory ()
    {
       if(Auth::user()){
                if(Auth::user()->role == 1){
                    return view ('backend.admin.category.create');
                }
       }
    }

    public function storeCategory (Request $request)
    {
        if(Auth::user()){
            if(Auth::user()->role == 1){
                $category = new Category();

                $category->name = $request->name;
                $category->slug = Str::slug($request->name);
                
                if(isset($request->image)){
                   $imageName = rand().'-category-'.'.'.$request->image->extension(); 
                   $request->image->move('backend/images/category/' ,$imageName);

                   $category->image = $imageName;


                }

                $category->save();
                toastr()->success('successfully Created');
                return redirect()->back();
            }
        }
    }

    public function showCategory () 
   {
        if(Auth::user()){
            if(Auth::user()->role == 1){

                $categorys =  Category::get();
                return view ('Backend.admin.category.list',compact('categorys'));
            }
        }


   }


   public function deleteCategory ($id)
   {
        if(Auth::user()){
            if(Auth::user()->role==1){
                $category = Category::find($id);
        
                if($category->image && file_exists('backend/images/category/'.$category->image)){
                    unlink('backend/images/category/'.$category->image);
                }
                $category->delete();
                toastr()->success('successfully Deleted');
                return redirect()->back();
            }
        }
       
   }

   public function editCategory ($id)
   {
        if(Auth::user()){
            if(Auth::user()->role ==1){
                $category = Category::find($id);
    
                return view ('Backend.admin.category.edit',compact('category'));
            }
        }
   }


   public function updateCategory (Request $request, $id)
   {
        if(Auth::user()){
            if(Auth::user()->role == 1){
                $category = Category::find($id);

                $category->name = $request->name;
                $category->slug = Str::slug($request->name);
        
        
                if(isset($request->image)){
        
                    if($category->image && file_exists('backend/images/category/'.$category->image)){
                        unlink('backend/images/category/'.$category->image);
                    }
        
                    $imageName = rand().'-categoryup-'.'.'.$request->image->extension(); 
                    $request->image->move('backend/images/category' ,$imageName);
        
                    $category->image = $imageName;
        
                 }
        
                 $category->save();
                 toastr()->success('successfully updated');
                 return redirect('/admin/category/list');
        
            }
        }



   }
 
        
    
}
