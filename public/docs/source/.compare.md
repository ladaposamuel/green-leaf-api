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
            "title" => "nemo",
            "message" => "cumque",
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
    "title": "nemo",
    "message": "cumque"
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
    "data": "Article Posted successfully"
}
```
> Example response (422):

```json
{
    "status": "error",
    "data": "Validation errors"
}
```

### HTTP Request
`POST /api/v1/articles`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    title | title |  required  | The title of the article.
    message | string |  required  | The message of the article.

<!-- END_f25ad88ad3ff8f48775c1cc0cc4255fa -->

<!-- START_42fa0e35e4d2e0a2cfe3a7b2d0755599 -->
## Update Article

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->patch("http://localhost/api/v1/articles/1", [
    'headers' => [
            "Content-Type" => "application/json",
        ],
    'query' => [
            "ID" => "1",
        ],
    'json' => [
            "title" => "molestias",
            "message" => "ut",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL("http://localhost/api/v1/articles/1");

    let params = {
            "ID": "1",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "title": "molestias",
    "message": "ut"
}

fetch(url, {
    method: "PATCH",
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
    "data": {}
}
```
> Example response (422):

```json
null
```

### HTTP Request
`PATCH /api/v1/articles/{id}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    title | title |  required  | The title of the article.
    message | string |  required  | The message of the article.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    ID |  required  | The ID of the article.

<!-- END_42fa0e35e4d2e0a2cfe3a7b2d0755599 -->

<!-- START_9bbfc77e31962e3921c3d1a010002cc9 -->
## Delete an Article

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("http://localhost/api/v1/articles/1", [
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL("http://localhost/api/v1/articles/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": "success",
    "data": "Article Deleted successfully"
}
```
> Example response (404):

```json
{
    "status": "error",
    "error": "Article ID not specified or not found"
}
```
> Example response (422):

```json
{
    "status": "error",
    "error": "You dont have access to delete this article"
}
```

### HTTP Request
`DELETE /api/v1/articles/{id}`


<!-- END_9bbfc77e31962e3921c3d1a010002cc9 -->

<!-- START_8bd67d5b8c23072f4e39d2b3cf69dfa1 -->
## List all Articles

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost/api/v1/articles", [
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL("http://localhost/api/v1/articles");

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
    "data": []
}
```
> Example response (500):

```json
null
```

### HTTP Request
`GET /api/v1/articles`


<!-- END_8bd67d5b8c23072f4e39d2b3cf69dfa1 -->

<!-- START_82a5dbdb9d45bfefd05442a42aa9423c -->
## Get an Article

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost/api/v1/articles/1", [
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL("http://localhost/api/v1/articles/1");

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
    "data": {}
}
```
> Example response (404):

```json
{
    "status": "error",
    "error": "Article ID not found"
}
```

### HTTP Request
`GET /api/v1/articles/{id}`


<!-- END_82a5dbdb9d45bfefd05442a42aa9423c -->

<!-- START_1a1967989f9f4a30200b22a89467e7ab -->
## Search Article

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("http://localhost/api/v1/articles/search/1", [
    'query' => [
            "q" => "hello",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL("http://localhost/api/v1/articles/search/1");

    let params = {
            "q": "hello",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

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
    "data": []
}
```
> Example response (422):

```json
{
    "status": "error",
    "data": "You need to specify a search query"
}
```
> Example response (500):

```json
null
```

### HTTP Request
`GET /api/v1/articles/search/{q}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    q |  required  | The search query of the article.

<!-- END_1a1967989f9f4a30200b22a89467e7ab -->

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
            "email" => "nihil",
            "password" => "possimus",
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
    "email": "nihil",
    "password": "possimus"
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
            "name" => "in",
            "email" => "aspernatur",
            "password" => "non",
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
    "name": "in",
    "email": "aspernatur",
    "password": "non"
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


