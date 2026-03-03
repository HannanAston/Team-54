[![Laravel CI](https://github.com/HannanAston/Team-54/actions/workflows/laravel-ci.yml/badge.svg?branch=main)](https://github.com/HannanAston/Team-54/actions/workflows/laravel-ci.yml)

# Team-54 v1.4.1

***<mark>IMPORTANT! PLEASE READ THIS FILE EVERY TIME YOU LOGIN TO CHECK FOR UPDATES!</mark>*** 

Update version everytime you merge to main. Last digit for bug fixes and minor changes, second digit for feature additions and branch merges, first digit for new deployment versions.

Do not merge onto the main unless your pull request passes the CI pipeline and someone else has reviewed your work/pull request. You can confirm by pressing Actions and then looking for your request (should be at the top) and seeing if there is a green tick.

Do NOT edit past migration tables if you want to change how tables in the database are structured. Make a new migration with your change and link it to the existing table. If this does not make sense, message Angad or leave a help request in this file.

DO NOT modify existing factories or seeders unless you notify the backend team lead (Angad). New seeders are new files, don't edit old ones.

NEVER run php artisan migrate:fresh unless:

- You are on your own branch, AND
- You are using the **test environment**, AND
- You understand this wipes *ALL EXISTING DATA* from your local database

**This command must NEVER be run on main or production.**

NEVER push directly to main.

EVERY Pull request MUST contain tests. If you make any new stuff, like middleware, models or controllers etc. there needs to be the accompanying test. You must also pass the CI.

DO NOT modify someone elses branch. Only work on YOURS.

If you add or change .env variables you MUST notify the team and update .env.example. Keep a spare local copy of the old version too (not in the repo, local or otherwise) just in case.

If local database breaks run: php artisan migrate fresh --seed
BUT only if you are on your **branch** and using **test data**
Otherwise ask for a backend developer, if that fails leave a request, if that fails ask for Angad.


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
