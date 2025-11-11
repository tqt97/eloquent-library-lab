<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Category;
use App\Models\Library;
use App\Models\Login;
use App\Models\Publisher;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => Hash::make('12341234'),
        // ]);

        // User::factory()->create([
        //     'name' => 'User',
        //     'email' => 'user@gmail.com',
        //     'password' => Hash::make('12341234'),
        // ]);

        // User::factory(10)->create()->each(function ($user) {
        //     $user->logins()->saveMany(Login::factory(10)->make());
        // });

        $libraries = Library::factory(3)->create();
        $authors = Author::factory(20)->create();
        $categories = Category::factory(10)->create();
        $publishers = Publisher::factory(5)->create();

        // User and login
        $users = collect();
        foreach ($libraries as $library) {
            $libUsers = User::factory(rand(10, 20))->create([
                'library_id' => $library->id,
            ]);

            // seed login bulk
            $logins = $libUsers->flatMap(
                fn ($user) => Login::factory(rand(3, 5))->make(['user_id' => $user->id])
            );
            Login::insert($logins->toArray());

            $users = $users->merge($libUsers);
        }

        // Book
        $books = collect();
        foreach ($libraries as $library) {
            $libBooks = Book::factory(rand(20, 40))->create([
                'library_id' => $library->id,
                'publisher_id' => $publishers->random()->id,
            ]);

            // attach author & category (pivot)
            foreach ($libBooks as $book) {
                $book->authors()->attach($authors->random(rand(1, 3))->pluck('id'));
                $book->categories()->attach($categories->random(rand(1, 2))->pluck('id'));
            }

            $books = $books->merge($libBooks);
        }

        // Borrowing
        $borrowings = Borrowing::factory(100)->make()->map(function ($borrowing) use ($users, $books) {
            $borrowing->user_id = $users->random()->id;
            $borrowing->book_id = $books->random()->id;

            return $borrowing->toArray();
        });
        Borrowing::insert($borrowings->toArray());

        // Review (polymorphic)
        $reviews = Review::factory(50)->make()->map(function ($review) use ($users, $books) {
            $review->user_id = $users->random()->id;
            $review->reviewable_id = $books->random()->id;
            $review->reviewable_type = Book::class;

            return $review->toArray();
        });
        Review::insert($reviews->toArray());
    }
}
