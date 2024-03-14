## General information
This project is made with the "VILT" stack : Vue, Inertia, Laravel, Tailwind.

it is using Docker containers through "Sail" (from Laravel)

Also, it has a CI configured:
- Backend coding style check
- Frontend coding style check

<hr />

## Run the project

- Start the containers : `./vendor/bin/sail up -d`

- Run the migrations : `./vendor/bin/sail migrate`

- Run `./vendor/bin/shell`, then `npm run dev`

- Create a new user : http://localhost:8080/register

- Login : http://localhost:8080/login

- Access the main page : http://localhost:8080/

<hr>

## Run the CI locally
A CI is setup to check backend and frontend coding style + logic. Here is how to run it locally:

- Install act : brew install act

- Run `act` at the root of the project

