<?php

namespace App\Services;

/**
 * Class UserService
 * @package App\Services
 */
class UserService extends BaseService
{
    /**
     * Find row by id
     *
     * @param $id
     * @return array
     */
    public function getOne($id) : array
    {
        return $this->db->fetchAssoc('SELECT * FROM users WHERE "id" = ? ', [(int)$id]);
    }

    /**
     * Get all rows
     *
     * @return array
     */
    public function getAll() : array
    {
        return $this->db->fetchAll('SELECT * FROM users ORDER BY id');
    }

    /**
     * Store a new user
     *
     * @param $user
     * @return array
     */
    public function save($user) : array
    {
        $this->db->insert('users', $user);
        return $this->getOne($this->db->lastInsertId());
    }

    /**
     * @param int $id
     * @param array $user
     */
    public function update($id, $user) : array
    {
        $this->db->update('users', $user, ['id' => $id]);
        return $this->getOne($id);
    }

    /**
     * Delete the selected user
     *
     * @param $id
     * @return int
     * @throws \Doctrine\DBAL\Exception\InvalidArgumentException
     */
    public function delete(int $id)
    {
        return $this->db->delete('users', ['id' => $id]);
    }
}
