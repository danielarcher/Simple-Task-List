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