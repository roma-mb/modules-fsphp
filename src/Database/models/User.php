<?php

namespace src\Database\models;

/**
 * @property int $id;
 * @property string $first_name;
 * @property string $last_name;
 * @property string $email;
 *
 */
class User extends Model
{
    protected static array $fillable = ['first_name', 'last_name', 'email', 'document'];
    protected static string $table = 'users';

    public function bootstrap(array $attributes): static
    {
        $isNotFillable = (bool)(array_diff(array_keys($attributes), self::$fillable));

        if($isNotFillable || !empty($this->bootstrap)) {
            $this->message = 'The model has not  bootstrapped check the fields';
            return $this;
        }

        $this->data = $attributes;

        return $this;
    }

    public function load(int $id, string $columns = '*'): User|bool|null
    {
        $query = "select {$columns} from " . self::$table . ' where id = :id;';
        $stmt = $this->read($query, "id={$id}");

        if ($this->fail()) {
            $this->message = 'User not found';
            return null;
        }

        return $stmt->fetchObject(__CLASS__);
    }

    public function find(?string $email, string $columns = '*'): User|bool|null
    {
        $query = "select {$columns} from " . self::$table . ' where email = :email';
        $stmt = $this->read($query, "email={$email}");

        if ($this->fail()) {
            $this->message = 'User not found at the email provided.';
            return null;
        }

        return $stmt->fetchObject(__CLASS__);
    }

    public function all(int $limit = 30, int $offset = 0): array|false|null
    {
        $query = "select * from " . self::$table . ' limit :limit offset :offset';
        $stmt = $this->read($query, "limit={$limit}&offset={$offset}");

        if ($this->fail()) {
            $this->message = 'Users not found';
            return null;
        }

        return $stmt->fetchAll(\PDO::FETCH_CLASS, __CLASS__);
    }

    public function save(): null|static
    {
        if ($this->required()) {
            return null;
        }

        $userId = empty($this->id)
            ? $this->persistOnCreate()
            : $this->persistOnUpdate();

        if($this->fail()) {
            return null;
        }

        $this->data = $this->read(
            'select * from ' . self::$table . ' where id = :id',
            ':id=' . $userId
        )?->fetch() ?? $this->data;

        return $this;
    }

    private function persistOnCreate()
    {
        $userId = $this->create($this->safe());

        $this->message = $this->fail()
            ? 'User not created'
            : 'User created';

        return $userId;
    }

    private function persistOnUpdate()
    {
        $userId = $this->update(
            $this->safe(),
            'id = :id',
            "id={$this->id}",
        );

        $this->message = $this->fail()
            ? 'User not updated'
            : 'User updated';

        return $userId;
    }

    public function destroy(): null|static
    {
        if(!empty($this->id)) {
            $this->delete('id = :id', "id={$this->id}");
        }

        if($this->fail()) {
            $this->message = 'User not deleted';
            return null;
        }

        $this->message = 'User deleted';
        $this->data = [];

        return $this;
    }

    public function required(): bool
    {
        $validation = [
            'fields' => empty($this->first_name) || empty($this->last_name) || empty($this->email),
            'invalid_email' => !filter_var($this->email, FILTER_VALIDATE_EMAIL),
            'already_email' => $this->find($this->email) && !$this->id
        ];

        $keyWithError = array_search(true, $validation, true);

        $this->message = [
            'fields' => '[first_name, last_name, email] is required',
            'invalid_email' => 'The email provided is not a valid email address.',
            'already_email' => 'Email already exists'
        ][$keyWithError] ?? '';

        return (bool)$this->message;
    }
}