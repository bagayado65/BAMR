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
                                                            <v-text-field v-model="dataCld_insert.NameRoom" label="ชื่อห้องประชุม"></v-text-field>
                                                            <v-spacer></v-spacer>
                                                            <div>
                                                                <input v-model="range.start" type="datetime-local" id="meeting-time" name="meeting-time" /> <span class="ml-2 mr-5"> ถึงวันที่ </span> <input v-model="range.end" type="datetime-local" id="meeting-time" name="meeting-time" />
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
                                <template>
                                    <v-simple-table id="myTable" fixed-header height="600px">
                                        <template v-slot:default>
                                            <thead>
                                                <tr>
                                                    <th class="text-left">
                                                        ชื่อห้อง
                                                    </th>
                                                    <th class="text-left">
                                                        วันเริ่ม
                                                    </th>
                                                    <th class="text-left">
                                                        วันจบ
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
                                                    <td>{{ item.Start_day }} เวลา {{ item.Start_time }}</td>
                                                    <td>{{ item.End_day }} เวลา {{ item.End_time }}</td>
                                                    <td>{{ item.Description }}</td>
                                                    <td>
                                                        <v-btn @click="edit_data(item.MeetingRoom_ID)" color="orange" icon>
                                                            <v-icon class="mt-2">mdi-border-color</v-icon>
                                                        </v-btn>
                                                        <v-btn color="red" icon>
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
                                                        <v-text-field v-model="dataCld_edit.NameRoom" label="ชื่อห้องประชุม"></v-text-field>
                                                        <v-spacer></v-spacer>
                                                        <div>
                                                            <input v-model="range.start" type="datetime-local" id="meeting-time" name="meeting-time" /> <span class="ml-2 mr-5"> ถึงวันที่ </span> <input v-model="range.end" type="datetime-local" id="meeting-time" name="meeting-time" />
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
        function SearchFuntion() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
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
            data: {
                dataCld_insert: {
                    MeetingRoom_ID: null,
                    User_ID: <?php echo "'" . $_SESSION["USER_ID"] . "'" ?>,
                    NameRoom: '',
                    Numbar_User: '',
                    Start_day: '',
                    Start_time: '',
                    End_day: '',
                    End_time: '',
                    Description: '',
                    WhoCreate: '',
                    WhoEdit: '',
                    Whotime_Create: '',
                    Whotime_Edit: '',
                },
                dataShow_fectsingle: {
                    NameRoom: '',
                    Start_day: '',
                    Start_time: '',
                    End_day: '',
                    End_time: '',
                    Description: '',
                },
                dataCld_edit: {
                    NameRoom: '',
                    Start_day: '',
                    Start_time: '',
                    End_day: '',
                    End_time: '',
                    Description: '',
                    MeetingRoom_ID: '',
                    User_ID: <?php echo "'" . $_SESSION["USER_ID"] . "'" ?>
                },
                dataCld_fetchall: '',
                sw_msg: false,
                sw_msg1: false,
                drawer: false,
                dlcard: false,
                editcard: false,
                range: {
                    start: '',
                    end: ''
                },
                numberelo: null,
            },
            computed: {},
            watch: {},
            created() {
                this.fetchAllData()
            },
            methods: {
                test_date: function() {
                    console.log(this.dataCld_insert.User_ID)
                },
                drawA: function() {
                    this.drawer = !this.drawer
                },
                localhrefLogin: function() {
                    location.href = "../Login"
                },
                cencalmeetcard: function() {
                    this.dlcard = false
                    this.editcard = false
                },
                fetchAllData: function() {
                    axios.post('../Database/db_Calendar.php', {
                        action: 'fetchall'
                    }).then(function(response) {
                        app.dataCld_fetchall = response.data;
                        console.log(app.dataCld_fetchall);
                    });
                },
                fetch_idData: function() {
                    axios.post('../Database/db_Calendar.php', {
                        action: 'fetchSingle',
                        User_ID: <?php echo "'" . $_SESSION["USER_ID"] . "'" ?>,
                        MeetingRoom_ID: this.dataCld_edit.MeetingRoom_ID
                    }).then(function(response) {
                        app.dataShow_fectsingle.NameRoom = response.data.NameRoom;
                        app.dataShow_fectsingle.Start_day = response.data.Start_day;
                        app.dataShow_fectsingle.Start_time = response.data.Start_time;
                        app.dataShow_fectsingle.End_day = response.data.End_day;
                        app.dataShow_fectsingle.End_time = response.data.End_time;
                        app.dataShow_fectsingle.Description = response.data.Description;
                        console.log(app.dataShow_fectsingle);
                    });
                },
                edit_data: function(id) {
                    this.dataCld_edit.MeetingRoom_ID = id
                    app.fetch_idData()
                    this.dataCld_edit.NameRoom = this.dataShow_fectsingle.NameRoom
                    this.dataCld_edit.Start_day = this.dataShow_fectsingle.Start_day
                    this.dataCld_edit.Start_time = this.dataShow_fectsingle.Start_time
                    this.dataCld_edit.End_day = this.dataShow_fectsingle.End_day
                    this.dataCld_edit.End_time = this.dataShow_fectsingle.End_time
                    this.dataCld_edit.Description = this.dataShow_fectsingle.Description
                    console.log(this.dataCld_edit)
                    // this.editcard = true
                },
                edit_axios: function() {
                    axios.post('../Database/db_Calendar.php', {
                        action: 'update',
                        NameRoom: this.dataCld_edit.NameRoom,
                        Start_day: this.dataCld_edit.Start_day,
                        Start_time: this.dataCld_edit.Start_time,
                        End_day: this.dataCld_edit.End_day,
                        End_time: this.dataCld_edit.End_time,
                        Description: this.dataCld_edit.Description,
                        MeetingRoom_ID: id,
                        User_ID: this.dataCld_edit.User_ID
                    }).then(function(response) {
                        // application.fetchAllData();
                        // application.first_name = '';
                        // application.last_name = '';
                        // application.hiddenId = '';
                        // alert(response.data.message);
                    });
                },
                insert_axios: function() {
                    if (this.dataCld_insert.NameRoom !== '') {
                        if (this.range.start != '' && this.range.end != '') {
                            this.range.start = this.range.start.split("T")
                            this.range.end = this.range.end.split("T")
                            this.dataCld_insert.Start_day = this.range.start[0]
                            this.dataCld_insert.Start_time = this.range.start[1]
                            this.dataCld_insert.End_day = this.range.end[0]
                            this.dataCld_insert.End_time = this.range.end[1]
                            this.dataCld_insert.WhoCreate = this.dataCld_insert.User_ID
                            this.dataCld_insert.Whotime_Create = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();

                            axios.post('../Database/db_Calendar.php', {
                                action: 'insert',
                                MeetingRoom_ID: this.dataCld_insert.MeetingRoom_ID,
                                User_ID: this.dataCld_insert.User_ID,
                                NameRoom: this.dataCld_insert.NameRoom,
                                Numbar_User: this.dataCld_insert.Numbar_User,
                                Start_day: this.dataCld_insert.Start_day,
                                Start_time: this.dataCld_insert.Start_time,
                                End_day: this.dataCld_insert.End_day,
                                End_time: this.dataCld_insert.End_time,
                                Description: this.dataCld_insert.Description,
                                WhoCreate: this.dataCld_insert.WhoCreate,
                                WhoEdit: this.dataCld_insert.WhoEdit,
                                Whotime_Create: this.dataCld_insert.Whotime_Create,
                                Whotime_Edit: this.dataCld_insert.Whotime_Edit,

                            }).then(function(response) {
                                app.fetch_idData();
                                app.cencalmeetcard();
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
                            this.range.start = '';
                            this.range.end = '';
                            this.dataCld_insert.NameRoom = '';
                            this.dataCld_insert.Start_day = '';
                            this.dataCld_insert.Start_time = '';
                            this.dataCld_insert.End_day = '';
                            this.dataCld_insert.End_time = '';
                            this.dataCld_insert.Description = '';
                            this.fetchAllData()
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
            }
        })
    </script>
</body>

</html>