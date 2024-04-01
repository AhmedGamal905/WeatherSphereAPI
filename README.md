# WeatherSphereAPI

WeatherSphereAPI is a PHP and Laravel-based project that provides a weather condition retrieval API. This API allows authenticated users to retrieve weather conditions based on longitude and latitude coordinates. The project integrates with a third-party API service to ensure the delivery of accurate and real-time weather data. Utilizing Sanctum for authentication, WeatherSphereAPI guarantees that only authorized users have access to the API.

## Installation

To set up the WeatherSphereAPI project, follow these steps:

1. Clone the repository to your local machine:

git clone <https://github.com/AhmedGamal905/WeatherSphereAPI>

2. Navigate to the project directory:

cd WeatherSphereAPI

3. Install the project dependencies using Composer:

composer install

4. Create a new database for the project and update the .env file with the database credentials

5. Run the database migrations to create the necessary tables:

php artisan migrate

6. Start the development server:

php artisan serve

The WeatherSphereAPI should now be accessible at http://localhost:8000.

## Authentication

WeatherSphereAPI utilizes Sanctum for API authentication. To authenticate and access the API endpoints, follow these steps:

1. Register a new user by sending a POST request to /api/auth/register with the following parameters:

-   `name`: The name of the user.
-   `email`: The email address of the user.
-   `password`: The password for the user.

2. Obtain an authentication token by sending a POST request to /api/auth/login with the following parameters:

-   `email`: The email address of the registered user.
-   `password`: The password for the user.

The response will contain an `api_token` that you can use to authenticate subsequent requests.

3. Include the `api_token` as a header in your requests:

Authorization: Bearer <api_token>

## API Endpoints

The following API endpoints are available in the WeatherSphereAPI:

-   **Retrieve Weather Conditions**
-   **Endpoint**: `/weather`
-   **Method**: GET
-   **Parameters**:
-   `longitude`: The longitude coordinate.
-   `latitude`: The latitude coordinate.
-   **Authorization**: Required

This endpoint retrieves the weather conditions based on the provided longitude and latitude coordinates. Make sure to include the longitude and latitude parameters in the request query.

## Postman Collection

A Postman collection is included in the project's resources folder. You can find the collection in the `resources/postman` directory. Import this collection into Postman to have all the API endpoints and example requests readily available for testing.
