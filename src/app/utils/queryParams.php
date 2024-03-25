<?php
function createOrUpdateParams(string $params){
    $queryParams_original = $_GET;
    parse_str($params, $arrayParams);
    foreach ($arrayParams as $key => $value) {
        $queryParams_original[$key] = $value;
    }
    return $_SERVER['REDIRECT_URL'] . '?' . http_build_query($queryParams_original);
}
function removeParams(array $params){
    $queryParams_original = $_GET;
    foreach ($params as $value) {
        if(isset($queryParams_original[$value])){
            unset($queryParams_original[$value]);
        }
    }
    return  count($queryParams_original) > 0 ? $_SERVER['REDIRECT_URL'] . '?' . http_build_query($queryParams_original) : $_SERVER['REDIRECT_URL'];
}
function removeParamsWithoutURI(string $url, array $params=[]){
    $urlParams = parse_url($url);
    parse_str($urlParams['query'], $queryParams);

    foreach ($params as $value) {
        if(isset($queryParams[$value])){
            unset($queryParams[$value]);
        }
    }
    return  count($queryParams) > 0 ? $urlParams['path'] . '?' . http_build_query($queryParams) : $urlParams['path'];
}
