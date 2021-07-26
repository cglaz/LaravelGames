## About LaravelGames

LaravelGames is a web application where you can find your favourites STEAM apps and games. You can make your own games list, check statistics in a dashboard for example top 10 games, games with the highest rates etc.

## Functionality

1.User and registry
-Auth system<br>
-Creating User<br>
-Editing and updating your own user profile<br>
-Login or register with social media, like Facebook, Google, GitHub<br>

2.User ones game list
-Add game from STEAM api<br>
-Rate added game in user game list<br>
-Delete game from list<br>
-Show full details of game<br>

3.User managment(If user is admin)
-Can see list of users<br>
-Can see details of ones user<br>

4.Dashboard - in this section of application you can see statistic of games from STEAM like:
-Total number of games<br>
-Number of games with rate 70+<br>
-The avarege rate of game<br>
-The highest rate of games<br>
-The lowest rate of game<br>
-The games list with rate over 80+<br>

5.Global list of games from STEAM API:
-In this section you can find games explorer, where you can find game, dlc or whatever you want by typing letters and numbers or if you want to be more specific, the explorer allows you to specify result by choosing which type of result do you want: Games, Dlc, Demo, Episodes, Video, Music, Movie, Mods


## Setup and instalation
1. composer install<br>
2. npm install<br>
3. php artisan serve<br>


STEAM API COMMANDS:
1. php artisan steam:load-games 1 -> Fetch games list from STEAM API to file<br>
2. php artisan steam:load-games 2 -> Download games from STEAM and put them in app<br>

## Specification

1.Front-End
-Bootstrap<br>
-Saas<br>
-HTML5<br>

2.Back-end
-Laravel 7.24<br>
-PHP 7.3<br>
-MySQL<br>

3.Database
-SQlite<br>


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
