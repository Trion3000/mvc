<?php

return  array(
    // some default routes
    'default' => new Route('/', 'Index', 'index'),
    'index_php' => new Route('/index.php', 'Index', 'index'),

    // site
    'books_list' => new Route('/books', 'Book', 'index'),
    'book_page' => new Route('/book-{id}\.html', 'Book', 'show', array('id' => '[0-9]+') ),
    'contact_us' => new Route('/contact-us', 'Index', 'contact'),
    'cart_add' => new Route('/add/{id}', 'Cart', 'add', array('id' => '[0-9]+') ),
    'cart_list' => new Route('/cart', 'Cart', 'index'),
    'login' => new Route('/login', 'Security', 'login'),
    'logout' => new Route('/logout', 'Security', 'logout'),
    'register' => new Route('/register', 'Security', 'register'),
    'api_books_list' => new Route('/api/books', 'Book', 'apiBooksList'),

    // admin
    'admin_books_list' => new Route('/admin/books', 'AdminBook', 'index'),
    'admin_books_edit' => new Route('/admin/books/edit/{id}', 'AdminBook', 'edit', array('id' => '[0-9]+')),
    'admin_document_add' => new Route('/admin/docs/add', 'AdminDocument', 'add'),

   // 'devionity_style' => new Route('/{_controller}/{_action}/{id}')
);
