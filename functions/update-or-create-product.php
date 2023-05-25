<?php
require "find-product-by-id.php";
require "../restygraph/restapishopify.php";
require "../restygraph/graphqlapishopify.php";
function productByIdShopify ($id){
    $query = '
    {
      products(first: 10, query: "tag:' . $id  . '") {
        edges {
          node {
            id
          }
        }
      }
    }
    ';
    $url = '/admin/api/2023-01/graphql.json';
    $response = grapQlShopify($query,$url);
    $product = json_decode($response);
    $flag = $product->data->products->edges;
    if (count($flag) == 0) {
        $product = productByIdAtd($id);
        if(json_decode($product) !== null){
            //crea el producto aqui
            $product = json_decode($product);
            // Acceder a los valores del objeto
            $style = $product->products[0]->style;
            $description = $product->products[0]->description;
            $cost = $product->products[0]->price->cost;
            $small_image = $product->products[0]->images->small->image[0]->url ?? "";
            echo($small_image);
            $body = '{
              "product": {
                "title": "'.$style.'",
                "body_html": "'.$description.'",
                "vendor": "Aqui podemos poner la tienda que lo vende",
                "product_type": "Neumatico",
                "tags": "'.$id.'",
                "images": [
                  {
                    "src": "'.$small_image.'"
                  }
                ],
                "variants": [
                  {
                    "price": '.$cost.',
                    "inventory_quantity": 1
                  }
                ]
              }
            }';
          $url = 'products.json';
          $product = atdApiShopify('POST',$url,$body);
          return $product;
        }else{
            echo($product);
        }
        die();
    }
    $product = $product->data->products->edges[0]->node->id;
    preg_match('/\d+/', $product, $matches);
    $id = $matches[0];
    $body = '{
        "product": {
            "title": "Hola de nuevoasdfafsd xd",
            "body_html": "Nueva descripción del producto 3"
          }
    }';
    $url = 'products/'.$id.'.json';
    $product = atdApiShopify('PUT',$url,$body);
    return json_encode($product);
}