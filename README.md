[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Inquizarus/phroch/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Inquizarus/phroch/?branch=master)
# phroch

Robot challenge code test written in PHP with a JSON payload frontend for display purposes.

## Running it
Phroch can be run with the built stand alone server bundled with PHP.
```bash
php -S 128.0.0.1:8080
```
When launched in the project directory you can open a browser and go to `127.0.0.1:8080`

You can customize the configuration by using query parameters when visiting the page.

**gridX** and **gridY** determines how large the grid will be. Both defaults to 10.

**positionX** and **positionY** determines which coordinates the robot will start at.

**facing** will determine which way the robot is initially facing. N/E/S/W or North/East/South/West works.

**obstacles** Puts obstacles in at corresponding coordinates. Put in one or more by defining x and y separated by a coma and each
obstacle set separated with a dash. Example `obstacles=1,2-4,7` will result in obstacles at x1,y2 and x4,y7.

**commands** Makes the robot move. Valid moves are f(forward), b(backwards), l(left/turn left), r(right/turn right).

## Test cases

Test Cases
----------

- The robot is on a 100×100 grid at location (0, 0) and facing SOUTH. The robot is given the commands “fflff” and should end up at (2, 2) `?gridX=100&gridY=100&positionX=0&positionY=0&facing=south&commands=fflff`

- The robot is on a 50×50 grid at location (1, 1) and facing NORTH. The robot is given the commands “fflff” and should end up at (1, 0) `?gridX=50&gridY=50&positionX=1&positionY=1&facing=north&commands=fflff`

- The robot is on a 100×100 grid at location (50, 50) and facing NORTH. The robot is given the commands “fflffrbb” but there is an obstacle at (48, 50) and should end up at (48, 49) `?gridX=100&gridY=100&positionX=50&positionY=50&facing=north&commands=fflffrbb&obstacles=48,50`
