<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <link rel="icon" href="../IMG/icons8-room-90.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.6.0/dist/sweetalert2.all.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
    <title>BAMR</title>
</head>

<body>
    <div id="app">
        <v-app>
            <v-overlay :value="overlay">
                <v-progress-circular :rotate="180" :width="25" :size="230" color="white" indeterminate>
                    <v-progress-circular :width="10" :size="200" color="primary" indeterminate></v-progress-circular>
                </v-progress-circular>
            </v-overlay>
            <?php
            date_default_timezone_set('Asia/Bangkok');
            $datetimez = date("Y-m-d");
            $name = $_POST["firstname"] . " " . $_POST["lastname"];
            $usern = $_POST["username"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $passwords = $_POST["password"];
            $username = $_POST["username"];
            include "connect.php";
            $sql = "INSERT INTO user VALUE (null,'$name','$usern','$passwords','$email','$phone','1','1','$name','','$datetimez','0000-00-00') ";
            if (mysqli_query($conn, $sql)) {
                echo '<script>';
                echo "Swal.fire({
                    title: 'สำเร็จ!',
                    text: 'การสมัครสมาชิก',
                    icon: 'success',
                    confirmButtonText: 'Back'
                }).then(function() {
                    window.location.href = '../Login';
                });";
                echo '</script>';
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            mysqli_close($conn);
            ?>
        </v-app>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
    <script>
        var app = new Vue({
            el: '#app',
            vuetify: new Vuetify(),
            data: {},
            methods: {}
        })
    </script>
</body>

</html>