<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Execution

Open a terminal and go to the directory of project, rename the file .env.example to .env, execute composer install. When finished execute the command php artisan key:generate.

Finally, execute the command php artisan serve and go to this follow url: http://localhost:8000/

## Requirements

- One player always chooses rock
- The other player always takes a random choice of rock, paper or scissors
- Following rules apply: rock beats scissors, paper beats rock, scissors beats paper. rock + rock = draw
- 100 rounds are to be played
- Show a statistic how often each player has won the round and how many draws.

## Code coverage

Also you can see a link to show a report of the code coverage done by unit test.