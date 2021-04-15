<?php
declare(strict_types=1);

namespace app\backend\logic;

interface Logic
{
    public function paginator($params);

    public function add($params);

    public function edit($id, $params);

    public function view($id);

    public function delete($id);
}
