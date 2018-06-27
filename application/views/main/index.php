
<div id="app">








    <!-- Modal -->

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-6  ">

                            <img class="imgg" src="" style="width:320px; height: 240px;" v-if="!show&&user_status!='admin'">
                            <img  v-bind:src="name_img"  style="width:320px; height: 240px;" v-else="">
                            <input  accept="image/*" id="sortpicture" type="file" data-toggle="modal" data-target="#myimg" v-show="!show&&user_status!='admin'"  class="btn btn-primary btn-block btn-flat">

                            <button class="go" v-show="!show&&user_status!='admin'"  class="btn btn-primary btn-block btn-flat">Upload</button>

                        </div>
                        <div class="col-6 ">
                            <div class="row">
                                <div class="col-6 "><p>Назва</p></div>
                                <div class="col-6 "><input type="text" :disabled="show" v-model="name" class="form-control"></div>
                            </div>
                            <div class="row">
                                <div class="col-6 "><p>email виконавця</p></div>
                                <div class="col-6 "><input type="text"  value="admin@gmail.com"  class="form-control" disabled> </div>
                            </div>
                            <div class="row">
                                <div class="col-6 "><p>email замовника</p></div>
                                <div class="col-6 "><input type="text" :disabled="show" v-model="email_creator" class="form-control"></div>
                            </div>
                            <div class="row">
                                <div class="col-6 "><p>статус</p></div>
                                <div class="col-6 " v-if="user_status!='admin'"><p v-if="status=='true'">виконано</p><p v-else="">не виконано</p></div>
                                <div class="col-6 " v-else=""><input type="checkbox" v-model="status" v-on:change="statuss"></div>

                            </div>

                        </div>
                    </div>


                    <div class="row">
                        <div class="col-4 offset-4 "><p>опис завдання</p></div>
                    </div>
                    <div class="row">
                        <div class="col-10 offset-1 "><textarea class="form-control" rows="10" v-model="description" :disabled="show">{{description}}</textarea></div>
                    </div>
                    <br>
                    <div class="row" v-show="!show">
                        <button v-on:click="save"  class="btn btn-primary btn-block btn-flat close"  data-dismiss="modal" aria-label="Close">зберегти</button>
                    </div>
                </div>

            </div>
        </div>
    </div>



<div class="row">
    <div class="col-2 "><button v-on:click="set_new" class="btn btn-primary btn-block btn-flat" style="background-color: #6bd17d;border-color: #6bd17d "  data-toggle="modal" data-target=".bd-example-modal-lg">дотати завдання</button></div>

    <div class="col-1 offset-7"><button  v-on:click="run('/account/login')" class="btn btn-primary btn-block btn-flat " style="background-color: #d14d57;border-color: #d14d57 ">Вхід</button></div>
    <div class="col-2 "><button v-on:click="run('/account/register')" class="btn btn-primary btn-block btn-flat" style="background-color: #6bd17d;border-color: #6bd17d ">Регістрація</button></div>

</div>
    <br>
    <div class="col-4 offset-4" ><h1 style="text-align: center">Тестове завдання</h1></div>

    <br> <br>
<div class="row">
  <div class="col-10 offset-1" style="background-color: #3c8dbc;border:">
    <div class="row">
        <div class="col-2 offset-1"><p  @click="sortParam='name'">Назва</p></div>
        <div class="col-2 "><p  @click="sortParam='email'">email виконавця</p></div>
        <div class="col-2 "><p  @click="sortParam='email_creator'">email замовника</p></div>
        <div class="col-2 "><p  @click="sortParam='description'">опис завдання</p></div>
        <div class="col-2 "><p  @click="sortParam='status'">статус</p></div>
    </div>
      <div class="row hawer" v-for="(row,index) in sortedList.slice(max_record-3, max_record)" @click="test(row)" data-toggle="modal" data-target=".bd-example-modal-lg">
<!---->


          <div class="col-2 offset-1"><p>{{row.name}}</p></div>

          <div class="col-2 "><p>{{row.email}}</p></div>
          <div class="col-2 "><p>{{row.email_creator}}</p></div>
          <div class="col-2 "><p class="size">{{row.description}}</p></div>
          <div class="col-2 " ><p v-if="row.status=='true'">виконано</p><p v-else="">не виконано</p></div>

      </div>
  </div>
