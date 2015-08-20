#Introduction

If you are here, you have probably applied for a job at Obiz and have received the name of a challenge to take. Be welcome!

The challenges code is in the `src` folder. The instructions are written as function comments inside the class templates.

#Run the unit tests

In case you are not familiar with github or composer and want to run the tests against your code, here are the necessary steps.

Clone the project to your computer

`git clone https://github.com/Obiz/challenges.git obiz-challenges`

Download composer

`curl -sS https://getcomposer.org/installer | php`

Install the project dependencies

`composer.phar install --prefer-dist`

Run the tests for a specific challenge

`./vendor/bin/phpunit tests`