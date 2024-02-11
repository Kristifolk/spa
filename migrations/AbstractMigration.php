<?php

namespace migration;

use models\DB;
use mysqli;

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