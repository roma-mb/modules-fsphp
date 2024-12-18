<?php

declare(strict_types=1);

namespace src\Database\models;

use PDO;
use PDOException;
use src\Database\connections\source\Providers\Connection;

abstract class Model
{
    protected static array $fillable = [];
    protected static string $table = '';

    protected ?array $data;
    protected ?PDOException $fail = null;

    protected ?string $message = '';

    public function __set(string $name, mixed $value)
    {
        $this->data[$name] = $value;
    }

    public function __get(string $name)
    {
        return $this->data[$name] ?? null;
    }

    public function __isset(string $name): bool
    {
        return (bool)($this->data[$name] ?? false);
    }

    public function data(): ?object
    {
        return $this->data;
    }

    public function fail(): ?PDOException
    {
        return $this->fail;
    }

    public function message(): ?string
    {
        return $this->message;
    }


    protected function create(array $data): false|string|null
    {
        $columns = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));

        try {
            $stmt = Connection::getInstance()->prepare(
                'insert into ' . static::$table . " ({$columns}) values ({$values})"
            );

            $stmt->execute($this->filter($data));

            return Connection::getInstance()->lastInsertId();
        } catch (PDOException $exception) {
            $this->fail = $exception;
            return null;
        }
    }

    protected function read(string $query, ?string $params = null): false|\PDOStatement|null
    {
        try {
            $stmt = Connection::getInstance()->prepare($query);
            parse_str($params, $paramsParsed);

            foreach ($paramsParsed as $key => $value) {
                $type = is_numeric($value) ? PDO::PARAM_INT : PDO::PARAM_STR;
                $stmt->bindValue(":{$key}", $value, $type);
            }

            $stmt->execute();
            return $stmt;
        } catch (PDOException $exception) {
            $this->fail = $exception;
            return null;
        }
    }

    protected function update(array $data, string $terms, string $params): mixed
    {
       $dataSet = [];

       foreach ($data as $key => $value) {
           $dataSet[] = "{$key} = :{$key}";
       }

       $columns = implode(', ', $dataSet);

       parse_str($params, $paramsParsed);

       try {
           $stmt = Connection::getInstance()->prepare(
               'update ' . static::$table . " set {$columns} where {$terms}"
           );

            $stmt->execute($this->filter([...$data, ...$paramsParsed]));

           return $this->id;
       } catch (PDOException $exception) {
           $this->fail = $exception;
           return null;
       }
    }

    protected function delete(string $terms, string $params): ?int
    {
        try {
            $stmt = Connection::getInstance()->prepare(
                'delete from ' . static::$table . " where {$terms}"
            );

            parse_str($params, $paramsParsed);

            $stmt->execute($paramsParsed);

            return $this->id;
        } catch (PDOException $exception) {
            $this->fail = $exception;
            return null;
        }
    }

    protected function safe(): array
    {
        $safeData = $this->data;

        $safeData['abobrinha'] = 123;

        $unSafeValues = array_diff(array_keys($safeData), static::$fillable);

        foreach ($unSafeValues as $key => $value) {
            unset($safeData[$value]);
        }

        return $safeData;
    }

    private function filter($data): array
    {
        $filter = [];

        foreach ($data as $key => $value) {
            $filter[$key] = $value === null ? null : filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        return $filter;
    }
}