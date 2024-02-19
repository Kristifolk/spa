<?php

namespace migration;

use mysqli;
use src\models\DB;

class AbstractMigration
{

    /** @var mysqli */
    public mysqli $connection;

    public function __construct(
        DB $db
    )
    {
        $this->connection = $db->instance();
    }
}