<?php

namespace App\Repositories\Contracts;



interface LogRepositoryInterface{
    public function all(string $column ='id',string $order='ASC');
    public function paginate(int $paginate = 10, string $column ='id',string $order='ASC');
    public function findWhereLike(array $columns, string $search,string $column ='id',string $order='ASC');
  
}




?>