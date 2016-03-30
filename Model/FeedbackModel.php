<?php

namespace Model;


use Library\DbConnection;

class FeedbackModel
{
    public function save(array $message)
    {
        // TODO: проверить, чтобы в массиве $message были ключи как поля в таблице. Иначе - исключение

        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare('INSERT INTO feedback VALUES
                              (:id, :username, :email, :message, :created, :ip)');

        $sth->execute($message);
    }
}