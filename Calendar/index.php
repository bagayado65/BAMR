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
            <!-- <v-navigation-drawer v-model="drawer" app>
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
            </v-navigation-drawer> -->
            <v-app-bar class="primary" absolute flat app>
                <!-- <v-app-bar-nav-icon color="white" @click="drawA()"></v-app-bar-nav-icon> -->
                <v-app-bar-title>
                    <h2 style="color: white;">
                        Meeting Room
                    </h2>
                </v-app-bar-title>
                <v-spacer></v-spacer>
                <v-continer>
                    <v-row>
                        <v-col cols="5" sm="auto">
                            <v-btn class="light-blue accent-4" @click="local_account()" @mouseover="sw_msg = true" @mouseleave="sw_msg = false" depressed>
                                <v-icon color="white">
                                    mdi-account-card-details
                                </v-icon>
                                <span style="color:white;" v-if="sw_msg"> account</span>
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
                            <v-card>
                                <v-card-title>
                                    <v-text>
                                        เลือกวันที่จองห้องประชุม
                                    </v-text>
                                    <!-- <v-btn @click="testaxios()" color="success">
                                        insert
                                    </v-btn> -->
                                    <!-- <v-btn color="success" @click="fetch_checktime()">text</v-btn> -->
                                    <v-spacer></v-spacer>
                                    <input style="width: 300px;" type="text" id="myInput" onkeyup="SearchFuntion()" placeholder="ค้นหาชื่อห้องประชุม..." title="Type in a name">
                                    <v-divider vertical></v-divider>
                                    <v-btn color="success" icon @click="dlcard = !dlcard">
                                        <v-icon>mdi-plus-circle</v-icon>
                                    </v-btn>
                                </v-card-title>
                                <v-dialog v-model="dlcard" persistent max-width="600" max-height="600">
                                    <v-card min-height="400">
                                        <v-card-title>
                                            สร้างวันจองห้องประชุม
                                            <v-spacer></v-spacer>
                                            <v-btn @click="cencalmeetcard()" color="error" icon>
                                                <v-icon>mdi-close-circle</v-icon>
                                            </v-btn>
                                        </v-card-title>
                                        <v-card-action>
                                            <v-card-text>
                                                <v-container>
                                                    <v-divider></v-divider>
                                                    <v-row>
                                                        <v-col class="ml-6 mt-4">
                                                            <v-select v-model="dataCld_insert.NameRoom" :items="nameroom" item-text="NameRoom" item-value="NameRoom_ID" label="ชื่อห้องประชุม" dense></v-select>
                                                            <v-spacer></v-spacer>
                                                            <div>
                                                                <input @change="fetch_checktime()" v-model="dataCld_insert.Start_day" type="date" id="meeting-time" name="meeting-time" :min="dayeatone" />
                                                            </div>
                                                            <div>
                                                                <input @change="fetch_checktime()" v-model="dataCld_insert.Start_time" type="time" id="meeting-time" name="meeting-time" /> <span class="ml-2 mr-5"> ถึงเวลา </span> <input v-model="dataCld_insert.End_time" type="time" id="meeting-time" name="meeting-time" />
                                                            </div>
                                                        </v-col>
                                                    </v-row>
                                                    <v-row>
                                                        <v-col>
                                                        </v-col>
                                                    </v-row>
                                                    <v-divider></v-divider>
                                                    <v-row>
                                                        <v-col>
                                                            <v-textarea v-model="dataCld_insert.Description" class="ml-5 mt-4" label="หมายเหตุ" rows="2" append-outer-icon="mdi-comment">
                                                            </v-textarea>
                                                        </v-col>
                                                    </v-row>
                                                    <v-divider></v-divider>
                                                    <v-row>
                                                        <v-col sm="9">
                                                        </v-col>
                                                        <v-col sm="2">
                                                            <v-btn @click="insert_axios()" class="ml-5 mt-4" color="success">
                                                                ยืนยัน
                                                            </v-btn>
                                                        </v-col>
                                                    </v-row>
                                                </v-container>
                                            </v-card-text>
                                        </v-card-action>
                                    </v-card>
                                </v-dialog>
                            </v-card>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col>
                            <v-card>
                                <!-- ,fetchAll_id_data() -->
                                <v-btn @click="show_calendar = !show_calendar" width="100%">
                                    <v-text>Calendar</v-text>
                                </v-btn>
                                <template v-if="show_calendar == true">
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
                            </v-card>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col>
                            <div>
                                <v-card>
                                    <template>
                                        <v-simple-table id="myTable" fixed-header height="550px">
                                            <template v-slot:default>
                                                <thead>
                                                    <tr>
                                                        <th class="text-left">
                                                            ชื่อห้อง
                                                        </th>
                                                        <th class="text-left">
                                                            วัน
                                                        </th>
                                                        <th class="text-left">
                                                            เวลาเริ่ม - เวลาจบ
                                                        </th>
                                                        <th class="text-left">
                                                            หมายเหตุ
                                                        </th>
                                                        <th class="text-left">
                                                            actions
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="item in dataCld_fetchall" :key="item.NameRoom">
                                                        <td>{{ item.NameRoom }}</td>
                                                        <td>{{ item.Sday }}</td>
                                                        <td>{{ item.Stime }} - {{ item.Etime }}</td>
                                                        <td>{{ item.Description }}</td>
                                                        <td>
                                                            <v-btn @click="edit_data(item.MeetingRoom_ID)" color="orange" icon>
                                                                <v-icon class="mt-2">mdi-border-color</v-icon>
                                                            </v-btn>
                                                            <v-btn @click="delete_data(item.MeetingRoom_ID)" color="red" icon>
                                                                <v-icon>
                                                                    mdi-delete
                                                                </v-icon>
                                                            </v-btn>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </template>
                                        </v-simple-table>
                                    </template>
                                </v-card>
                            </div>
                            <v-dialog v-model="editcard" persistent max-width="600" max-height="600">
                                <v-card min-height="400">
                                    <v-card-title>
                                        แก้ไขวันจองห้องประชุม
                                        <v-spacer></v-spacer>
                                        <v-btn @click="cencalmeetcard()" color="error" icon>
                                            <v-icon>mdi-close-circle</v-icon>
                                        </v-btn>
                                    </v-card-title>
                                    <v-card-action>
                                        <v-card-text>
                                            <v-container>
                                                <v-divider></v-divider>
                                                <v-row>
                                                    <v-col class="ml-6 mt-4">
                                                        <v-select v-model="dataCld_edit.NameRoom_ID" :items="nameroom" item-text="NameRoom" item-value="NameRoom_ID" label="ชื่อห้องประชุม" dense></v-select>
                                                        {{ dataCld_edit.NameRoom }}
                                                        <v-spacer></v-spacer>
                                                        <div>
                                                            <input @change="fetch_checktime1()" v-model="dataCld_edit.Start_day" type="date" id="meeting-time" name="meeting-time" :min="dayeatone" />
                                                        </div>
                                                        <div>
                                                            <input @change="fetch_checktime1()" v-model="dataCld_edit.Start_time" type="time" id="meeting-time" name="meeting-time" /> <span class="ml-2 mr-5"> ถึงเวลา </span> <input v-model="dataCld_edit.End_time" type="time" id="meeting-time" name="meeting-time" />
                                                        </div>
                                                    </v-col>
                                                </v-row>
                                                <v-row>
                                                    <v-col>
                                                    </v-col>
                                                </v-row>
                                                <v-divider></v-divider>
                                                <v-row>
                                                    <v-col>
                                                        <v-textarea v-model="dataCld_edit.Description" class="ml-5 mt-4" label="หมายเหตุ" rows="2" append-outer-icon="mdi-comment">
                                                        </v-textarea>
                                                    </v-col>
                                                </v-row>
                                                <v-divider></v-divider>
                                                <v-row>
                                                    <v-col sm="9">
                                                    </v-col>
                                                    <v-col sm="2">
                                                        <v-btn @click="edit_axios()" class="ml-5 mt-4" color="success">
                                                            ยืนยัน
                                                        </v-btn>
                                                    </v-col>
                                                </v-row>
                                            </v-container>
                                        </v-card-text>
                                    </v-card-action>
                                </v-card>
                            </v-dialog>
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
        // var tom = new Date(1612947929433);
        var today = new Date();
        //(พศ,เดือน+1,วัน,ชม = PM,นาที,วินาที) 1612921864749 1612947929433
        // console.log('tom = ', tom);
        // console.log('today = ', today);
        // var tone = today.setDate(today.getDate() - 1);
        // var tonea = new Date(tone).toDateString();
        // console.log('tonea = ', tonea);
        // var g = tom.getTime() - today.getTime();
        // var s = Math.floor(g / 1000);
        // var h = Math.floor(s / 3600);
        // var m = Math.floor(s / 60);
        // var hms = Math.floor(m / 1440 * 100);
        // console.log('day = ', hms, h, m, s);
        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2)
                month = '0' + month;
            if (day.length < 2)
                day = '0' + day;

            return [year, month, day].join('-');
        }

        function SearchFuntion() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
        var today = new Date();
        var app = new Vue({
            el: '#app',
            vuetify: new Vuetify(),
            inject: ['reload'],
            data: {
                dataCld_insert: {
                    MeetingRoom_ID: null,
                    User_ID: <?php echo "'" . $_SESSION["USER_ID"] . "'" ?>,
                    NameRoom: null,
                    Numbar_User: '',
                    Start_day: '',
                    Start_time: '',
                    End_time: '',
                    Description: ''
                },
                nameroom: '',
                dataCld_edit: {
                    NameRoom_ID: null,
                    Start_day: '',
                    Start_time: '',
                    End_time: '',
                    Description: '',
                    MeetingRoom_ID: '',
                    User_ID: <?php echo "'" . $_SESSION["USER_ID"] . "'" ?>
                },
                dataCld_fetchall: '',
                dataCld_all_id: '',
                sw_msg: false,
                sw_msg1: false,
                // drawer: false,
                dayeatone: formatDate(today),
                dlcard: false,
                editcard: false,
                selectCalendar: '',
                show_calendar: false,
                counttime: '0',
                todays: new Date(),
                type: 'month',
                typesing: ['month', 'week', 'day', '4day'],
                events: '',
                range: {
                    start: '',
                    end: ''
                },
                numberelo: null,
            },
            computed: {},
            watch: {},
            created() {
                this.fetch_nameroom()
                this.fetchAll_id_data()
                this.fetchAllData()
            },
            methods: {
                test_date: function() {
                    console.log(this.dataCld_insert.User_ID)
                },
                // drawA: function() {
                //     this.drawer = !this.drawer
                // },
                local_logout: function() {
                    location.href = "../Login/log_out.php"
                },
                local_account: function() {
                    location.href = "../Profile/"
                },
                localhrefLogin: function() {
                    location.href = "../Login"
                },
                cencalmeetcard: function() {
                    this.dlcard = false
                    this.editcard = false
                },
                fetch_calendar: function() {
                    axios.post('../Database/db_Calendar.php', {
                        action: 'fetchcalendar',
                        NameRoom_ID: this.selectCalendar
                    }).then(function(response) {
                        app.events = response.data;
                        console.log(app.events);
                    });
                },
                fetch_checktime: function() {
                    axios.post('../Database/db_Calendar.php', {
                        action: 'fetchCheckcal',
                        NameRoom_ID: this.dataCld_insert.NameRoom,
                        Start_day: this.dataCld_insert.Start_day,
                        Start_time: this.dataCld_insert.Start_time,
                        End_time: this.dataCld_insert.End_time
                    }).then(function(response) {
                        app.counttime = response.data.numrock;
                        console.log(app.counttime);
                    });
                },
                fetch_checktime1: function() {
                    axios.post('../Database/db_Calendar.php', {
                        action: 'fetchCheckcal',
                        NameRoom_ID: this.dataCld_edit.NameRoom_ID,
                        Start_day: this.dataCld_edit.Start_day,
                        Start_time: this.dataCld_edit.Start_time,
                        End_time: this.dataCld_edit.End_time
                    }).then(function(response) {
                        app.counttime = response.data.numrock;
                        console.log(app.counttime);
                    });
                },
                fetch_nameroom: function() {
                    axios.post('../Database/db_Nameroom.php', {
                        action: 'fetchall',
                    }).then(function(response) {
                        app.nameroom = response.data;
                        console.log(app.nameroom)
                    });
                },
                fetchAllData: function() {
                    axios.post('../Database/db_Calendar.php', {
                        action: 'fetchall',
                        User_ID: <?php echo "'" . $_SESSION["USER_ID"] . "'" ?>
                    }).then(function(response) {
                        app.dataCld_fetchall = response.data;
                        console.log(app.dataCld_fetchall);
                    });
                },
                fetchAll_id_data: function() {
                    axios.post('../Database/db_Calendar.php', {
                        action: 'fetchalls_data',
                    }).then(function(response) {
                        app.dataCld_all_id = response.data;
                        console.log(app.dataCld_all_id);
                    });
                },
                fetch_idData: function(id) {
                    axios.post('../Database/db_Calendar.php', {
                        action: 'fetchSingle',
                        User_ID: <?php echo "'" . $_SESSION["USER_ID"] . "'" ?>,
                        MeetingRoom_ID: id
                    }).then(function(response) {
                        app.dataCld_edit.NameRoom_ID = response.data.NameRoom_ID;
                        app.dataCld_edit.Start_day = response.data.Sday;
                        app.dataCld_edit.Start_time = response.data.Stime;
                        app.dataCld_edit.End_time = response.data.Etime;
                        app.dataCld_edit.Description = response.data.Description;
                        console.log(app.dataCld_edit);
                    });
                    console.log(this.dataCld_edit)
                },
                edit_data: function(id) {
                    this.dataCld_edit.MeetingRoom_ID = id
                    app.fetch_idData(id)
                    console.log(this.dataCld_edit)
                    this.editcard = true
                },
                edit_axios: function() {
                    console.log(this.dataCld_edit)
                    if (this.dataCld_edit.NameRoom !== null) {
                        if (this.dataCld_edit.Start_day != '' && this.dataCld_edit.Start_time != '' && this.dataCld_edit.End_time != '') {
                            if (this.counttime == '0') {
                                axios.post('../Database/db_Calendar.php', {
                                    action: 'update',
                                    NameRoom_ID: app.dataCld_edit.NameRoom_ID,
                                    Start_day: app.dataCld_edit.Start_day,
                                    Start_time: app.dataCld_edit.Start_time,
                                    End_time: app.dataCld_edit.End_time,
                                    Description: app.dataCld_edit.Description,
                                    MeetingRoom_ID: app.dataCld_edit.MeetingRoom_ID
                                }).then(function(response) {
                                    app.fetchAllData();
                                    app.cencalmeetcard();
                                    app.dataCld_edit.NameRoom_ID = null;
                                    app.dataCld_edit.Start_day = '';
                                    app.dataCld_edit.Start_time = '';
                                    app.dataCld_edit.End_time = '';
                                    app.dataCld_edit.Description = '';
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
                                        title: 'แก้ไขวันห้องประชุม สำเร็จ!!'
                                    })
                                });
                                this.range.start = '';
                                this.range.end = '';
                            } else {
                                Swal.fire(
                                    'เวลาทับกัน!!',
                                    'วันที่/เวลา!!',
                                    'warning'
                                )
                                app.dataCld_edit.Start_day = '';
                                app.dataCld_edit.Start_time = '';
                                app.dataCld_edit.End_time = '';
                                app.counttime = 0;
                            }
                        } else {
                            Swal.fire(
                                'ไม่มีข้อมูล!!',
                                'วันที่/เวลา!!',
                                'warning'
                            )
                        }
                    } else {
                        Swal.fire(
                            'ไม่มีข้อมูล!!',
                            'ชื่อห้อง!!',
                            'warning'
                        )
                    }
                },
                insert_axios: function() {
                    if (this.dataCld_insert.NameRoom !== null) {
                        if (this.dataCld_insert.Start_day != '' && this.dataCld_insert.Start_time != '' && this.dataCld_insert.End_time != '') {
                            if (this.counttime == '0') {
                                console.log('data =', this.counttime)
                                this.dataCld_insert.WhoCreate = this.dataCld_insert.User_ID
                                // this.dataCld_insert.Whotime_Create = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
                                axios.post('../Database/db_Calendar.php', {
                                    action: 'insert',
                                    MeetingRoom_ID: this.dataCld_insert.MeetingRoom_ID,
                                    User_ID: this.dataCld_insert.User_ID,
                                    NameRoom_ID: this.dataCld_insert.NameRoom,
                                    Numbar_User: this.dataCld_insert.Numbar_User,
                                    Start_day: this.dataCld_insert.Start_day,
                                    Start_time: this.dataCld_insert.Start_time,
                                    End_time: this.dataCld_insert.End_time,
                                    Description: this.dataCld_insert.Description,
                                }).then(function(response) {
                                    app.cencalmeetcard();
                                    app.fetchAllData();
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
                                        title: 'จองวันห้องประชุม สำเร็จ!!'
                                    })
                                });
                                this.dataCld_insert.NameRoom = null;
                                this.dataCld_insert.Start_day = '';
                                this.dataCld_insert.Start_time = '';
                                this.dataCld_insert.End_time = '';
                                this.dataCld_insert.Description = '';
                            } else {
                                Swal.fire(
                                    'เวลาทับกัน!!',
                                    'วันที่/เวลา!!',
                                    'warning'
                                )
                                this.dataCld_insert.Start_day = ''
                                this.dataCld_insert.Start_time = ''
                                this.dataCld_insert.End_time = ''
                                this.counttime = '0'
                            }
                        } else {
                            Swal.fire(
                                'ไม่มีข้อมูล!!',
                                'วันที่/เวลา!!',
                                'warning'
                            )
                        }
                    } else {
                        Swal.fire(
                            'ไม่มีข้อมูล!!',
                            'ชื่อห้อง!!',
                            'warning'
                        )
                    }
                },
                delete_data: function(id) {
                    Swal.fire({
                        title: 'ต้องการลบ?',
                        text: "คุณจะไม่สามารถเปลี่ยนกลับได้!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'ยกเลิก',
                        confirmButtonText: 'ตกลง!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            axios.post('../Database/db_Calendar.php', {
                                action: 'delete',
                                MeetingRoom_ID: id
                            }).then(function(response) {
                                app.fetchAllData();
                            });
                            Swal.fire(
                                'ลบสำเร็จ!',
                                'คุณได้ลบวันนัดประชุมแล้ว!!',
                                'success'
                            )
                        }
                    })
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
                }
            }
        })
    </script>
</body>

</html>