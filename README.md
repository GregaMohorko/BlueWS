# BlueWS
A simple REST Web Service library with business logic (client verification, user permission per action, etc.).

Latest release: [v1.1](https://github.com/GregaMohorko/BlueWS/releases/latest)

## Documentation & Tutorials
You can read the documentation and tutorials under the [Wiki](https://github.com/GregaMohorko/BlueWS/wiki).

## Short examples
A simple hello world action:
```PHP
class HelloWorld extends BaseAction
{
  public function run()
  {
    $result = [];
    $result["Message"] = "Hello world!";
    return $result;
  }
}
```

## Requirements
PHP version >= 5.5

## Author and License

Grega Mohorko ([www.mohorko.info](http://www.mohorko.info))

Copyright (c) 2017 Grega Mohorko

[Apache License 2.0](./LICENSE)
