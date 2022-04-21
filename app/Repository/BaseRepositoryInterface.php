<?php

namespace App\Repository;

interface BaseRepositoryInterface
{
    public function findById($id, array $columns = ['*']);

    public function findByEmail($email, array $columns = ['*']);

    public function getAllData();

    public function getAllDataByAnotherColumn($column, $value, $operator = '=');

    public function findByAnotherColumn($column, $value, $operator = '=');
}
