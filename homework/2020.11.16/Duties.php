<?php


class Duties
{
    private string $name = '';
    private string $surName = '';
    protected array $memory =[];

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSurName(): string
    {
        return $this->surName;
    }

    /**
     * @param string $surName
     */
    public function setSurName(string $surName): void
    {
        $this->surName = $surName;
    }
}