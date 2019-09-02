# Restfull API Lumen 5.5 with JWT Authentication and Dingo API with Docker

A basic starter kit for you to integrate Lumen with [JWT Authentication](https://jwt.io/) and [Docker](https://www.docker.com/) with data persistence. ie. The docker image with persist data even if you restart or relocate the repo.


## Open Source Libs used

- [Lumen 5.5](https://github.com/laravel/lumen/tree/v5.5.0)
- [JWT Auth](https://github.com/tymondesigns/jwt-auth) for Lumen Application
- [Dingo](https://github.com/dingo/api) to easily and quickly build your own API
- [CSV Reader](https://github.com/flynsarmy/csv-seeder) for seeding large data from csv

## Quick Start

- Clone this repo or download it's release archive and extract it to your web development environment
- Run 
```
    `composer install`
    `php artisan jwt:secret`
```
- Configure your `.env` file for authenticating via database or, if you want, use `.env.example` which is pre-configured to be used along with docker environment. 


## A Live PoC

- Run a PHP built in server from your root project:

```sh
php -S localhost:8000 -t public/
```

Or via artisan command:

```sh
php artisan serve
```

To authenticate a user, make a `POST` request to `/api/auth` with parameter as mentioned below:

```
Example : 
email: johndoe@example.com
password: johndoe
```

Request:

```sh
curl --location --request POST "http://127.0.0.1:8000/api/auth" \
  --form "email=mac94@moen.com" \
  --form "password=secret"
  ```

Response:

```
{
  "access_token": "xxxxxxxxxx__a_long_token_appears_here__xxxxxxxxxx",
  "token_type": "bearer",
  "expires_in": 3600
}
```

- With token provided by above request, you can check authenticated user by sending a `GET` request to: `/api/user`.

Request:

```sh
curl -X GET -H "Authorization: Bearer a_long_token_appears_here" "http://localhost:8000/api/user"
```


Response:

```
{
  "user": {
    "name": "Dr. Lelia Hansen II"
  }
}
```

For rest of the routes, you can follow the below documents.
## Postman Collection

- [![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/42fbeaee146b93e1ed5e#?env%5Blumen-api%5D=W3sia2V5IjoidXJsIiwidmFsdWUiOiJodHRwOi8vbG9jYWxob3N0IiwiZW5hYmxlZCI6dHJ1ZX0seyJrZXkiOiJ0b2tlbiIsInZhbHVlIjoiZXlKMGVYQWlPaUpLVjFRaUxDSmhiR2NpT2lKSVV6STFOaUo5LmV5SnBjM01pT2lKb2RIUndPaTh2Ykc5allXeG9iM04wTDJGd2FTOWhkWFJvSWl3aWFXRjBJam94TlRZM05EUTJNamMyTENKbGVIQWlPakUxTmpjME5EazROellzSW01aVppSTZNVFUyTnpRME5qSTNOaXdpYW5ScElqb2laRGhxYVZkbk0zVjJUbTlzUjNwbGRpSXNJbk4xWWlJNk16UXNJbkJ5ZGlJNklqSXpZbVExWXpnNU5EbG1OakF3WVdSaU16bGxOekF4WXpRd01EZzNNbVJpTjJFMU9UYzJaamNpZlEuLTRZQkttZEQ3bXlGaU9meUdnUnhyYUdWcElyTm92d01ELXhXc2FBa3lYZyIsImVuYWJsZWQiOnRydWV9XQ==)
- Documentor Pusblished: [API Specs](https://documenter.getpostman.com/view/34930/SVfRt7ov?version=latest)         
- Postman Collection `/docs/Sample_Lumen_API.postman_collection.json` [Download file](../../raw/master/docs/Sample_Lumen_API.postman_collection.json)


## License

```
Laravel and Lumen is a trademark of Taylor Otwell
Sean Tymon officially holds "Laravel JWT" license
```

