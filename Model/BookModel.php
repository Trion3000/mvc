<?php


class BookModel
{
    public function findById($id)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare('SELECT * FROM book WHERE id = :book_id');
        $params = array(
            'book_id' => $id
        );
        $sth->execute($params);

        $book = $sth->fetch(PDO::FETCH_ASSOC);

        if (!$book) {
            throw new NotFoundException("book #{$id} not found");
        }

        return $book;
    }


    public function findAll($status = true)
    {
        $sql = "SELECT * FROM book";
        if ($status) {
            $sql .= ' WHERE status = 1';
        }

        $sql .= ' ORDER BY price';

        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->query($sql);
        $sth->execute();

        $data = $sth->fetchAll(PDO::FETCH_ASSOC);

        if (!$data) {
            throw new NotFoundException('Books not found');
        }

        return $data;
    }

    public function findByIdArray(array $ids)
    {
        if (!$ids) {
            return array();
        }

        $params = array();

        foreach ($ids as $v) {
            $params[] = '?';
        }

        $params = implode(',', $params);

        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare("SELECT * FROM book WHERE status = 1 AND id IN ({$params}) ORDER BY price");
        $sth->execute($ids);

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save(array $book)
    {
        // TODO: проверить, чтобы в массиве $message были ключи как поля в таблице. Иначе - исключение
        // TODO: использовать этот же метод для добавления книг. Проверка на is_null(id) => формируем соответсвующую строку с запросом

        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare('UPDATE book SET title = :title, description = :description, price = :price, status = :status where id = :id');
        $sth->execute($book);
    }
}
























