<?php

namespace App\Repositories\Contracts;



interface RoleRepositoryInterface{
    public function all(string $column ='id',string $order='ASC');
    public function paginate(int $paginate = 10, string $column ='id',string $order='ASC');
    public function findWhereLike(array $columns, string $search,string $column ='id',string $order='ASC');
    public function create(array $data):bool;
    public function find(int $id);
    public function update(array $data, int $id):bool;
    public function delete(int $id):bool;
}




?>