</div>
<br><br>
    <div class="row">
        <div class="col-6 offset-4">
            <button type="button" class="btn btn-primary btn-circle "  style="margin-right: 30px;" v-for="(row,index) in pages" @click="run_next_page(index+1)">{{row}}</button>

        </div>
    </div>
</div>

<script>

//    Vue.http.options.emulateJSON = true;

    var appout = new Vue({
        el: '#app',
        data: {
              user_name:'<?php echo $_SESSION['user_name']; ?>',
              user_id:'<?php echo $_SESSION['user_id']; ?>',
              user_status:'<?php echo $_SESSION['user_status']; ?>',
              user_email:'<?php echo $_SESSION['user_email']; ?>',
            sortParam: '',
            record:<?php echo $record ?>,
            name:'',
            email:'',
            email_creator:'',
            description:'',
            name_img:'',
            status:'',
            i:0,
            id:0,
            max_record:<?php echo $_SESSION['max_record'] ?>,
            count_page:<?php echo $count_page ?>,
            count_records:<?php echo $count_records ?>,
            pages:[],



            show:false,
        },

        methods: {
            statuss:function () {
                if(this.status){

                    axios.post(`/good_tasks`, {
                        name:this.name,email_creator:this.email_creator
                    }).then(response => {

                        window.location.href = '/';

                });

                }

            },
            save:function () {
                axios.post(`/save_tasks`, {
                    name:this.name,email_creator:this.email_creator,name_img:'<?php echo $_SESSION['name_img']?>',email:'admin@gmail.com', description:this.description
                }).then(response => {

                    window.location.href = '/';

            });
            },

            run:function (a) {
                window.location.href = a;

//                axios.post(`/login`, {
//                    name: 'a',
//
//                });
            },
            test:function (row) {
                     this.id=row.id;
                    this.name=row.name;
                    this.email=row.email;
                    this.email_creator=row.email_creator;
                    this.description=row.description;
                this.status=row.status;

                    this.name_img='public/img/'+row.name_img;
                this.status=row.status;
            this.show=true;
            if(this.user_status=='admin'){
                this.show=false;
            }

            },
            set_new:function () {
                this.name='';

                this.email_creator='';
                this.description='';

                this.show=false;
            },
            run_next_page:function (page) {

                axios.post(`next_page`, {
                    page:page
                }).then(response => {
                    alert(response.data);
                    if(response.data == 'go'){

                    window.location.href = '/';
                }

            });

            }


        },
        computed:{
            sortedList () {

                switch(this.sortParam){
                    case 'name': return this.record.sort(sortByName);
                    case 'email': return this.record.sort(sortByEmail);
                    case 'status': return this.record.sort(sortByStatus);
                    case 'email_creator': return this.record.sort(sortByEmail_creator);
                    case 'description': return this.record.sort(sortByDescription);
                    default: return this.record;
                }
            }
        },
        created: function () {
            for(this.i=1;this.i<=this.count_page;this.i++){
                this.pages.push(this.i);
            }

        }





    });
var sortByName = function(d1, d2){return d1.name.toLowerCase() > d2.name.toLowerCase()};
var sortByEmail = function(d1, d2){return d1.email.toLowerCase() > d2.email.toLowerCase()};
var sortByStatus = function(d1, d2){return d1.status.toLowerCase() > d2.status.toLowerCase()};
var sortByEmail_creator = function(d1, d2){return d1.email_creator.toLowerCase() > d2.email_creator.toLowerCase()};
var sortByDescription = function(d1, d2){return d1.description.toLowerCase() > d2.description.toLowerCase()};


</script>
<script>
    $('.go').on('click', function () {



        var file_data =  $('#sortpicture').prop('files')[0];

        var form_data = new FormData();
        form_data.append('file', file_data);

        form_data.append('status', 'red');

        $.ajax({
            url: '/download',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (php_script_response) {

                $(".imgg").attr("src",php_script_response);
            }

        });
    });


</script>