<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Models\PropertyFeatured;
use App\Models\Image;
use App\Models\PropertyLocation;
use Illuminate\Support\Facades\Validator;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->input(), [
            'user_id' => 'required',
            'title' => 'required',
            'status' => 'required',
            'type' => 'required',
            'price' => 'required',
            'size' => 'required',
            'year' => 'required',
            'bedrooms' => 'required',
            'bathroom' => 'required',
            'garages' => 'required',
        ]);

        if ($validator->fails()) return response(['error' => $validator->errors()]);

        $property = Property::create($request->only('user_id', 'title', 'type', 'status', 'price', 'size', 'year', 'bedrooms', 'bathroom', 'garages'));


        if ($request->has('features')) {
            foreach ($request->features as $feature)
                PropertyFeatured::create(['name' => $feature, 'property_id' => $property->id]);
        }

        if ($request->has('images')) {
            foreach ($request->images as $image) {
                $newName = 'property_' . $request->user_id . "_" . now() . $image->extension();
                $image->move(public_path('uploads'), $newName);
                Image::create(['name' => $newName, 'imageable_type' => "App\\Models\\Property", "imageable_id" => $property->id]);
            }
        }

        return $property->load('propertyFeatureds', 'images');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        //
    }
}
