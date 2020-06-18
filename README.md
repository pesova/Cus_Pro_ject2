# Team Sentry FRONTEND

### Requirements

1. MAMP, ZAMP, Valet (Any server that runs php), Laragon (Recommended)
2. Node
3. NPM

Install Laragon: https://laragon.org/docs/install.html

N/B: If you are asked to update your php when running laragon:
https://medium.com/@stephenjudeso/upgrading-to-php-7-4-laragon-862b9d204d0c

###TEAM Sentry - INSTALLATION

Step 1: Click on Fork at the top right corner

Step 2: Clone your forked repository

Step 3: cd into the cloned folded | <code>cd sentry-my-customer-frontend </code>

Step 4: git remote add upstream https://github.com/hngi/sentry-my-customer-frontend.git

Step 5: git pull upstream develop

Step 6: Check out to the task branch | <code>git checkout -b <NAME_OF_THE_TASK></code>

### Running the project locally

Step 1: cd into sentry-my-customer-frontend

Step 2: Create .env and copy .env.example to it the .env | On terminal <code> cp .env.example .env

Step 3: <code> php artisan key:generate </code>

Step 4: <code>composer install </code>

Step 5: <code>npm install </code>

Step 4: <code> php artisan server </code>

Then go to http://127.0.0.1:8000

#### Creating a pull request

Step 1: Run: git add .

Step 2: Run: git commit -m "<COMMIT MESSAGE>"

Step 3: git push origin <BRANCH_NAME>

Go to the repository https://github.com/hngi/sentry-my-customer-frontend

As soon as you get there, you are going to see a green ‘compare and create a pull request’

Click on it, and type your message, click on create pull request.

If you have any more questions, please check out this resource -> https://www.youtube.com/watch?v=HbSjyU2vf6Y



