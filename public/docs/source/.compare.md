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


