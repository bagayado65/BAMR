<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <link rel="icon" href="../IMG/icons8-room-90.png" type="image/x-icon">
    <link rel="stylesheet" href="../CSS/Calendar.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
    <title>BAMR</title>
</head>

<body>
    <?php
    session_start();

    // session_destroy();
    // unset($_SESSION["IDOF"]);
    // unset($_SESSION["PASSWORDOF"]);
    // unset($_SESSION["IDUSERCAT"]);
    // $_SESSION["USER_ID"] = $row['User_id'];
    // $_SESSION["USERNAMES"] = $row['Username'];
    // $_SESSION["PASSWORDS"] = $row['Passwords'];
    // $_SESSION["NAME"] = $row['Name'];
    // $_SESSION["EMAIL"] = $row['Email'];
    // header("Location:index.php");
    ?>
    <div id="app">
        <v-app>
            <v-app-bar class="primary" absolute flat app>
                <v-app-bar-title>
                    <h2 style="color: white;">
                        Profile Account
                    </h2>
                </v-app-bar-title>
                <v-spacer></v-spacer>
                <v-continer>
                    <v-row>
                        <v-col cols="5" sm="auto">
                            <v-btn class="light-blue accent-4" @click="local_Meeting()" @mouseover="sw_msg = true" @mouseleave="sw_msg = false" depressed>
                                <v-icon color="white">
                                    mdi-table-edit
                                </v-icon>
                                <span style="color:white;" v-if="sw_msg">Report Meeting</span>
                            </v-btn>
                        </v-col>
                        <v-col cols="5" sm="auto">
                            <v-btn class="success" @click="local_logout()" @mouseover="sw_msg1 = true" @mouseleave="sw_msg1 = false" depressed>
                                <v-icon>
                                    mdi-logout-variant
                                </v-icon>
                                <span v-if="sw_msg1">Logout</span>
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-continer>
            </v-app-bar>
            <v-main>
                <v-container>
                    <v-row>
                        <v-col>
                            <v-card v-for="item in users" :key="item.User_id">
                                <v-card-title primary-title>
                                    {{ item.Name }}
                                </v-card-title>
                                <v-divider></v-divider>
                                <v-row>
                                    <v-col>
                                        <v-card-text>
                                            <v-text-field v-model="emails" :label="item.Email"></v-text-field>
                                        </v-card-text>
                                    </v-col>
                                </v-row>
                                <v-divider></v-divider>
                                <v-row>
                                    <v-col>
                                        <v-card-text>
                                            <v-text-field v-model="phones" :label="item.Phone"></v-text-field>
                                        </v-card-text>
                                    </v-col>
                                </v-row>
                                <v-divider></v-divider>
                                <v-row>
                                    <v-col>
                                        <v-btn @click="email_edit_axios()" class="white--text" color="orange" min-width="100%" min-height="100%">
                                            แก้ไข!!
                                        </v-btn>
                                    </v-col>
                                </v-row>
                            </v-card>
                        </v-col>
                        <v-col>
                        </v-col>
                    </v-row>
                </v-container>
            </v-main>
        </v-app>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script>
        var app = new Vue({
            el: '#app',
            vuetify: new Vuetify(),
            data: {
                sw_msg: false,
                sw_msg1: false,
                users: '',
                emails: '',
                phones: ''
            },
            computed: {},
            watch: {},
            created() {
                this.fetchAllData()
            },
            methods: {
                fetchAllData: function() {
                    axios.post('../Database/db_user.php', {
                        action: 'fetchall',
                        User_ID: <?php echo "'" . $_SESSION["USER_ID"] . "'" ?>
                    }).then(function(response) {
                        app.users = response.data;
                        console.log(app.users);
                    });
                },
                email_edit_axios: function() {
                    axios.post('../Database/db_user.php', {
                        action: 'update',
                        emails: app.emails,
                        phones: app.phones,
                        user_id: <?php echo "'" . $_SESSION["USER_ID"] . "'" ?>
                    }).then(function(response) {
                        app.fetchAllData();
                        app.emails = response.data.Email;
                        app.phones = response.data.Phone;
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'bottom-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })
                        Toast.fire({
                            icon: 'success',
                            title: 'แก้ไขข้อมูลส่วนตัว สำเร็จ!!'
                        })
                    });
                },
                local_Meeting: function() {
                    location.href = "../Calendar/"
                },
                local_logout: function() {
                    location.href = "../Login/log_out.php"
                },
            }
        })
    </script>
</body>

</html>