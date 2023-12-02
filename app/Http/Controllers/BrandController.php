<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BrandController extends Controller
{
    //

    public function AllBrand(){

        $brands = Brand::latest()->paginate(10);
        $trashBrand = Brand::onlyTrashed()->latest()->paginate('5');
        return view('admin.brand.index', compact('brands', 'trashBrand'));
    }

    public function AddBrand(Request $request) {

        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|max:255',
            'brand_image' => 'required|mimes:jpg,jpeg,png',
        ],[
            'brand_name' => 'Please input brand name',
            'brand_name.max' => 'Brand name must be less than 255 character',
            'brand_image:mimes' => 'Required file extension: jpg, jpeg, or png'
        ]);

        $brand_image = $request->file('brand_image');

        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $image_name = $name_gen.'.'.$img_ext;
        $up_loc = 'image/brand/';
        $last_img = $up_loc.$image_name;

        $brand_image->move($up_loc, $image_name);


        Brand::insert([

            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now()
        ]);


        return redirect()->back()->with('success','Brand Inserted Successfully');
    }

    public function Edit($id){

        $brands = Brand::find($id);
        return view('admin.brand.edit', compact('brands'));

    }
    // public function Update(Request $request, $id) {

    //     $update = Brand::find($id)->update([
    //         'brand_name'=> $request->brand_name,
    //         'brand_image'=> $request->brand_image,
    //         'user_id' => Auth::user()->id
    //     ]);

    //     return Redirect()->route('brand')->with('success', 'Updated Successfully');
    // }

    public function Update(Request $request, $id) {
        $request->validate([
            'brand_name' => 'required|max:255',
            'brand_image' => 'required|mimes:jpg,jpeg,png',
        ], [
            'brand_name.required' => 'Please input brand name',
            'brand_name.max' => 'Brand name must be less than 255 characters',
            'brand_image.required' => 'Please upload a brand image',
            'brand_image.mimes' => 'Required file extension: jpg, jpeg, or png'
        ]);

        $brand = Brand::find($id);

        // Check if a new image is provided
        if ($request->hasFile('brand_image')) {
            // Delete the old image
            if (file_exists($brand->brand_image)) {
                unlink($brand->brand_image);
            }

            // Upload and save the new image
            $brand_image = $request->file('brand_image');
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $image_name = $name_gen . '.' . $img_ext;
            $up_loc = 'image/brand/';
            $last_img = $up_loc . $image_name;
            $brand_image->move($up_loc, $image_name);

            // Update the brand with the new image path
            $brand->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_img,
                'user_id' => Auth::user()->id,
            ]);
        } else {
            // Update the brand without changing the image
            $brand->update([
                'brand_name' => $request->brand_name,
                'user_id' => Auth::user()->id,
            ]);
        }

        return redirect()->route('brand')->with('success', 'Updated Successfully');
    }


    public function RemoveBrand($id){

        $remove = Brand::find($id)->delete();
        return redirect()->back()->with('success','Brand Removed Successfully');
    }

    public function RestoreBrand($id){

        $restore = Brand::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success','Brand Restored Successfully');
    }

    public function DeleteBrand($id){

        $delete = Brand::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success','Brand Deleted Successfully');
    }
}
