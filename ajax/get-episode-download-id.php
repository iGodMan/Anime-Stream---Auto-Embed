<?php
    include('../config.php');
    $link_path = $_POST['link'];
    $gogoAnimeDomain = 'https://www3.gogoanimes.fi/';

    $link = $gogoAnimeDomain.$link_path;

    header('Access-Control-Allow-Origin: *');
    $headers = getallheaders();
    $url = $link; // Replace with the desired URL
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($ch);
    curl_close($ch);
    
    $dom = new DOMDocument();
    @$dom->loadHTML($response);
    
    $elements = $dom->getElementsByTagName('li');
    $downloads = null;
    foreach ($elements as $element) {
        $className = $element->getAttribute('class');
        if ($className === 'dowloads') {
            $aElement = $element->getElementsByTagName('a')->item(0);
            if ($aElement) {
                $href = $aElement->getAttribute('href');
                break; // Found the desired element, no need to continue the loop
            }
        }
    }
    $parts = parse_url($href);
    $query = $parts['query'];
    parse_str($query, $queryParameters);
    $id = $queryParameters['id'];
    

    if($id)
    {
        $res['id'] = $id;
        $res['status'] = 'Ok';
        $res['remarks'] = 'ID GOt Successfully';
    }
    else
    {
        $res['status'] = 'faild';
        $res['remarks'] = 'faild';
    }
    echo json_encode($res);
?>