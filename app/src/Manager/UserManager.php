<?php

namespace App\Manager;

use App\Entity\User;

class UserManager extends BaseManager
{

    /**
     * @return User[]
     */
    public function getAllUsers(): array
    {
        $query = $this->pdo->query("select * from User");

        $users = [];

        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $users[] = new User($data);
        }

        return $users;
    }

    public function getByUsername(string $username): ?User
    {
        $query = $this->pdo->prepare("SELECT * FROM User WHERE username = :username");
        $query->bindValue("username", $username, \PDO::PARAM_STR);
        $query->execute();
        $data = $query->fetch(\PDO::FETCH_ASSOC);

        if ($data) {
            return new User($data);
        }

        return null;
    }

    public function insertUser(User $user)
    {
        $roles = implode(", ", $user->getRoles());
        $query = $this->pdo->prepare('
            INSERT INTO User (
                password, username, email, firstName, lastName, gender, roles
            ) VALUES (
                   "' . $user->getPassword()  .'", "'.$user->getUsername().'", "'.$user->getEmail().'", "'.$user->getFirstName().'", "'.$user->getLastName().'", "'.$user->getGender().'", "'.$roles.'"
            );');
        var_dump($query->queryString);
        $query->execute();
    }
}
