# Work Time Manager Api

This project is a work time manager API.

### Installation

For launch the project, you need have Docker and Docker Composer installed on your machine.

```bash
make init
```

This command will do:
- Create the necessary networks for all Docker containers.
- Create the containers.
- Install vendors dependencies from composer
- Create the database and execute migrations.
- Create a user admin for testing propose.

If you have any problem with any of the steps, you can run the commands separately following the next list:

```bash
make up

make bash

make bash-consumers

make stop

make down

make composer-install

make unit

make create-database

make migrate

make create-admin
```


# Overview of the application

## General Overview

This application is designed to a simple API that allow users to create, update, delete and read users and work entries.
Using the following stack:

1. **PostgresSQL**
    - **Description**: Database
    - **Function**: Store the data of the application
    - **Tables**:
        - users (Store all user with the information)
        - work_entries (Store all work entries of the users)
        - refresh_tokens (Store all refresh tokens of the users)
        - event_store (Store all events of the application)

2. **Nginx**
    - **Description**: Web server and reverse proxy.
    - **Function**: Handles HTTP and HTTPS requests

3. **RabbitMQ**
    - **Description**: Message broker
    - **Function**: Manage the events of the application
    - **Exchanges**:
        - events (Exchange for the events)
        - command (Exchange for the commands)

4. **Consumers with Supervisor**
    **Description**: Background processes managed by Supervisor.
    **Function**: Executes asynchronous tasks


## Endpoints

List of the endpoints of the application
All the endpoints are protected by the JWT token, except the login and refresh token.
The user has roles, that roles are:
- admin
- user

Admin can access all the endpoints, and the user can access only the endpoints of the work entries.

### Auth

#### Login
- POST /api/login
```json
{
  "username": "email.example.com",
  "password": "password"
}
```

#### Refresh Token

- POST /api/token/refresh

Headers: _X-Refresh-Token: REFRESH_TOKEN_


### Users

- POST /api/users  (create users)
```json
{
  "name": "name-example",
  "email": "email.example.com",
  "password": "password"
}
```

- GET /api/users  (find users)
- PUT /api/users/{id}  (update users)
```json
{
  "name": "name-example",
  "email": "email.example.com",
  "password": "password"
}
```
- DELETE /api/users/{id}  (delete users)

### Work Entries

- POST /api/work-entry  (create work entry)
```json
{
  "userId": "64d08ca4-32d5-4af4-830a-bc83ae5a19b0"
}
```

- GET /api/work-entry  (find work entries)
- PUT /api/work-entry/{id}  (update work entry)
```json
{
  "userId": "64d08ca4-32d5-4af4-830a-bc83ae5a19b0",
  "startDate": "2025-01-01 08:53:01",
  "endDate": "2025-01-01 16:53:01"
}
```
- DELETE /api/work-entry/{id}  (delete work entry)

### Work Entry Users

- POST /api/work-entry/user/start  (start work entry of the user)
- POST /api/work-entry/user/finish/{id}  (end work entry of the user)
- GET /api/work-entry/user  (find work entries of the user)

