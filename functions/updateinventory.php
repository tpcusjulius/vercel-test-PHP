<?php
require "find-product-by-id.php";
require "../restygraph/restapishopify.php";
require "../restygraph/graphqlapishopify.php";
function productByIdShopify ($id,$invetoryValor){
  $url = '/admin/api/2023-01/graphql.json';
  $query = '
  {
    inventoryItems(query: "sku:'.$id.'", first: 5) {
      edges {
        node {
          id
          sku
          inventoryLevel(locationId: "gid://shopify/Location/78969602335") {
            available
            id
          }
        }
      }
    }
  }
  ';
  $response = grapQlShopify($query,$url);
  $data = json_decode($response,true);
  $inventoryLevel = $data['data']['inventoryItems']['edges'][0]['node']['inventoryLevel']['id'];
  $query = '
  mutation AdjustInventoryQuantity($input: InventoryAdjustQuantityInput!) {
    inventoryAdjustQuantity(input: $input) {
      inventoryLevel {
        id
        available
        incoming
        item {
          id
          sku
        }
        location {
          id
          name
        }
      }
    }
  }
  {
    "input": {
      "inventoryLevelId": "'.$inventoryLevel.'",
      "availableDelta": '.$invetoryValor.'
    }
  }
  ';
  $response = grapQlShopify($query,$url);
  $data = json_decode($response);
  echo($response);
}
  
productByIdShopify("123456",-1);