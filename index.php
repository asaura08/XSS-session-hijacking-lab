<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    if (!empty($name) && !empty($email) && !empty($message)) {
        fopen("contact.json", "a+");
        $file = fopen("contact.json", "a+");
        fputs($file, json_encode(array("name" => $name, "email" => $email, "message" => $message)) . "\n");
        fclose($file);
    }
}

if (!isset($_GET['admin'])) {
    echo '
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>XSS Blind</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>

    <body>
        <nav class="bg-gray-200 p-4 text-center">
            <a href="index.php?contact" class="px-4 py-2">Contact</a>
            <a href="index.php?admin" class="px-4 py-2">Admin</a>
        </nav>

        <div class="container mx-auto mt-8 text-center">
            <h1 class="text-2xl font-bold">Contact Form</h1>
            <form action="" method="post" class="mt-4" onsubmit="alert(\'Mensaje enviado correctamente, en beve un administrador se pondra en contacto con usted\')">
                <input type="text" name="name" placeholder="Name" class="border border-gray-300 rounded-md px-4 py-2 mb-2"><br><br>
                <input type="email" name="email" placeholder="Email" class="border border-gray-300 rounded-md px-4 py-2 mb-2"><br><br>
                <textarea name="message" cols="30" rows="10" placeholder="Message" class="border border-gray-300 rounded-md px-4 py-2 mb-2"></textarea><br><br>
                <input type="submit" name="submit" value="Send" class="bg-blue-500 text-white px-4 py-2 rounded-md">
            </form>
        </div>
    </body>

    </html>';
} else {
    setcookie("PHPSESSID", "admin_cookies_7ratt4fr2huhvpsrmgn1utgdn0");

    echo '
        <!DOCTYPE html>
        <html lang="en">
        
        <head>
            <meta charset="UTF-8">
            <title>XSS Blind</title>
            <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        </head>
        
        <body>
            <nav class="bg-gray-200 p-4 text-center">
                <a href="index.php?contact" class="px-4 py-2">Contact</a>
                <a href="index.php?admin" class="px-4 py-2">Admin</a>
            </nav>
        
            <div class="container mx-auto mt-8 text-center">
                <h1 class="text-2xl font-bold">Admin panel</h1>
                <p>Panel de mensajes recibidos desde el formulario de contacto</p>
                <table class="border-collapse border border-gray-300 mt-4 align-center mx-auto w-1/2">
                    <thead>
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">Name</th>
                            <th class="border border-gray-300 px-4 py-2">Email</th>
                            <th class="border border-gray-300 px-4 py-2">Message</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach (file("contact.json") as $key => $value) {
                        $data = json_decode($value, true);
                        if ($data) {
                            echo "<tr>";
                            echo "<td class='border border-gray-300 px-4 py-2'>{$data['name']}</td>";
                            echo "<td class='border border-gray-300 px-4 py-2'>{$data['email']}</td>";
                            echo "<td class='border border-gray-300 px-4 py-2'>{$data['message']}</td>";
                            echo "</tr>";
                        }
                    }
                    echo '
                    </tbody>
                </table>
            </div>
        </body>
        
        </html>';
}
