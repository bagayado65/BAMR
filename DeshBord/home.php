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
    <div id="app">
        <v-app>
            <v-app-bar class="primary" absolute flat app>
                <v-app-bar-title>
                    <h2 style="color: white;">
                        DeshBords
                    </h2>
                </v-app-bar-title>
                <v-spacer></v-spacer>
                <v-continer>
                    <v-row>
                        <v-col cols="5" sm="auto">
                            <v-btn class="light-blue accent-4" @click="vbtnDesh('login')" @mouseover="sw_msg = true" @mouseleave="sw_msg = false" depressed>
                                <v-icon color="white">
                                    mdi-login
                                </v-icon>
                                <span style="color:white;" v-if="sw_msg">Login</span>
                            </v-btn>
                        </v-col>
                        <v-col>
                            <v-btn class="success" @click="vbtnDesh('register')" @mouseover="sw_msg1 = true" @mouseleave="sw_msg1 = false" depressed>
                                <v-icon>
                                    mdi-account
                                </v-icon>
                                <span v-if="sw_msg1">register</span>
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-continer>
            </v-app-bar>
            <v-main>
                <v-container>
                    <v-row>
                        <v-col>
                            <template>
                                <!-- <v-btn width="100%">
                                                <v-text>Calendar</v-text>
                                            </v-btn> -->
                                <v-select class="mt-4 ml-2 mr-2" @change="fetch_calendar()" v-model="selectCalendar" :items="nameroom" item-text="NameRoom" item-value="NameRoom_ID" label="ชื่อห้องประชุม" dense></v-select>
                                <v-row>
                                    <v-col>
                                        <v-sheet height="600">
                                            <v-row>
                                                <v-col>
                                                    <v-btn icon @click="prv_mount()">
                                                        <v-icon>mdi-chevron-left</v-icon>
                                                    </v-btn>
                                                    <v-btn icon @click="next_mount()">
                                                        <v-icon>mdi-chevron-right</v-icon>
                                                    </v-btn>
                                                </v-col>
                                                <v-col>
                                                    <!-- <v-select v-model="type" :items="typesing" dense outlined hide-details class="ma-2" label="type"></v-select> -->
                                                </v-col>
                                            </v-row>
                                            <v-calendar ref="calendar" :now="todays" :value="todays" :events="events" color="primary" :type="type"></v-calendar>
                                        </v-sheet>
                                    </v-col>
                                </v-row>
                            </template>
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
                todays: new Date(),
                type: 'month',
                typesing: ['month', 'week', 'day', '4day'],
                events: '',
                nameroom: '',
                selectCalendar: '',

            },
            computed: {},
            watch: {},
            created() {
                this.fetch_nameroom()
            },
            methods: {
                vbtnDesh: function(xiv) {
                    if (xiv == 'login') {
                        location.href = "../Login"
                    } else if (xiv == 'register') {
                        location.href = "../Register"
                    }
                },
                fetch_calendar: function() {
                    axios.post('../Database/db_Calendar.php', {
                        action: 'fetchcalendar',
                        NameRoom_ID: this.selectCalendar
                    }).then(function(response) {
                        app.events = response.data;
                    });
                },
                fetch_nameroom: function() {
                    axios.post('../Database/db_Nameroom.php', {
                        action: 'fetchall',
                    }).then(function(response) {
                        app.nameroom = response.data;
                    });
                },
                prv_mount: function() {
                    if (this.type == 'month') {
                        this.todays = new Date(this.todays.setMonth(this.todays.getMonth() - 1))
                    }
                },
                next_mount: function() {
                    if (this.type == 'month') {
                        this.todays = new Date(this.todays.setMonth(this.todays.getMonth() + 1))
                    }
                },
            }
        })
    </script>
</body>

</html>