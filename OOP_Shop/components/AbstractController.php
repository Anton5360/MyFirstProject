<?php


namespace app\components;


abstract class AbstractController
{
    public function redirect(string $address, int $status = 301, bool $terminate = true)
    {
        header("Location: {$address}", true, $status);
        if($terminate){
            exit;
        }
    }
}