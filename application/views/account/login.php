
<div id="app">
    <div class="row">
        <div class="col-2  offset-9 "><button v-on:click="run('/')" class="btn btn-primary btn-block btn-flat" style="background-color: #6bd17d;border-color: #6bd17d "  >продовжити як гість</button></div>

        <div class="col-1 "><button  v-on:click="run('/account/register')" class="btn btn-primary btn-block btn-flat " style="background-color: #d14d57;border-color: #d14d57 ">Регістрація</button></div>

    </div>
    <div class="col-4 offset-4" ><h1 style="text-align: center">Вход</h1></div>

    <div class="col-4 offset-4" style="background-color:#8b4260;border-radius:10px "><div class="login-box">


            <div >

                <br><br>
<p v-show="showw">логин или пароль не правельний</p>
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="login" v-model="login">

                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" v-model="password">

                </div>
                <div class="row">

                    <div class="col-4 offset-4">
                        <button  class="btn btn-primary btn-block btn-flat" v-on:click="test">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>

                <br>


            </div>
            <!-- /.login-card-body -->

        </div></div>


</div>
<script>

//        Vue.http.options.emulateJSON = true;
    var appout = new Vue({
        el: '#app',
        data: {

            password:'',
            login:'',
            showw:false,
        },

        methods: {
           run:function (a) {
                        window.location.href = a;


                    },
            test:function () {

                axios.post(`/login`, {
                    login: this.login,password:this.password

                }).then(response => {

                                      if(response.data == 'run'){
                                      window.location.href = '/';
                                  }else{
                                      this.showw = true;
                                  }

                              });
            }

        },
        computed:{

        }





    });
</script>