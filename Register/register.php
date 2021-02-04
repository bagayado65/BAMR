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
    <div id="app">
        <v-app>
            <v-app-bar class="primary" absolute flat>
                <!-- <v-app-bar-nav-icon @click="drawer = !darwer"></v-app-bar-nav-icon> -->
                <v-app-bar-title class="ml-12">
                    <h2 style="color: white;">
                        สมัครสมาชิก BAMR
                    </h2>
                </v-app-bar-title>
                <v-spacer></v-spacer>
                <v-continer>
                    <v-row>
                        <v-col>
                            <v-btn class="light-blue accent-4" @mouseover="sw_msg = true" @mouseleave="sw_msg = false" depressed>
                                <v-icon color="white">
                                    mdi-home
                                </v-icon>
                                <span style="color:white;" v-if="sw_msg">home</span>
                            </v-btn>
                        </v-col>
                        <v-col>
                            <v-btn class="success" @click="localhrefLogin" @mouseover="sw_msg1 = true" @mouseleave="sw_msg1 = false" depressed>
                                <v-icon>
                                    mdi-login-variant
                                </v-icon>
                                <span v-if="sw_msg1">Login</span>
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-continer>
            </v-app-bar>
            <div class="pa-4"></div>
            <v-card class="primary mx-auto my-auto">
                <v-card-title class="white--text">
                    สมัครสมาชิก
                </v-card-title>
                <v-card-subtitle class="font-weight-thin white--text">
                    สำหรับสมาชิก
                </v-card-subtitle>
                <v-form action="../Database/db_register.php" method="post">
                    <v-stepper v-model="e6" vertical class="elevation-0">
                        <v-stepper-step :complete="e6 > 1" step="1">
                            ข้อมูลส่วนตัว
                            <small></small>
                        </v-stepper-step>

                        <v-stepper-content step="1">
                            <v-card>
                                <v-continer>
                                    <v-row>
                                        <v-col>
                                            <v-text-field v-model="firstname" label="ชื่อจริง" name="firstname" />
                                        </v-col>
                                        <v-col>
                                            <v-text-field v-model="lastname" label="นามสกุล" name="lastname" />
                                        </v-col>
                                    </v-row>
                                    <v-row>
                                        <v-col>
                                            <v-text-field v-model="emails" :rules="[ rules.email ]" label="อีเมล" name="email" />
                                        </v-col>
                                    </v-row>
                                    <v-row>
                                        <v-col>
                                            <!-- <v-text-field v-model="phone" label="เบอร์โทรศัพท์/มือถือ" type="number" name="phone" /> -->
                                            <vue-tel-input v-model="phone" label="เบอร์โทรศัพท์/มือถือ" type="number"></vue-tel-input>
                                            <input type="hidden" name="phone" :value="phone">
                                        </v-col>
                                    </v-row>
                                    <v-row>
                                        <v-col></v-col>
                                        <v-col cols="4">
                                            <v-btn color="primary" @click="e6plus()">
                                                ต่อไป
                                            </v-btn>
                                        </v-col>
                                    </v-row>
                                </v-continer>
                            </v-card>
                            <!--  Confirm-->
                        </v-stepper-content>

                        <v-stepper-step :complete="e6 > 2" step="2">
                            ข้อมูลสำหรับเข้าสู่ระบบ
                        </v-stepper-step>

                        <v-stepper-content step="2">
                            <v-card>
                                <v-continer>
                                    <v-row>
                                        <v-col>
                                            <v-text-field v-model="username" label="Username" name="username" />
                                        </v-col>
                                    </v-row>
                                    <v-row>
                                        <v-col>
                                            <v-text-field v-model="password" label="Password" name="password" type="password" />
                                        </v-col>
                                    </v-row>
                                    <v-row>
                                        <v-col>
                                            <v-text-field v-model="confirmpassword" :rules="[ check_pw ]" label="ConfirmPassword" type="password" />
                                        </v-col>
                                    </v-row>
                                    <v-row>
                                        <v-col></v-col>
                                        <v-col>
                                            <v-btn color="primary" @click="e6plus()">
                                                ต่อไป
                                            </v-btn>
                                        </v-col>
                                        <v-col>
                                            <v-btn @click="e6cancel()">
                                                ยกเลิก
                                            </v-btn>
                                        </v-col>
                                    </v-row>
                                </v-continer>
                            </v-card>
                        </v-stepper-content>

                        <v-stepper-step :complete="e6 > 3" step="3">
                            รหัส6ตัวที่Email
                        </v-stepper-step>

                        <v-stepper-content step="3">
                            <v-card>
                                <v-continer>
                                    <v-row>
                                        <v-col>
                                            <v-text-field v-model="codesix" label="######" />
                                        </v-col>
                                    </v-row>
                                    <v-row>
                                        <v-col></v-col>
                                        <v-col>
                                            <v-btn color="primary" @click="e6plus()">
                                                ต่อไป
                                            </v-btn>
                                        </v-col>
                                        <v-col>
                                            <v-btn @click="e6 = 2">
                                                ยกเลิก
                                            </v-btn>
                                        </v-col>
                                    </v-row>
                                </v-continer>
                            </v-card>
                        </v-stepper-content>
                    </v-stepper>
                    <v-btn v-if="e6 == 4" class="rounded-b-md mt-2" width="100%" type="submit">
                        ยืนยันการสมัคร
                    </v-btn>
                </v-form>
            </v-card>
            <!-- <v-card>
                <v-btn @click="swt_success">
                    test swee
                </v-btn>
            </v-card> -->
        </v-app>
    </div>
    <script src="https://smtpjs.com/v3/smtp.js"></script> <!-- send mail -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script> <!-- vue -->
    <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script> <!-- vuetify -->
    <script src="https://unpkg.com/vue-tel-input"></script>
    <link rel="stylesheet" href="https://unpkg.com/vue-tel-input/dist/vue-tel-input.css">
    <script>
        var app = new Vue({
            el: '#app',
            vuetify: new Vuetify(),
            data: {
                firstname: null,
                lastname: null,
                phone: null,
                emails: null,
                checkemail: false,
                username: null,
                password: null,
                confirmpassword: null,
                codesix: null,
                numrandom: Math.random().toString(36).substring(7),
                // drawer: false,
                sw_msg: false,
                sw_msg1: false,
                e6: 1,
                rules: {
                    email: value => {
                        const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                        return pattern.test(value) || 'อีเมลไวยากรณ์  ไม่ถูกต้อง'
                    },
                },
            },
            computed: {
                check_pw() {
                    return () => (this.password === this.confirmpassword) || 'รหัสผ่านไม่ตรงกัน'
                }
            },
            methods: {
                say: function(msg) {
                    this.name = this.firstname + " " + this.lastname
                    console.log(this.name)
                },
                localhrefLogin: function() {
                    location.href = "../Login"
                },
                e6plus: function() {
                    if (this.e6 == 1) {
                        if (this.emails == null || this.emails == '' || !this.validateEmail()) {
                            Swal.fire(
                                'คุณไม่ได้กรอก Email',
                                'กรุณากรอกอีเมลเพื่อรับรหัส6ตัว!!',
                                'warning'
                            )
                            this.e6 = 1
                            this.checkemail = false
                        } else {
                            this.e6 += 1
                            this.checkemail = true
                            this.send_email()
                        }
                        if (!this.validateEmail()) {
                            Swal.fire(
                                'คุณไม่ได้กรอก Email',
                                'อีเมลไวยากรณ์  ไม่ถูกต้อง!!',
                                'warning'
                            )
                            this.e6 = 1
                            this.checkemail = false
                        }
                    } else if (this.e6 == 2) {
                        if (this.password !== this.confirmpassword) {
                            this.e6 = 2
                            this.password = null
                            this.confirmpassword = null
                            Swal.fire(
                                'รหัสผ่านผิดพลาด',
                                'กรอกรหัสไม่ตรงกัน',
                                'warning'
                            )
                        } else if (this.password == null || this.confirmpassword == null) {
                            this.e6 = 2
                            Swal.fire(
                                'รหัสผ่านผิดพลาด',
                                'ไม่ได้กรอกรหัสผ่าน',
                                'warning'
                            )
                        } else {
                            this.e6 += 1
                        }
                    } else if (this.e6 == 3) {
                        if (this.codesix !== this.numrandom) {
                            this.e6 = 3
                            this.codesix = null
                            Swal.fire(
                                'รหัส6ตัว!!',
                                'รหัส6ตัวไม่ตรงกัน!!',
                                'warning'
                            )
                        } else {
                            this.e6 += 1
                        }
                    }
                },
                send_email: function() {
                    Email.send({
                            Host: "smtp.gmail.com",
                            Username: "bamr.meetingroom@gmail.com",
                            Password: "Nwl!pbru2563",
                            To: this.emails,
                            From: "bamr.meetingroom@gmail.com",
                            Subject: "รหัส 6 ตัว",
                            Body: "<h2 style = " + "text-align:center;" + ">" + this.numrandom + "</h2>",
                        })
                        .then(function(message) {
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
                                title: 'ส่งรหัส6ตัวที่ email!!'
                            })
                        })
                },
                e6cancel: function() {
                    if (this.e6 == 1) {
                        this.firstname = null
                        this.lastname = null
                        this.emails = null
                        this.phone = null
                    } else if (this.e6 == 2) {
                        this.username = null
                        this.password = null
                        this.confirmpassword = null
                        this.e6 -= 1
                    } else if (this.e6 == 3){
                        this.codesix = null
                    }
                },
                validateEmail: function() {
                    const emailReg = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                    var g = this.emails
                    return emailReg.test(g)
                },
            }
        })
    </script>
</body>
</html>