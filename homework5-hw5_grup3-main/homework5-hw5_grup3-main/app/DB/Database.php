<?php

namespace App\DB;


use App\DB\Engine\DriverInterface;

class Database
{
    protected DriverInterface $driver;

    public function setDriver(DriverInterface $driver): void {
        $this->driver = $driver;
    }
    public function all(string $table): array{
        return $this->driver->all($table);
    }
    public function find(string $table, mixed $id):mixed{
        return $this->driver->find($table, $id);
    }
    public function create(string $table, array $values): bool{
        return $this->driver->create($table, $values);
    }
    public function update(string $table, mixed $id, array $values): bool{
        return $this->driver->update($table, $id, $values);
    }
    public function delete(string $table, mixed $id): bool{
        return $this->driver->delete($table, $id);
    }


}