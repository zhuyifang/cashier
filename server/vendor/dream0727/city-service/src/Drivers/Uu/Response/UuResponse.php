<?php

namespace CityService\Drivers\Uu\Response;

use CityService\ResponseInterface;

class UuResponse implements ResponseInterface
{
    private $result;

    public function __construct(array $result = [])
    {
        $this->result = $result;
    }

    public function getCode()
    {
        return $this->result['return_code'];
    }

    public function getOriginalData()
    {
    	return $this->result;
    }

    public function isSuccessful(): bool
    {
        return !is_null($this->getCode()) && $this->getCode() === 'ok';
    }

    public function getMessage():  ? string
    {
        return $this->result['return_msg'];
    }
}
