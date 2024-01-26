<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\AddProductRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Http\Requests\User\AvatarRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function product() {
        return ProductResource::collection(Product::all());
    }

    public function add(AddProductRequest $request)
    {
        $product = Product::create($request->all());

        return response()->json([
            'data' => [
                'id' => $product->id,
                'status' => 'created'
            ]
        ])->setStatusCode('200', "Created");
    }

    public function remove($id) {
        Product::find($id)->delete();

        return response()->json([
            'data' => [
                'id' => $id,
                'status' => 'removed'
            ]
        ])->setStatusCode('200', "Removed");
    }

    public function update(UpdateRequest $request, $id) {
        Product::find($id)->update($request->all());

        return response()->json([
            'data' => [
                'id' => $id,
                'status' => 'updated'
            ]
        ])->setStatusCode('200', "Updated");
    }

    public function category($category) {
        return ProductResource::collection(Product::where('category_id', $category)->get());
    }

    public function image(AvatarRequest $request, $id) {
        $product = Product::find($id);

        if($product->photo_file)
            Storage::disk('products')->delete($product->photo_file);

        $product->update([
            'photo_file' => $request->photo_file->storePublicly('', ['disk' => 'products']),
        ]);

        return response()->json([
            'data' => [
                'id' => $product->id,
                'status' => true
            ]
        ])->setStatusCode('200', "Updated");
    }
}
