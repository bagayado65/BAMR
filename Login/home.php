<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <link rel="icon" href="../IMG/icons8-room-90.png" type="image/x-icon">
    <link rel="stylesheet" href="../CSS/Register.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">

    <title>BAMR</title>
</head>

<body>
    <?php
    session_start();
    error_reporting(error_reporting() & ~E_NOTICE);
    $m = "";
    if (count($_POST) > 0) {
        include '../Database/connect.php';
        $u = $_POST['username'];
        $p = $_POST['password'];
        $sql = "SELECT * FROM user WHERE Username = '$u' and Passwords = '$p' "; //จะดึงอะไรมาเปรียบเทียบ
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if (is_array($row)) {
            $_SESSION["USER_ID"] = $row['User_id'];
            $_SESSION["USERNAMES"] = $row['Username'];
            $_SESSION["PASSWORDS"] = $row['Passwords'];
            $_SESSION["NAME"] = $row['Name'];
            $_SESSION["EMAIL"] = $row['Email'];
            $_SESSION["PHONE"] = $row['Phone'];
            $_SESSION["POSITION"] = $row['Position'];
            $_SESSION["STATUS"] = $row['Status'];
        } else {
            $m = "รหัสผ่าน/ชื่อผู้ใช้ ผิด!!";
        }
    }
    if (isset($_SESSION["USER_ID"])) {
        if ($_SESSION["POSITION"] == 1) {
            if ($_SESSION["STATUS"] == 0) {
                session_destroy();
                header("Location:../Login");
            } else {
                header("Location:../Calendar");
            }
        } else if ($_SESSION["POSITION"] == 0) {
            if ($_SESSION["STATUS"] == 0) {
                session_destroy();
                header("Location:../Login");
            } else {
                header("Location:../SuCalendar");
            }
        }
    }
    ?>
    <div id="app">
        <v-app>
            <v-app-bar class="primary" absolute flat>
                <v-app-bar-title class="ml-12">
                    <h2 style="color:white;">
                        Login
                    </h2>
                </v-app-bar-title>
                <v-spacer></v-spacer>
                <v-continer>
                    <v-row>
                        <v-col>
                            <v-btn class="light-blue accent-4" @click="vbtnDesh()" @mouseover="sw_msg = true" @mouseleave="sw_msg = false" depressed>
                                <v-icon color="white">
                                    mdi-home
                                </v-icon>
                                <span style="color:white;" v-if="sw_msg">home</span>
                            </v-btn>
                        </v-col>
                        <v-col>
                            <v-btn class="success" @click="localhrefRegister" @mouseover="sw_msg1 = true" @mouseleave="sw_msg1 = false" depressed>
                                <v-icon>
                                    mdi-account
                                </v-icon>
                                <span v-if="sw_msg1">register</span>
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-continer>
            </v-app-bar>
            <v-card class=" primary mx-auto my-auto" width="410">
                <v-card-title class="white--text">
                    Login BAMR
                </v-card-title>
                <v-card-subtitle class="font-weight-thin white--text">
                    ^w^
                </v-card-subtitle>
                <v-card class="elevation-0">
                    <v-card-text>
                        <v-form action="" method="post">
                            <v-continer>
                                <v-row>
                                    <v-col>
                                        <v-text-field @input="cancelPuts()" v-model="username" label="Username" name="username" />
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col>
                                        <v-text-field @input="cancelPuts()" v-model="password" label="Password" name="password" type="password" />
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col v-if="check_u_p != ''">
                                        <v-alert type="error">
                                            {{ check_u_p }}
                                        </v-alert>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col>
                                    </v-col>
                                    <v-col cols="4">
                                        <v-btn class="success" type="submit">
                                            Confirm
                                        </v-btn>
                                    </v-col>
                                </v-row>
                            </v-continer>
                        </v-form>
                    </v-card-text>
                </v-card>
            </v-card>
        </v-app>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
    <script>
        // var tom = new Date();
        // var today = new Date();
        // //(พศ,เดือน+1,วัน,ชม = PM,นาที,วินาที) 1612921864749 1612921560504
        // console.log('tom = ', tom);
        // console.log('today = ', today);
        // var g = today + (tom - today);
        // console.log('day = ', g);

        var app = new Vue({
            el: '#app',
            vuetify: new Vuetify(),
            data: {
                check_u_p: <?php echo "'" . $m . "'" ?>,
                sw_msg: false,
                sw_msg1: false,
            },
            methods: {
                localhrefRegister: function() {
                    location.href = "../Register"
                },
                cancelPuts: function() {
                    this.check_u_p = ''
                },
                vbtnDesh: function() {
                    location.href = "../DeshBord"
                },
            }
        })
    </script>
</body>

</html>