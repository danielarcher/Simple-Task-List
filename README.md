# Description
This is a basic to complex project, each branch of this repository represents a level of complexity for development. We are going to pass from no-frameworks to MVC and more advanced techniques as DDD + CQRS + Event-Driven.

# Simple Task List
Use case: "As a user, I want to have an ability to see a list of tasks for my day, so that I can do them one by one" 

## Conditions of satisfaction: 

- It provides a GET endpoint `/tasks` to list the tasks, json format
- It provides a POST endpoint `/task` to create new tasks, json format
- It provides a PATCH endpoint `/task/{id}/complete` to finish the task

Each task contains 

- id (integer)
- description (text)
- is_completed (boolean)

# About this branch

### Level 2 - Slim 4 framework for routing + database storage

This is a very simple implementation of the Slim4 framework, using only the `php-di` for containers and PDO for 
database connection.

We created 3 handlers classes just for minimal organization: `TaskCreate`, `TaskComplete` and `TaskList`.
The data flow keep the same as before, we receive the data and stead of use datafile storage, we use mysql database.

In the next step, we are going to see a more MVP structure, based on this branch.

### Hours of work
2~3 hours
More difficult part: creating the slim configuration

# Tests

    PHPUnit 8.5.13 by Sebastian Bergmann and contributors.
    
    Time: 6.21 seconds, Memory: 6.00 MB
    
    OK (4 tests, 6 assertions)
    
    Process finished with exit code 0
