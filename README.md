# Setup

Clone this repository:

`git clone {repo}`

Install Composer Dependencies:

`composer install`

Install NPM Dependencies:

`npm install`

Create a copy of your .env file and Setting your database connection:

`cp .env.example .env`

Generate an app encryption key:

`php artisan key:generate`

Migrate the database:

`php artisan migrate`

Seeding dummy data Kost:

`php artisan db:seed`


# Running the app

Run project with this command:

`php artisan serve`
