<?php

namespace Liteslim\Database;

use Exception;
use PDO;
use Liteslim\Library\DB;

class UserRepository
{

    private DB $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * @throws Exception
     */
    public function create(array $data): array
    {
        $uuid = bin2hex(random_bytes(16));
        $sql = "INSERT INTO users (uuid, name, email, password, created_at, updated_at, provider, provider_id, metadata) 
                VALUES (:uuid, :name, :email, :password, NOW(), NOW(), :provider, :provider_id, :metadata)";
        $this->db->setData([
            ':uuid' => $uuid,
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':password' => $data['password'],
            ':provider' => $data['provider']??'email',
            ':provider_id' => $data['provider_id']??'',
            ':metadata' => json_encode($data['metadata']??[])
        ]);
        if ($this->db->query($sql)) {
            return [
                'uuid' => $uuid,
                'name' => $data['name'],
                'email' => $data['email']
            ];
        }
        return [];
    }

    public function findById(string $uuid): ?array
    {
        $sql = "SELECT id, name, email, created_at, updated_at FROM users WHERE uuid = :uuid";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['uuid' => $uuid]);
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ?: null;
    }
}
