<?php

namespace app\interfaces;

interface ModelInterface
{
    public function getById(int $id);

    public function getALl();

    public function getTableName(): string;

}