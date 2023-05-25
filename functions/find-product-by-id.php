<?php
require_once "../restygraph/restapiatdstandar.php";
function productByIdAtd ($id){
    $body = '{
                "locationnumber": "2390941",
                "criteria": {
                    "atdproductnumber": [
                        "'.$id.'"
                    ]
                },
                "options":{
                    "images":{
                        "small":1
                    },
                    "price":{
                        "cost":1
                    },
                    "availability":{
                        "localPlus":1
                    }
                }
            }';
    $url = 'product/product-by-criteria';
    $product = atdApiStandard('POST',$url,$body);
    if($product[1]!=200){
        return "Id incorrecto, producto no existe";
    }else{
        return $product[0];
    }
}