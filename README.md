## Notes API

Notes API is a collection of APIs, simple implementation of [Laravel Sanctum](https://laravel.com/docs/9.x/sanctum) to
managing data in ours mobile application. We're providing a lot of features such as authentication system, including
Login and Registration, as well as CRUD operations on the Note, Label, and more. Every endpoint except login and
registration is securely protected by sanctum middleware to make sure that the incoming http request is from **
authenticate**
and **authorize** user.

## Endpoints

This section explains all the available endpoints in our application. before you begin, you should to ensure that you
set the `Accept: application/json` header in every request.

You also need to set the `Content-Type: application/json` header when you want to perform POST, PUT, PATCH, and DELETE
http request.

### Authentication

#### Registration

To perform a registration, you need to send a POST request to endpoint `/api/register` like example below:

```shell
http://localhost:8000/api/register
```

You also need to send a JSON formatted data which contains **username**, **email**, and **password** to registering a
user.

```json
{
    "name": "galangaidil",
    "email": "galangaidil@holygeni.us",
    "password": "password"
}
```

If the registration success, you will receive a response `message` and the `user_information` like this:

```json
{
    "message": "Registration success",
    "user_information": {
        "name": "Galang Aidil",
        "email": "galangaidil@holygeni.us",
        "updated_at": "2022-04-26T22:52:44.000000Z",
        "created_at": "2022-04-26T22:52:44.000000Z",
        "id": 2018
    }
}
```

you can use the `message` value to make a `toast` message in your mobile application.

#### Login

To perform a login action, you need to send a POST request to endpoint `/api/login` like example below:

```shell
http://localhost:8000/api/login
```

You also need to send a JSON formatted data which contains **email**, **password** and **device_name** to authenticate
the user.

```json
{
    "email": "galangaidil@holygeni.us",
    "password": "password",
    "device_name": "Galang's Iphone 13"
}
```

If the user credentials is corrects, the login proses will be success, and you will be received a response message like
this:

```json
{
    "message": "Login success",
    "user_information": {
        "id": 2018,
        "name": "Galang Aidil",
        "email": "galangaidil@holygeni.us",
        "email_verified_at": null,
        "created_at": "2022-04-26T22:52:44.000000Z",
        "updated_at": "2022-04-26T22:52:44.000000Z"
    },
    "token": "17|7dQypRsAccptOmGtjWHE6N38K0nEzIit6SICseQt",
    "token_usage": "When the mobile application uses the token to make an API request to our application, it should pass the token in the Authorization header as a Bearer token."
}
```

Otherwise, you will be received response message like this:

```json
{
    "message": [
        "The provided credentials are incorrect."
    ]
}
```

As you can see in the success login response message, there is a key named `token`. This token is really important for
the application life cycle, because token will be used to **authenticate** and **authorize** the user when they are
performed some action in the mobile application. without this `token`, every request that user send will be
automatically rejected by the application.

```json
{
    "message": "Unauthenticated."
}
```

You need to pass the `token` in the Authorization header as a Bearer token. please read
the key `token_usage` for the instruction.

#### Logout

To perform logout action, you need to send a POST request to endpoint `api/logout` like example below:

```shell
http://localhost:8000/api/logout
```

Don't forget to pass the `token` in the Authorization header as a Bearer token.

If the logout action success, you will be received a response message like this:

```json
{
    "message": "Logged out"
}
```

This mean that the user is sign out from the mobile application and the `token` will be deleted from the database. You
can not use that `token` again, and need to perform a login action to get new a `token`.

Sebenarnya yang crud note dan label itu udah, tapi belum buat dokumentasinya aja.

### CRUD Note

#### Get all notes

#### Get single note

#### Insert note

#### Update note

#### Delete note

### CRUD Label

#### Get all labels

#### Get single label

#### Insert label

#### Update label

#### Delete label

## Installation


