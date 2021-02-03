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
            <v-navigation-drawer v-model="drawer" app>
                <v-list nav dense>
                    <v-list-item-group v-model="group" active-class="deep-purple--text text--accent-4">
                        <v-list-item @click="home">
                            <v-list-item-icon>
                                <v-icon>mdi-key-variant</v-icon>
                            </v-list-item-icon>
                            <v-list-item-title>.....</v-list-item-title>
                        </v-list-item>

                        <v-list-item>
                            <v-list-item-icon>
                                <v-icon>mdi-account</v-icon>
                            </v-list-item-icon>
                            <v-list-item-title>.....</v-list-item-title>
                        </v-list-item>
                    </v-list-item-group>
                </v-list>
            </v-navigation-drawer>
            <v-app-bar class="primary" absolute flat app>
                <v-app-bar-nav-icon color="white" @click="drawA"></v-app-bar-nav-icon>
                <v-app-bar-title>
                    <h2 style="color: white;">
                        Meeting Room
                    </h2>
                </v-app-bar-title>
                <v-spacer></v-spacer>
                <v-continer>
                    <v-row>
                        <v-col cols="5" sm="auto">
                            <v-btn class="light-blue accent-4" @click="" @mouseover="sw_msg = true" @mouseleave="sw_msg = false" depressed>
                                <v-icon color="white">
                                    mdi-account-card-details
                                </v-icon>
                                <span style="color:white;" v-if="sw_msg"> account</span>
                            </v-btn>
                        </v-col>
                        <v-col cols="5" sm="auto">
                            <v-btn class="success" @click="" @mouseover="sw_msg1 = true" @mouseleave="sw_msg1 = false" depressed>
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
                <v-card class="ma-2">
                    <v-card-title>
                        เลือกวันที่จอง
                    </v-card-title>
                    <v-card-action>
                        <v-form action="../home.php" method="post">
                            <v-date-picker v-model="range" is-range>
                                <template v-slot="{ inputValue, inputEvents }">
                                    <div class="flex justify-center items-center">
                                        <input name="dateStart" :value="inputValue.start" v-on="inputEvents.start" class="border px-2 py-1 w-32 rounded focus:outline-none focus:border-indigo-300" />
                                        <span class="ml-2 mr-2">ถังวันที่</span>
                                        <input name="dateEnd" :value="inputValue.end" v-on="inputEvents.end" class="border px-2 py-1 w-32 rounded focus:outline-none focus:border-indigo-300" />
                                        <v-btn type="submit">
                                            ยืนยัน
                                        </v-btn>
                                    </div>
                                </template>
                            </v-date-picker>
                            <!-- <v-btn type="submit"> -->
                        </v-form>
                    </v-card-action>
                </v-card>
                <v-card class="ma-2">
                    <v-card-title>
                        วันที่จองแล้ว
                    </v-card-title>
                </v-card>
            </v-main>
        </v-app>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
    <script src='https://unpkg.com/v-calendar'></script>
    <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>

    <script>
        var datetomorrow = new Date();
        var app = new Vue({
            el: '#app',
            vuetify: new Vuetify(),
            data: {
                sw_msg: false,
                sw_msg1: false,
                drawer: false,
                range: {
                    start: new Date(),
                    end: datetomorrow.setDate(datetomorrow.getDate() + 1),
                },
            },
            methods: {
                drawA: function() {
                    this.drawer = !this.drawer
                },
                localhrefLogin: function() {
                    location.href = "../Login"
                },
            }
        })
    </script>
</body>

</html>