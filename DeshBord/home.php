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
                        HOME
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
                                        <v-sheet height="550">
                                            <v-row>
                                                <v-col>
                                                    <v-btn icon @click="prv_mount()">
                                                        <v-icon>mdi-chevron-left</v-icon>
                                                    </v-btn>
                                                    <v-btn icon @click="next_mount()">
                                                        <v-icon>mdi-chevron-right</v-icon>
                                                    </v-btn>
                                                    <v-menu bottom right>
                                                        <template v-slot:activator="{ on, attrs }">
                                                            <v-btn outlined color="grey darken-2" v-bind="attrs" v-on="on">
                                                                <span>{{ typeToLabel[type] }}</span>
                                                                <v-icon right>
                                                                    mdi-menu-down
                                                                </v-icon>
                                                            </v-btn>
                                                        </template>
                                                        <v-list>
                                                            <v-list-item @click="type = 'day'">
                                                                <v-list-item-title>Day</v-list-item-title>
                                                            </v-list-item>
                                                            <v-list-item @click="type = 'week'">
                                                                <v-list-item-title>Week</v-list-item-title>
                                                            </v-list-item>
                                                            <v-list-item @click="type = 'month'">
                                                                <v-list-item-title>Month</v-list-item-title>
                                                            </v-list-item>
                                                            <v-list-item @click="type = '4day'">
                                                                <v-list-item-title>4 days</v-list-item-title>
                                                            </v-list-item>
                                                        </v-list>
                                                    </v-menu>
                                                </v-col>
                                            </v-row>
                                            <v-toolbar-title v-if="$refs.calendar">
                                                {{ $refs.calendar.title }}
                                            </v-toolbar-title>
                                            <v-calendar ref="calendar" @click:more="viewDay" @click:date="viewDay" :now="todays" :value="todays" :events="events" color="primary" :type="type"></v-calendar>
                                        </v-sheet>
                                    </v-col>
                                </v-row>
                            </template>
                        </v-col>
                    </v-row>
                </v-container>
                <!-- <v-fab-transition> -->
                <v-tooltip top>
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn @click="showdatacall = !showdatacall,fetch_alls()" fab small dark bottom left class="primary ml-10" v-bind="attrs" v-on="on">
                            <v-icon>mdi-chevron-up</v-icon>
                        </v-btn>
                    </template>
                    <span>ดูห้องไม่ว่างในตอนนี้</span>
                </v-tooltip>
                <!-- </v-fab-transition> -->
                <v-dialog v-model="showdatacall" persistent transition="dialog-bottom-transition" max-width="76%">
                    <v-card>
                        <!-- v-if="i != 0" -->
                        <v-card-title>
                            <v-text>
                                ห้องไม่ว่าง {{ today_SA }}
                            </v-text>
                            <v-spacer></v-spacer>
                            <v-btn @click="showdatacall = !showdatacall" color="red" icon>
                                <v-icon>
                                    mdi-close
                                </v-icon>
                            </v-btn>
                        </v-card-title>
                        <v-list>
                            <v-list-item-group>
                                <v-list-item v-for="(itemes,i) in sentarall" :key="i">
                                    <v-list-item-content>
                                        <v-list-item-title>
                                            <v-badge color="red" dot>
                                                <v-text>
                                                    ห้องประชุม : {{ itemes.NameRoom }}
                                                    <v-text class="red--text">
                                                        ไม่ว่างในตอนนี้
                                                    </v-text>
                                                </v-text>
                                            </v-badge>
                                        </v-list-item-title>
                                    </v-list-item-content>
                                </v-list-item>
                            </v-list-item-group>
                        </v-list>
                        <v-card-title>
                            <v-text>
                                ห้องว่าง {{ today_SA }}
                            </v-text>
                        </v-card-title>
                        <v-list>
                            <v-list-item-group>
                                <v-list-item v-for="(itemes,i) in sentarall_last" :key="i">
                                    <v-list-item-content>
                                        <v-list-item-title>
                                            <v-badge color="green" dot>
                                                <v-text>
                                                    ห้องประชุม : {{ itemes.NameRoom }}
                                                    <v-text class="green--text">
                                                        ว่างในตอนนี้
                                                    </v-text>
                                                </v-text>
                                            </v-badge>
                                        </v-list-item-title>
                                    </v-list-item-content>
                                </v-list-item>
                            </v-list-item-group>
                        </v-list>
                    </v-card>
                </v-dialog>
            </v-main>
        </v-app>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script>
        let datest = new Date();
        var app = new Vue({
            el: '#app',
            vuetify: new Vuetify(),
            data: {
                sw_msg: false,
                sw_msg1: false,
                todays: new Date(),
                today_SA: datest.toLocaleString(),
                type: 'month',
                typeToLabel: {
                    month: 'Month',
                    week: 'Week',
                    day: 'Day',
                    '4day': '4 Days',
                },
                events: '',
                nameroom: '',
                selectCalendar: '',
                // numicons: 1,
                showdatacall: false,
                sentarall: '',
                sentarall_last: '',
            },
            computed: {},
            watch: {},
            created() {
                this.fetch_nameroom()
                this.fetch_alls()
            },
            methods: {
                viewDay({
                    date
                }) {
                    // this.focus = date
                    this.type = 'day'
                },
                vbtnDesh: function(xiv) {
                    if (xiv == 'login') {
                        location.href = "../Login"
                    } else if (xiv == 'register') {
                        location.href = "../Register"
                    }
                },
                show_main: function() {
                    axios.post('../Database/db_Calendar.php', {
                        action: 'fetchcalendar_all',
                    }).then(function(response) {
                        app.events = response.data;
                    })
                },
                fetch_calendar: function() {
                    if (this.selectCalendar == 1) {
                        axios.post('../Database/db_Calendar.php', {
                            action: 'fetchcalendar_all',
                        }).then(function(response) {
                            app.events = response.data;
                        })
                    } else {
                        axios.post('../Database/db_Calendar.php', {
                            action: 'fetchcalendar',
                            NameRoom_ID: this.selectCalendar
                        }).then(function(response) {
                            app.events = response.data;
                        })
                    }
                },
                fetch_alls: function() {
                    axios.post('../Database/db_Calendar.php', {
                        action: 'autoChess',
                    }).then(function(response) {
                        app.sentarall = response.data;
                    });
                    axios.post('../Database/db_Calendar.php', {
                        action: 'autoChess1',
                    }).then(function(response) {
                        app.sentarall_last = response.data;
                    });
                    var todayjs = new Date()
                    this.today_SA = todayjs.toLocaleString()
                },
                fetch_nameroom: function() {
                    axios.post('../Database/db_Nameroom.php', {
                        action: 'fetchall',
                    }).then(function(response) {
                        app.nameroom = response.data;
                        app.selectCalendar = response.data[0];
                        app.show_main()
                    });
                },
                prv_mount: function() {
                    if (this.type == 'month') {
                        this.todays = new Date(this.todays.setMonth(this.todays.getMonth() - 1))
                    }
                    if (this.type == 'week') {
                        this.todays = new Date(this.todays.setDate(this.todays.getDate() - 7))
                    }
                    if (this.type == 'day') {
                        this.todays = new Date(this.todays.setDate(this.todays.getDate() - 1))
                    }
                    if (this.type == '4day') {
                        this.todays = new Date(this.todays.setDate(this.todays.getDate() - 4))
                    }
                },
                next_mount: function() {
                    if (this.type == 'month') {
                        this.todays = new Date(this.todays.setMonth(this.todays.getMonth() + 1))
                    }
                    if (this.type == 'week') {
                        this.todays = new Date(this.todays.setDate(this.todays.getDate() + 7))
                    }
                    if (this.type == 'day') {
                        this.todays = new Date(this.todays.setDate(this.todays.getDate() + 1))
                    }
                    if (this.type == '4day') {
                        this.todays = new Date(this.todays.setDate(this.todays.getDate() + 4))
                    }
                },
            }
        })
    </script>
</body>

</html>