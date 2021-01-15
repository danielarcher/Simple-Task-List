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
## Level 1 - Single file implementation
More basic as possible, here we can see one-file implementation of the desired functionality.

1. We parse the received url
2. Create the data file if not exists
3. Load the resource list from the file
4. Add/Update the resource
5. Replace the content with the new resource list

## Hours used for development
1~2 hours
 
## Test cases 
Passing
 
    PHPUnit 8.5.13 by Sebastian Bergmann and contributors.
    
    Time: 1.26 seconds, Memory: 6.00 MB
    
    OK (3 tests, 5 assertions)
    
    Process finished with exit code 0
