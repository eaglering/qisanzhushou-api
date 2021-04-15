<?php

namespace app\core\logic;

use app\core\enums\ResponseEnum;

abstract class Logic
{
    protected $code = ResponseEnum::SUCCESS;

    protected $error = '';

    protected function hasError() {
        return !$this->code || $this->error;
    }

    protected function setError($error) {
        $this->code = ResponseEnum::ERROR;
        $this->error = $error;
    }

    public function getCode() {
        return $this->code;
    }

    public function getError() {
        return $this->error;
    }
}
