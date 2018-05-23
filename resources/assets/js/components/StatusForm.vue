<template>
  <li class="dropdown messages-menu" style="visibility: none;">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
      <i class="fa fa-envelope-o"></i>
      <span class="label label-success">{{statuses.length}}</span>
    </a>
    <ul class="dropdown-menu">
      <li class="header">You have {{statuses.length}} notifications</li>
      <li>
        <!-- inner menu: contains the messages -->
        <ul class="menu">

          <!--aqui empieza el desmadre-->
          <li><!-- start message -->
            <a v-for="status in statuses">
              <div class="pull-left">
                <!-- User Image -->
                <img src="dist/img/user.jpg" class="img-circle" alt="User Image">
              </div>
              <h4>
                <span><small>{{ status.name }}</small></span><br>
                <span><small>Nueva Solicitud @{{ status.id }}</small></span>
                <small><i class="fa fa-clock-o"></i></small>
              </h4>
              <p>Estatus: <span class="label label-default">Pendiente</span> </p>
            </a>

          </li>
          <!--aqui empieza el desmadre-->
        </ul>
      </li>
      <li class="footer"><a href="#">See All Notification</a></li>
    </ul>
  </li>
</template>

<script>
  export  default {
    name: "StatusForm",
    data(){
      return {
        statuses: [],
         interval: null,
      }
    },
    mounted() {
      this.loadData();

       this.interval = setInterval(function () {
         this.loadData();
       }.bind(this), 30000);
    },
    methods: {
        loadData: function () {
          axios.post('/notification_s')
              .then(res => {
                this.statuses = res.data;
                // console.log(res.data)
              })
              .catch(err => {
                console.log(err.data)
              })
        }
    },
    beforeDestroy: function(){
       clearInterval(this.interval);
   }
  }
</script>

<style scoped>
</style>
