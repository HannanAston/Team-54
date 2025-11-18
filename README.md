[![Laravel CI](https://github.com/HannanAston/Team-54/actions/workflows/laravel-ci.yml/badge.svg?branch=main)](https://github.com/HannanAston/Team-54/actions/workflows/laravel-ci.yml)

# Team-54

***<mark>IMPORTANT! PLEASE READ THIS FILE EVERY TIME YOU LOGIN TO CHECK FOR UPDATES!</mark>*** 

Do not merge onto the main unless your pull request passes the CI pipeline and someone else has reviewed your work/pull request. You can confirm by pressing Actions and then looking for your request (should be at the top) and seeing if there is a green tick.

***[How to GitHub!]***

Goal: everyone builds and tests code locally, opens a Pull request from their own branch after they push their code to it, CI runs (in GitHub actions), <mark>we only merge to main when CI is green.</mark>

<p align="center">
  <img src="docs\GitHub-flow.png" alt="Team GitHub Flow" width="900"
</p> 

***[How to use/install Laravel for this project]***

**1. Ensure Required Software is Installed**

- Install the following *once* on your machine:
- PHP 8.1+
- Composer
- MySQL (via XAMPP)
- Git

**2. Open the Project Folder**

Navigate into the 'OurDatabase' directory (you should see app/, routes/, database/; and it should like this in your terminal:<mark>Desktop/TeamProject_CSY2/Team-54/OurDatabase (YOUR_BRANCH_NAME)</mark>)

**3. Install Laravel Dependencies**

- Run: Composer install (in bash terminal)

This installs Laravel and all required packages into the /vendor folder

**4. Create Your Local .env File**

The project does **NOT** store .env in the repository.

You must create your own by copying and pasting the <mark>.env.example</mark> file with the new file name .env (all in the same 'OurDatabase' folder).

**5. Update the Database Config (Mandatory for ALL Team Members)**

Sections mentioned below must conform to this:

- APP_NAME=Laravel
- APP_ENV=local
- APP_KEY=
- APP_DEBUG=true
- APP_URL=http://localhost

- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=cs2tp_db
- DB_USERNAME=root
- DB_PASSWORD=

This ensures all  migrations behave consistently across the team and CI pipeline.

**6. Generate Your Own Local Application Key**

Each teammate must generate their own key:

Run: php artisan key:generate (Run on bash)

- DO NOT COPY THE *APP_KEY* FROM ANYONE ELSE
- DO NOT PUSH YOUR .env to Git
- DO NOT add a key to .env.example

The key is local only.

**7. Run the database migrations**

Create tables locally:

- Run: php artisan migrate (in bash)

**8. Start the Development Server**

- Run: php artisan serve (in bash)

App will now be available at: https://127.0.0.1:8000

***[Help Requests and responses]***

Add any help requests <mark>(e.g. if you fail 5 times)</mark> and responses here

***[Tests added]***

Any new tests you make that you think should be merged with the main and added to the CI pipeline, mention here.

***[Important updates/info]***

Anything you deem important and want others to know.
