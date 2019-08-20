<?php

class Router
{

    static public function parse($url, $request)
    {
        $url = trim($url);
        if ($url == "/Users/maloua-h/mamp/apache2/htdocs")
        {
            $request->controller = "tasks";
            $request->action = "index";
            $request->params = [];
        }
        else
        {
            $explode_url = explode('/', $url);
            // var_dump($explode_url);

            // $explode_url = array_slice($explode_url, 2);
            // var_dump($explode_url);
            // exit;
            if(isset($explode_url[1]))
            {
                $request->controller = $explode_url[1];
            }
            else
            {
                    $request->controller = "";
            }
            if(isset($explode_url[2]))
            {
                $request->action = $explode_url[2];
            }
            else
            {
                $request->action = "";
            }

            $request->params = array_slice($explode_url, 3);
        }
    }
}
?>