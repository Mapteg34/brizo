<?php

use App\Models\User;
use App\Models\Book;
use App\Models\Author;
use App\Models\Transfer;
use Illuminate\Database\Seeder;

class ExampleSeeder extends Seeder
{
    const USERS = [
        'test1@malahov-artem.ru',
        'test2@malahov-artem.ru',
        'test3@malahov-artem.ru',
        'test4@malahov-artem.ru',
    ];

    const BOOKS = [
        'book1',
        'book2',
        'book3',
    ];

    const AUTHORS = [
        'author1',
        'author2',
        'author3',
    ];

    const TRANSFERS = [
        ['user_index' => 0, 'book_index' => 0],
        ['user_index' => 0, 'book_index' => 1],
        ['user_index' => 0, 'book_index' => 2],
        ['user_index' => 1, 'book_index' => 0],
        ['user_index' => 1, 'book_index' => 1],
        ['user_index' => 2, 'book_index' => 2],
    ];

    private $users;
    private $books;
    private $authors;

    private function createUsers()
    {
        $this->users = [];
        foreach (static::USERS as $email) {
            $user = User::whereEmail($email)->first();

            if (empty($user)) {
                $user = User::create([
                    'name'     => $email,
                    'email'    => $email,
                    'password' => bcrypt($email),
                ]);
            }

            $this->users[] = $user;
        }
    }

    private function createBooks()
    {
        $this->books = [];
        foreach (static::BOOKS as $name) {
            $book = Book::whereName($name)->first();

            if (empty($book)) {
                $book = Book::create(['name' => $name]);
            }

            $this->books[] = $book;
        }
    }

    private function createAuthors()
    {
        $this->authors = [];
        foreach (static::AUTHORS as $name) {
            $author = Author::whereName($name)->first();

            if (empty($author)) {
                $author = Author::create(['name' => $name]);
            }

            $this->authors[] = $author;
        }
    }

    private function createTransfers()
    {
        foreach (static::TRANSFERS as $data) {
            Transfer::create([
                'user_id' => $this->users[$data['user_index']]->id,
                'book_id' => $this->books[$data['book_index']]->id,
            ]);
        }
    }

    public function run()
    {
        $this->createUsers();
        $this->createBooks();
        $this->createAuthors();
        $this->createTransfers();
    }
}
