<?php

namespace migration;

class Login extends AbstractMigration
{
    public function process(): void
    {
        $query = "SELECT * FROM users WHERE id = '$id'";//
        $result = mysqli_query($this->connection, $query);

        if ($result) {
            $this->insert();
        }

    }

    private function insert(): void
    {
        $query = "SELECT * FROM users WHERE id = '$id'";//
        mysqli_query($this->connection, $query);
    }
}