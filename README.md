# Green Leaf - A simple article API service

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Endpoints

| Name   | Method      | URL                     | Protected |
| ---    | ---         | ---                     | ---       |
| List   | `GET`       | `/articles`             | ✘         |
| Create | `POST`      | `/articles`             | ✓         |
| Get    | `GET`       | `/articles/{id}`        | ✘         |
| Update | `PUT/PATCH` | `/articles/{id}`        | ✓         |
| Delete | `DELETE`    | `/articles/{id}`        | ✓         |
| Rate   | `POST`      | `/articles/{id}/rating` | ✘         |

### Prerequisites

- [Docker](https://docker.com)

### Installing

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
docker-compose up -d
```

### Step 4

Access the API endpoints using your local IP or current IP address.
Example : `http://localhost:{port}` or `http://189.2.2.1`

>this command will fire up the project's docker images, it might take a while so watch some [Youtube](https://youtube.com) as you wait.

## Running the tests

>coming soon

## Deployment

>coming soon

## Built With

- [PHP](https://php.org) - The programming language used
- [Lumen](https://lumen.laravel.com) - The web framework used
- [Docker](https://docker.com)

## Authors

- **Samuel Ladapo** - *Initial work* - [Samuel ladapo](https://github.com/ladaposamuel)
