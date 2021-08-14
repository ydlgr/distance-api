This project is based on Lumen Framework.

### **Installation**

There are 2 ways to run project and test api;

- If you have docker installed, this is the recommended way, in the docker folder;

```bash
$ docker-compose up -d
$ docker ps
```
There will be two containers.
Go to the php container terminal.
```bash
$ docker exec -it {php_container} bash
```
In the php container terminal run ;
```bash
$ composer install
```

- If you have php binary installed;

```bash
$ git clone https://github.com/ydlgr/distance-api.git
$ cd src
$ composer install
$ php -S localhost:8000 -t public
```
### **Api Endpoint**
http://localhost:8000/api/calculate


Example Request
```bash
curl -d "param1=3&param1_type=yards&param2=5&param2_type=meters&return_type=meters" -H "Content-Type: application/x-www-form-urlencoded" -X POST http://localhost:8000/api/calculate
```
Response
```bash
{"status":"200","data":7.73}
```

### **Tests**
in the php container terminal , run 
```bash
./vendor/bin/phpunit
```
