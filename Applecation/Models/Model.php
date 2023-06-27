<?php

namespace Applecation\Models;

use Applecation\Liberary\DBConnection\DBConnection ;
use Exception;
use PDO;

abstract class Model
{
    protected string $table;
    protected PDO $pdo;

    public function __construct(string $table)
    {
        $this->table = $table;
        $this->pdo = DBConnection::createPDO();
    }

    public abstract function update():bool;
    public abstract function save():int;

    public abstract function deleteIN(array $skus):bool;
    //public abstract function delete():bool|Exception;
    //public abstract function deleteWhere():bool|Exception;
    //protected abstract function truncate();

    public abstract function getAll(?array $attributes):array;
    public abstract function getByID($id,?array $attributes):?self;

    public abstract function where($property , $value , $operator='='):self;
    public abstract function orWhere($property , $value , $operator='='):self;
    protected abstract function columnsEmpty():bool|Exception;


}

?>