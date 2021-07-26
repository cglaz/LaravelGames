## About LaravelGames

LaravelGames is a web application where you can find your favourites STEAM apps and games. You can make your own games list, check statistics in a dashboard for example top 10 games, games with the highest rates etc.

## Functionality

1.User and registry
-Auth system
-Creating User
-Editing and updating your own user profile
-Login or register with social media, like Facebook, Google, GitHub

2.User ones game list
-Add game from STEAM api
-Rate added game in user game list
-Delete game from list
-Show full details of game

3.User managment(If user is admin)
-Can see list of users
-Can see details of ones user

4.Dashboard - in this section of application you can see statistic of games from STEAM like:
-Total number of games
-Number of games with rate 70+
-The avarege rate of game
-The highest rate of games
-The lowest rate of game
-The games list with rate over 80+

5.Global list of games from STEAM API:
-In this section you can find games explorer, where you can find game, dlc or whatever you want by typing letters and numbers or if you want to be more specific, the explorer allows you to specify result by choosing which type of result do you want: Games, Dlc, Demo, Episodes, Video, Music, Movie, Mods


## Setup and instalation
1. composer install<br>
2. npm install<br>
3. php artisan serve<br>


STEAM API COMMANDS:
1. php artisan steam:load-games 1 -> Fetch games list from STEAM API to file
2. php artisan steam:load-games 2 -> Download games from STEAM and put them in app

## Specification

1.Front-End
-Bootstrap
-Saas
-HTML5

2.Back-end
-Laravel 7.24
-PHP 7.3
-MySQL

3.Database
-SQlite


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
