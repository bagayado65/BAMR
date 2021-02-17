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
    <title>Developer</title>
</head>

<body>
    <?php
    session_start();
    ?>
    <div id="app">
        <v-app>
            <v-app-bar class="primary" absolute flat app>
                <v-app-bar-title>
                    <h2 style="color: white;">
                        Meeting Room
                    </h2>
                </v-app-bar-title>
                <v-tabs centered class="ml-n9" color="grey darken-1">
                    <v-tab class="white--text" v-for="link in links" :key="link" @click="CheckTab_s(link)">
                        {{ link }}
                    </v-tab>
                </v-tabs>
                <v-btn class="light-blue accent-4 mr-2" @click="local_account()" @mouseover="sw_msg = true" @mouseleave="sw_msg = false" depressed>
                    <v-icon color="white">
                        mdi-account-card-details
                    </v-icon>
                    <span style="color:white;" v-if="sw_msg"> account</span>
                </v-btn>
                <v-btn class="success" @click="local_logout()" @mouseover="sw_msg1 = true" @mouseleave="sw_msg1 = false" depressed>
                    <v-icon>
                        mdi-logout-variant
                    </v-icon>
                    <span v-if="sw_msg1">Logout</span>
                </v-btn>
            </v-app-bar>
            <v-main>
                <v-container v-if="OpenShowmain.insert_myroom == true">
                    <v-row>
                        <v-col>
                            <v-card>

                                <v-expansion-panels>
                                    <v-expansion-panel>
                                        <v-expansion-panel-header>
                                            <v-card-title>
                                                <v-text>
                                                    เพิ่มห้องประชุม
                                                </v-text>
                                            </v-card-title>
                                        </v-expansion-panel-header>
                                        <v-expansion-panel-content>

                                            <v-col>
                                                <v-text-field class="mr-2 ml-2" v-model="nameroom_insert.NameRoom"></v-text-field>
                                            </v-col>
                                            <v-col class="text-right">
                                                <v-btn @click="insert_axios_name()" color="success">ยืนยัน</v-btn>
                                            </v-col>
                                        </v-expansion-panel-content>
                                    </v-expansion-panel>
                                </v-expansion-panels>
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
                                                        <th class="text-center">
                                                            Id_Room
                                                        </th>
                                                        <th class="text-center">
                                                            Name Room
                                                        </th>
                                                        <th class="text-center">
                                                            actions
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="item in nameroom" :key="item.NameRoom_ID">
                                                        <td class="text-center">{{ item.NameRoom_ID }}</td>
                                                        <td class="text-center">{{ item.NameRoom }}</td>
                                                        <td class="text-center">
                                                            <v-btn @click="edit_data_name(item.NameRoom_ID)" color="orange" icon>
                                                                <v-icon class="mt-2">mdi-border-color</v-icon>
                                                            </v-btn>
                                                            <v-btn @click="delete_data_name(item.NameRoom_ID)" color="red" icon>
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
                            <v-dialog v-model="editcard_name" persistent max-width="500" max-height="600">
                                <v-card min-height="300">
                                    <v-card-title>
                                        แก้ไขชื่อห้องประชุม
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
                                                    <v-col class="mt-4">
                                                        <v-text-field v-model="nameroom_edit.NameRoom_ID" disabled></v-text-field>
                                                        <v-spacer></v-spacer>
                                                        <div>
                                                            <v-text-field v-model="nameroom_edit.NameRoom"></v-text-field>
                                                        </div>
                                                    </v-col>
                                                </v-row>
                                                <v-divider></v-divider>
                                                <v-row>
                                                    <v-col sm="9">
                                                    </v-col>
                                                    <v-col sm="2">
                                                        <v-btn @click="edit_axios_name()" class="ml-5 mt-4" color="success">
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
                <v-container v-if="OpenShowmain.edit_user == true">
                    <v-row>
                        <v-col>
                            <v-card>
                                <v-card-title>
                                    <v-text>
                                        แก้ไขผู้ใช้งาน
                                    </v-text>
                                </v-card-title>
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
                                                        <th class="text-center">
                                                            ชื่อ - นามสกุล
                                                        </th>
                                                        <th class="text-center">
                                                            ชื่อในระบบ
                                                        </th>
                                                        <th class="text-center">
                                                            อีเมล
                                                        </th>
                                                        <th class="text-center">
                                                            ชื่อโทรศัพท์/มือถือ
                                                        </th>
                                                        <th class="text-center">
                                                            ใช้งาน/ไม่ใช้งาน
                                                        </th>
                                                        <th class="text-center">
                                                            ตำแหน่งของระบบ
                                                        </th>
                                                        <th class="text-center">
                                                            actions
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="item in user_selected_tu" :key="item.User_id">
                                                        <td class="text-center">{{ item.Name }}</td>
                                                        <td class="text-center">{{ item.Username }}</td>
                                                        <td class="text-center">{{ item.Email }}</td>
                                                        <td class="text-center">{{ item.Phone }}</td>
                                                        <td class="text-center green--text" v-if="item.Status == 1">ใช้งาน</td>
                                                        <td class="text-center red--text" v-else-if="item.Status == 0">ไม่ใช้งาน</td>
                                                        <td class="text-center" v-if="item.Position == 0">SupperAdmin</td>
                                                        <td class="text-center" v-else-if="item.Position == 1">Admin</td>
                                                        <td class="text-center" v-else-if="item.Position == 2">personnel</td>
                                                        <td class="text-center">
                                                            <v-btn @click="edit_data_usersa(item.User_id)" color="orange" icon>
                                                                <v-icon class="mt-2">mdi-border-color</v-icon>
                                                            </v-btn>
                                                            <v-btn @click="delete_data_usersa(item.User_id)" color="red" icon>
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
                            <v-dialog v-model="editcard_usersa" persistent max-width="500" max-height="600">
                                <v-card min-height="300">
                                    <v-card-title>
                                        แก้ไขชื่อผู้ใช้งาน
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
                                                    <v-col class="mt-4">
                                                        <v-text-field v-model="user_edit.Name" label="ชื่อจริงผู้ใช้งาน"></v-text-field>
                                                        <v-text-field v-model="user_edit.Username" label="ชื่อผู้ใช้งานในระบบ"></v-text-field>
                                                        <v-text-field v-model="user_edit.Email" label="อีเมล"></v-text-field>
                                                        <v-text-field v-model="user_edit.Phone" label="เบอร์โทรศัพท์/มือถือ"></v-text-field>
                                                        <!-- <v-text-field v-model="user_edit.Status"></v-text-field> -->
                                                        <v-select v-model="ucs.ca" :items="select_users_edit.user" label="สถาณะผู้ใช้งาน" dense></v-select>
                                                        <v-select v-model="ucs.cs" :items="select_users_edit.position" label="ตำแหน่ง" dense></v-select>
                                                    </v-col>
                                                </v-row>
                                                <v-divider></v-divider>
                                                <v-row>
                                                    <v-col sm="9">
                                                    </v-col>
                                                    <v-col sm="2">
                                                        <v-btn @click="edit_data_user()" class="ml-5 mt-4" color="success">
                                                            ยืนยัน
                                                        </v-btn>
                                                    </v-col>
                                                </v-row>
                                                <v-row>
                                                    <v-col>
                                                        <v-text>
                                                            ใช้งาน = 0 , ไม่ใช้งาน = 1
                                                        </v-text>
                                                    </v-col>
                                                </v-row>
                                                <v-row>
                                                    <v-col>
                                                        <v-text>
                                                            SupperAdmin = 0 , Adimin = 1 , personnel = 2
                                                        </v-text>
                                                    </v-col>
                                                </v-row>
                                            </v-container>
                                        </v-card-text>
                                    </v-card-action>
                                </v-card>
                            </v-dialog>
                            <v-dialog v-model="editcard_name" persistent max-width="500" max-height="600">
                                <v-card min-height="300">
                                    <v-card-title>
                                        แก้ไขชื่อห้องประชุม
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
                                                    <v-col class="mt-4">
                                                        <v-text-field v-model="nameroom_edit.NameRoom_ID" disabled></v-text-field>
                                                        <v-spacer></v-spacer>
                                                        <div>
                                                            <v-text-field v-model="nameroom_edit.NameRoom"></v-text-field>
                                                        </div>
                                                    </v-col>
                                                </v-row>
                                                <v-divider></v-divider>
                                                <v-row>
                                                    <v-col sm="9">
                                                    </v-col>
                                                    <v-col sm="2">
                                                        <v-btn @click="edit_axios_name()" class="ml-5 mt-4" color="success">
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
                <v-container v-if="OpenShowmain.edit_date_room == true">
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
                                                                <input @change="fetch_checktime()" v-model="dataCld_insert.Start_time" type="time" id="meeting-time" name="meeting-time" /> <span class="ml-2 mr-5"> ถึงเวลา </span> <input @change="fetch_checktime()" v-model="dataCld_insert.End_time" type="time" id="meeting-time" name="meeting-time" />
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
                            <v-card max-height="800">
                                <!-- ,fetchAll_id_data() -->
                                <v-btn @click="show_calendar = !show_calendar,classmts()" width="100%">
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
                                                    <v-col>
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
                            </v-card>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col>
                            <div>
                                <v-card :class="classmt">
                                    <template>
                                        <v-simple-table id="myTable" fixed-header height="550px">
                                            <template v-slot:default>
                                                <thead>
                                                    <tr>
                                                        <th class="text-left">
                                                            ชื่อห้อง
                                                        </th>
                                                        <th class="text-left">
                                                            ชื่อผู้ใช้งาน</th>
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
                                                        <td>{{ item.Name }}</td>
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
                                                            <input @change="fetch_checktime1()" v-model="dataCld_edit.Start_time" type="time" id="meeting-time" name="meeting-time" /> <span class="ml-2 mr-5"> ถึงเวลา </span> <input @change="fetch_checktime1()" v-model="dataCld_edit.End_time" type="time" id="meeting-time" name="meeting-time" />
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
        var today = new Date();

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
                links: [
                    'เพิ่มห้องประชุม',
                    'แก้ไขรายชื่อผู้ใช้งาน',
                    'แก้ไขวันนัดห้องประชุมทั้งหมด'
                ],
                OpenShowmain: {
                    insert_myroom: true,
                    edit_user: false,
                    edit_date_room: false
                },
                nameroom: '',
                nameroom_edit: {
                    NameRoom_ID: null,
                    NameRoom: ''
                },
                nameroom_insert: {
                    NameRoom: ''
                },
                dataCld_edit: {
                    NameRoom_ID: null,
                    Start_day: '',
                    Start_time: '',
                    End_time: '',
                    Description: '',
                    MeetingRoom_ID: '',
                    User_ID: <?php echo "'" . $_SESSION["USER_ID"] . "'" ?>
                },
                user_selected_tu: '',
                user_edit: {
                    User_id: null,
                    Name: '',
                    Username: '',
                    Passwords: '',
                    Email: '',
                    Phone: '',
                    Status: '',
                    Position: '',
                    WhoCreate: '',
                    WhoEdit: '',
                    Whotime_Create: '',
                    Whotime_Edit: ''
                },
                ucs: {
                    ca: '',
                    cs: '',
                },
                select_users_edit: {
                    user: ['ใช้งาน', 'ไม่ใช้งาน'],
                    position: ['SupperAdmin', 'Adimin', 'personnel']
                },
                dataCld_fetchall: '',
                dataCld_all_id: '',
                editcard_name: false,
                sw_msg: false,
                sw_msg1: false,
                // drawer: false,
                dayeatone: formatDate(today),
                dlcard: false,
                editcard: false,
                selectCalendar: '',
                editcard_usersa: false,
                show_calendar: false,
                counttime: '0',
                todays: new Date(),
                type: 'month',
                typeToLabel: {
                    month: 'Month',
                    week: 'Week',
                    day: 'Day',
                    '4day': '4 Days',
                },
                classmt: 'mt-0',
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
                this.fetchAllData_onlyuser()
                this.fetch_nameroom()
                this.fetchAll_id_data()
                this.fetchAllData()
            },
            methods: {
                test_date: function() {
                    console.log(this.dataCld_insert.User_ID)
                },
                viewDay({
                    date
                }) {
                    // this.focus = date
                    this.type = 'day'
                },
                CheckTab_s: function(link) {
                    // alert(link)
                    if (this.links.indexOf(link) == 0) {
                        this.OpenShowmain.insert_myroom = true
                        this.OpenShowmain.edit_user = false
                        this.OpenShowmain.edit_date_room = false
                    } else if (this.links.indexOf(link) == 1) {
                        this.OpenShowmain.edit_user = true
                        this.OpenShowmain.edit_date_room = false
                        this.OpenShowmain.insert_myroom = false
                    } else if (this.links.indexOf(link) == 2) {
                        this.OpenShowmain.edit_date_room = true
                        this.OpenShowmain.edit_user = false
                        this.OpenShowmain.insert_myroom = false
                    }
                },
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
                    this.editcard_name = false
                    this.editcard_usersa = false
                },
                fetch_calendar: function() {
                    axios.post('../Database/db_SuCalendar.php', {
                        action: 'fetchcalendar',
                        NameRoom_ID: this.selectCalendar
                    }).then(function(response) {
                        app.events = response.data;
                        console.log(app.events);
                    });
                },
                fetch_checktime: function() {
                    axios.post('../Database/db_SuCalendar.php', {
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
                    axios.post('../Database/db_SuCalendar.php', {
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
                    axios.post('../Database/db_SuCalendar.php', {
                        action: 'fetchall',
                    }).then(function(response) {
                        app.dataCld_fetchall = response.data;
                        console.log(app.dataCld_fetchall);
                    });
                },
                fetchAll_id_data: function() {
                    axios.post('../Database/db_SuCalendar.php', {
                        action: 'fetchalls_data',
                    }).then(function(response) {
                        app.dataCld_all_id = response.data;
                        console.log(app.dataCld_all_id);
                    });
                },
                fetch_idData: function(id) {
                    axios.post('../Database/db_SuCalendar.php', {
                        action: 'fetchSingle',
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
                fetchAllData_onlyuser: function() {
                    axios.post('../Database/db_user.php', {
                        action: 'fetchallonly',
                    }).then(function(response) {
                        app.user_selected_tu = response.data;
                    });
                },
                edit_data: function(id) {
                    this.dataCld_edit.MeetingRoom_ID = id
                    app.fetch_idData(id)
                    console.log(this.dataCld_edit)
                    this.editcard = true
                },
                fetch_idData_names: function(id) {
                    axios.post('../Database/db_Nameroom.php', {
                        action: 'fetchSingle',
                        NameRoom_ID: id
                    }).then(function(response) {
                        app.nameroom_edit.NameRoom_ID = response.data.NameRoom_ID;
                        app.nameroom_edit.NameRoom = response.data.NameRoom;
                        console.log(app.nameroom_edit);
                    });
                    console.log(this.nameroom_edit)
                },
                edit_data_name: function(id) {
                    this.nameroom_edit.NameRoom_ID = id
                    app.fetch_idData_names(id)
                    console.log(this.nameroom_edit)
                    this.editcard_name = true
                },
                fetch_idData_usersa: function(id) {
                    axios.post('../Database/db_user.php', {
                        action: 'fetchSingle',
                        User_id: id
                    }).then(function(response) {
                        app.user_edit.User_id = response.data.User_id;
                        app.user_edit.Name = response.data.Name;
                        app.user_edit.Username = response.data.Username;
                        app.user_edit.Email = response.data.Email;
                        app.user_edit.Phone = response.data.Phone;
                        app.user_edit.Status = response.data.Status;
                        app.user_edit.Position = response.data.Position;
                    });
                },
                edit_data_usersa: function(id) {
                    this.user_edit.User_id = id
                    app.fetch_idData_usersa(id)
                    console.log(this.user_edit)
                    this.editcard_usersa = true
                },
                edit_data_user: function() {
                    if (this.ucs.ca == 'ใช้งาน') {
                        this.user_edit.Status = 1
                    } else if (this.ucs.ca == 'ไม่ใช้งาน') {
                        this.user_edit.Status = 0
                    }
                    if (this.ucs.cs == 'SupperAdmin') {
                        this.user_edit.Position = 0
                    } else if (this.ucs.cs == 'Adimin') {
                        this.user_edit.Position = 1
                    } else if (this.ucs.cs == 'personnel') {
                        this.user_edit.Position = 2
                    }
                    axios.post('../Database/db_user.php', {
                        action: 'updateds',
                        User_id: app.user_edit.User_id,
                        Name: app.user_edit.Name,
                        Username: app.user_edit.Username,
                        Email: app.user_edit.Email,
                        Phone: app.user_edit.Phone,
                        Status: app.user_edit.Status,
                        Position: app.user_edit.Position
                    }).then(function(response) {
                        app.fetchAllData_onlyuser();
                        app.fetchAllData();
                        app.fetch_nameroom();
                        app.cencalmeetcard();
                        app.user_edit.Name = '';
                        app.user_edit.Username = '';
                        app.user_edit.Email = '';
                        app.user_edit.Phone = '';
                        app.user_edit.Status = '';
                        app.user_edit.Position = '';
                        app.user_edit.User_id = '';
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
                            title: 'แก้ไขข้อมูลผู้ใช้งาน สำเร็จ!!'
                        })
                    });
                },
                edit_axios_name: function() {
                    if (this.nameroom_edit.NameRoom != '') {
                        axios.post('../Database/db_Nameroom.php', {
                            action: 'update',
                            NameRoom_ID: app.nameroom_edit.NameRoom_ID,
                            NameRoom: app.nameroom_edit.NameRoom
                        }).then(function(response) {
                            app.fetchAllData();
                            app.fetch_nameroom();
                            app.cencalmeetcard();
                            app.nameroom_edit.NameRoom_ID = null;
                            app.nameroom_edit.NameRoom = '';
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
                                title: 'แก้ไขห้องประชุม สำเร็จ!!'
                            })
                        });
                    } else {
                        Swal.fire(
                            'ไม่มีข้อมูล!!',
                            'ชื่อห้อง!!',
                            'warning'
                        )
                    }
                },
                edit_axios: function() {
                    console.log(app.dataCld_edit.NameRoom_ID)
                    if (this.dataCld_edit.NameRoom !== null) {
                        if (this.dataCld_edit.Start_day != '' && this.dataCld_edit.Start_time != '' && this.dataCld_edit.End_time != '') {
                            if (this.counttime == '0') {
                                axios.post('../Database/db_SuCalendar.php', {
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
                insert_axios_name: function() {
                    if (this.nameroom_insert.NameRoom != '') {
                        axios.post('../Database/db_Nameroom.php', {
                            action: 'insert',
                            NameRoom: this.nameroom_insert.NameRoom
                        }).then(function(response) {
                            app.fetch_nameroom();
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
                                title: 'สร้างห้องประชุม สำเร็จ!!'
                            })
                        });
                        this.nameroom_insert.NameRoom = ''
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
                                axios.post('../Database/db_SuCalendar.php', {
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
                            axios.post('../Database/db_SuCalendar.php', {
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
                delete_data_name: function(id) {
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
                            axios.post('../Database/db_Nameroom.php', {
                                action: 'delete',
                                NameRoom_ID: id
                            }).then(function(response) {
                                app.fetchAllData();
                                app.fetch_nameroom();
                            });
                            Swal.fire(
                                'ลบสำเร็จ!',
                                'คุณได้ลบห้องประชุมแล้ว!!',
                                'success'
                            )
                        }
                    })
                },
                delete_data_usersa: function(id) {
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
                            axios.post('../Database/db_user.php', {
                                action: 'delete',
                                User_id: id
                            }).then(function(response) {
                                app.fetchAllData_onlyuser();
                                app.fetchAllData();
                                app.fetch_nameroom();
                            });
                            Swal.fire(
                                'ลบสำเร็จ!',
                                'คุณได้ลบผู้ใช้งานแล้ว!!',
                                'success'
                            )
                        }
                    })
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
                classmts: function() {
                    if (this.show_calendar == true) {
                        this.classmt = 'mt-16'
                    } else {
                        this.classmt = 'mt-0'
                    }
                },
            }
        })
    </script>
</body>

</html>