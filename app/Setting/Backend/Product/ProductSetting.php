<?php
namespace App\Setting\Backend\Product;


/**
 * 
 */
trait ProductSetting
{
    

    public function productSetting(array $parameter)
    {
       
        if(count($parameter) == 0)return false;

        $products = [
            //module
            "imageSize" => [
                //sub-module
                "uploadProduct" => [
                    "height" => 150,
                    "width" => 200,
                ],
                "upload" => [
                    "width" => 200,
                    "height" => 150,
                ],
            ],
            //module
            "imageUpload" =>[
                "location" =>[
                    "storage_disk" => 'public',
                    "storage_location" => "backend/product/product",
                ]
            ],
            //module
            "brand" => true,

            //module
            "unit" =>[
                "product_import" => [
                    'allow' => 1
                ]
            ]
        ];

        if($parameter[2] == "height")
        {
            return $products['imageSize']['uploadProduct']['height'];
        } 
        else if($parameter[2] == "width")
        {
            return $products['imageSize']['uploadProduct']['width'];
        }
        else if($parameter[2] == "storage_location")
        {
            return $products['imageUpload']['location']['storage_location'];
        }


        if(isset($parameter[0]) && array_key_exists($parameter[0],$products))
        {
            if(isset($products[$parameter[0]]) && array_key_exists($parameter[1],$products[$parameter[0]][$parameter[1]]))
            {
                //if(isset($products[$parameter[0]][$parameter[1]][$parameter[1]]))
                return $products[$parameter[0]][$parameter[1]][$parameter[2]];
            }
            else{
                return $products[$parameter[0]];
            }
            return $products[$parameter[0]];
        }else{
            return "nai";
        }
        if(isset($parameter[0]) && in_array($parameter[0],$products))
        {

        }
        return array_key_exists('uploadProduct',$products);
       return in_array($parameter[0],$parameter);
        if(in_array($parameter[0],$parameter))
        if(array_key_exists($parameter[0],$parameter))
        {

        }


        if($parameter[2] == "height")
        {
            return $products['imageSize']['uploadProduct']['height'];
        } 
        else if($parameter[2] == "width")
        {
            return $products['imageSize']['uploadProduct']['width'];
        }
        return $products['imageSize']['uploadProduct']['height'];
        return in_array($parameter,$products);
        return $products;
    }


}
