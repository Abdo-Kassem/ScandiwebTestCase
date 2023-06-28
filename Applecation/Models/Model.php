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

    public abstract function save():int;

    public abstract function deleteIN(array $skus):bool;

    /*return array off current object */
    public abstract function getAll(?array $attributes ):array;
    public abstract function skuExist($sku):bool|Exception;
    protected abstract function columnsEmpty():bool|Exception;


}

?>