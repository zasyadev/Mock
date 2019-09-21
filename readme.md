## Project Description 

This project is simple CRUD for Companies and employees with login and authentication implemented within using Laravel 6.

## Installation process and data setup
Basic command and steps to run project from repository
- Clone using git repository.
- composer install  -- command assuming you have already composer installed globally
- create .env file and fill-up the configuration required (database credentials, mail crendentials) -- for reference copy info from .env.example
- Run migrations for the project command -- php artisan migrate
- To fill some pre-defined entries use command -- php artisan db:seed( Options for running perticular seeder are also available )
- php artisan storage:link for linking storage folder
- Login using credentials


## Purpose
Main functionality is to  handle operation for company and employees related to company
- On company page you can see all company records in table and add button ( Used to create new record of company )
- On Employee page same layout to add employees for company.
- On table structure extra actions are also provided to view, edit and delete records.
