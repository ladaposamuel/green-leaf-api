---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#Articles Route


Auth route
<!-- START_f25ad88ad3ff8f48775c1cc0cc4255fa -->
## New Article

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://localhost/api/v1/articles", [
    'headers' => [
            "Content-Type" => "application/json",
        ],
    'json' => [
            "title" => "reprehenderit",
            "message" => "sed",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL("http://localhost/api/v1/articles");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "title": "reprehenderit",
    "message": "sed"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`POST /api/v1/articles`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    title | title |  required  | The title of the article.
    message | string |  required  | The message of the article.

<!-- END_f25ad88ad3ff8f48775c1cc0cc4255fa -->

#Authentication Route


Auth route
<!-- START_f76cc718539c2362f0d0a7069100319e -->
## Login Route

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://localhost/api/v1/auth/login", [
    'headers' => [
            "Content-Type" => "application/json",
        ],
    'json' => [
            "email" => "est",
            "password" => "tenetur",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL("http://localhost/api/v1/auth/login");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "email": "est",
    "password": "tenetur"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": "success",
    "data": {
        "user": {},
        "token": ""
    }
}
```

### HTTP Request
`POST /api/v1/auth/login`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | email |  required  | User Email.
    password | string |  required  | User Password.

<!-- END_f76cc718539c2362f0d0a7069100319e -->

<!-- START_61e12326a1f2070b5637f4366c2ce678 -->
## Register Route

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("http://localhost/api/v1/auth/register", [
    'headers' => [
            "Content-Type" => "application/json",
        ],
    'json' => [
            "name" => "odit",
            "email" => "maiores",
            "password" => "natus",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL("http://localhost/api/v1/auth/register");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "name": "odit",
    "email": "maiores",
    "password": "natus"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": "success",
    "data": {
        "user": {},
        "token": ""
    }
}
```

### HTTP Request
`POST /api/v1/auth/register`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | User Name.
    email | email |  required  | User Email
    password | string |  required  | User Password.

<!-- END_61e12326a1f2070b5637f4366c2ce678 -->

#Index Route


Index route
<!-- START_53be1e9e10a08458929a2e0ea70ddb86 -->
## Welcome Message

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost/", [
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL("http://localhost/");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": "success",
    "data": {
        "message": "Welcome to Grean leaf Article API V1 endpoint"
    }
}
```

### HTTP Request
`GET /`


<!-- END_53be1e9e10a08458929a2e0ea70ddb86 -->


