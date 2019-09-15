# Green Leaf - A simple article API service

#### Project URL
[Pivotal Tracker](https://www.pivotaltracker.com/n/projects/2397587)


### Endpoints

| Name   | Method      | URL                     | Protected |
| ---    | ---         | ---                     | ---       |
| List   | `GET`       | `/articles`             | ✘         |
| Create | `POST`      | `/articles`             | ✓         |
| Get    | `GET`       | `/articles/{id}`        | ✘         |
| Update | `PUT/PATCH` | `/articles/{id}`        | ✓         |
| Delete | `DELETE`    | `/articles/{id}`        | ✓         |
| Rate   | `POST`      | `/articles/{id}/rating` | ✘         |
| Search | `GET`        | `/articles/search/{query}`| ✘|
| Login | `POST`    | `/auth/login` | |
| Register | `POST`    | `/auth/register` | |

For more details check the `/public/docs/index.html` inside the project directory.


## Getting Started

These instructions will get you a copy of the project up and running on your local machine.

### Prerequisites

- [Docker](https://docker.com)

### SETUP

#### Step 1

Install Docker - A step by step guide on how to install [Docker](https://docker.com) on your OS will be on their official website.

#### Step 2

Git clone the repo using the following command

```bash
git clone https://github.com/ladaposamuel/green-leaf-api
```

#### Step 3

CD into the project directory and run the following commands

```bash
docker-compose build && docker-compose up -d
```
>this command will fire up the project's docker images, it might take a while so watch some [Youtube](https://youtube.com) as you wait.


#### Step 4

Create a `.env` file

```bash
cp .env.example .env
```
`NOTE: prefilled for the test`



### Step 4

Access the API endpoints using your local IP or current IP address.
Example : `http://localhost`


## Running the tests

To run the tests run

```bash
docker-compose exec greanleaf php vendor/bin/codecept run api
```


## Built With

- [PHP](https://php.org) - The programming language used
- [Lumen](https://lumen.laravel.com) - The web framework used
- [Codeception](https://codeception.com) - Testing framework
- [Docker](https://docker.com)

## Authors

- **Samuel Ladapo** - *Initial work* - [Samuel ladapo](https://github.com/ladaposamuel)
