
# Posnet API

This API handles the creation of clients and cards, as well as processing payments.

## Technologies Used:

* **Docker** : Containerization for easy deployment.
* **PHP 8.1** : Backend implementation.
* **PHPUnit 9.5** : Testing framework for unit tests.

## Setup and Usage

### Prerequisites:

Make sure you have Docker and `make` installed on your machine.

### Commands

* **`make up`**
  Builds and starts the PHP container.
* **`make track`**
  Follows and shows the logs from the running container.
* **`make down`**
  Stops the container and cleans up the resources.
* **`make bash`**
  Enters the PHP container's bash shell for debugging or further interaction.
* **`make test`**
  Runs PHPUnit tests for the project.

Postman collection to test:
https://www.postman.com/speeding-shadow-778130/workspace/api-postnet-php
