<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    private static $product, $image, $imageUrl, $imageName, $extension, $directory;

    public static function getImageUrl($request)
    {
        self::$image = $request->file('image');
        self::$extension = self::$image->getClientOriginalExtension();
        self::$imageName = time().'.'.self::$extension;
        self::$directory = 'product-images/';
        self::$image->move(self::$directory, self::$imageName);
        return self::$directory.self::$imageName;
    }

    public static function createProduct($request)
    {
        self::$product = new Product();
        self::$product->product_name        = $request->product_name;
        self::$product->group_name          = $request->group_name;
        self::$product->description         = $request->description;
        self::$product->price               = $request->price;
        self::$product->image               = self::getImageUrl($request);
        self::$product->save();
    }

    public static function updateProduct($request, $id)
    {
        self::$product = Product::find($id);
        if ($request->file('image'))
        {
            if (file_exists(self::$product->image))
            {
                unlink(self::$product->image);
            }
            self::$imageUrl = self::getImageUrl($request);
        }
        else
        {
            self::$imageUrl = self::$product->image;
        }

        self::$product->product_name        = $request->product_name;
        self::$product->group_name          = $request->group_name;
        self::$product->description         = $request->description;
        self::$product->price               = $request->price;
        self::$product->image               = self::$imageUrl;
        self::$product->save();
    }

    public static function deleteProduct($id)
    {
        self::$product = Product::find($id);
        if (file_exists(self::$product->image))
        {
            unlink(self::$product->image);
        }
        self::$product->delete();
    }
}
