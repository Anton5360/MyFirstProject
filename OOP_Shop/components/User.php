<?php


namespace app\components;


class User
{
    private bool $isGuest = true;

    /**
     * @return bool
     */
    public function getIsGuest()
    {
        return $this->isGuest;
    }
}