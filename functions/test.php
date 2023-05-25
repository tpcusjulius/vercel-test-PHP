<?php
function obtainMake ($year){
    $body = '{"year": "'.$year.'"}'; 
    $url = 'fitment/make';
    $makes = atdApiStandard('POST',$url,$body);
    if ($makes[1] !== "200") {
        throw new RuntimeException("unexpected response status: {$status_line}\n" . $response);
    }else{
        return $makes[0];
    }
}
$test = obtainMake(2009);
print($test);
function obtainModel ($year,$make){
    $body = '{"year": "'.$year.'","make": "'.$make.'"}'; 
    $url = 'fitment/model';
    $models = atdApiStandard('POST',$url,$body);
    if ($models[1] !== "200") {
        throw new RuntimeException("unexpected response status: {$status_line}\n" . $response);
    }else{
        return $models[0];
    }
}
$test2 = obtainModel(2009,"Audi");
print($test2);
function obtainTrim ($year,$make, $model){
    $body = '{"year": "'.$year.'","make": "'.$make.'","model": "'.$model.'"}'; 
    $url = 'fitment/trim';
    $trims = atdApiStandard('POST',$url,$body);
    if ($trims[1] !== "200") {
        throw new RuntimeException("unexpected response status: {$status_line}\n" . $response);
    }else{
        return $trims[0];
    }
}
$test3 = obtainTrim(2009,"Audi","A3");
print($test3);
function obtainTrimOptions ($year,$make,$model, $trim){
    $body = '{"year": "'.$year.'","make": "'.$make.'","model": "'.$model.'","trim": "'.$trim.'"}'; 
    $url = 'fitment/trim-option';
    $trimsoptions = atdApiStandard('POST',$url,$body);
    return $trimsoptions[0];
}
$test4 = obtainTrimOptions(2009,"Audi","A3","Quattro 3.2");
print($test4);
function obtainProductByFitment ($locationnumber,$year,$make,$model,$trim,$trimoption){
    $body = '{
                "locationnumber": "'.$locationnumber.'",
                "vehicle":{
                    "year": "'.$year.'",
                    "make": "'.$make.'",
                    "model": "'.$model.'",
                    "trim": "'.$trim.'",
                    "trimoption": "'.$trimoption.'"
                },
                "options":{
                    "images":{
                      "large":"true",
                      "small":"true",
                      "thumbnail":"true"
                    },
                    "price":{
                          "cost":1
                    }
                }
            }';
    $url = 'fitment/product-by-fitment';
    $productbyfitment = atdApiStandard('POST',$url,$body);
    return $productbyfitment[0];
}
$test5 = obtainProductByFitment(2390941,2009,"Audi","A3","Quattro 3.2","225/45R17 91Y");
print($test5);

function obtainLocationNumber ($zipzone){
    $body = '{
                "criteria":{
                    "zipcode": "'.$zipzone.'"
                }
            }';
    $url = 'location/location-by-criteria';
    $locationnumber = atdApiStandard('POST',$url,$body);
    if($locationnumber[1] === "200"){
        return $locationnumber[0];
    }else{
        $body = '{
                    "criteria":{}
                }';
        $locationnumber = atdApiStandard('POST',$url,$body);
        return $locationnumber[0];
    }
}
$test6 = obtainLocationNumber(0);
print($test6);
