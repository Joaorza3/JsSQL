<?php

class QueryValidations
{

    public static function validate($query)
    {
   
        $queryIsValid = true;

        if (preg_match('/^SELECT/', $query) !== 0) {
            $queryIsValid = true;
        }

        $notAllowedCommands = [
            'ALTER',
            'CREATE',
            'DELETE',
            'DROP',
            'INSERT',
            'REPLACE',
            'TRUNCATE',
            'UPDATE',
            'USE',
            'GRANT',
            'REVOKE',
            'LOCK',
            'UNLOCK',
            'RENAME',
            'SHOW',
            'HANDLER',
            'LOAD',
            'CALL',
            'EXPLAIN',
            'DESCRIBE',
            'HELP',
            'DO',
            'BEGIN',
            'START',
            'COMMIT',
            'ROLLBACK',
            'SAVEPOINT',
            '--',
        ];

        foreach ($notAllowedCommands as $command) {
            if (preg_match('/' . $command . '/', $query) !== 0) {
                $queryIsValid = false;
            }
        }

        return $queryIsValid;

    }
}
