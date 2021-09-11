  <template>  
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#">Peliculas</a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      
      <li class="d-flex bd-highlight p-1 flex-grow-1 bd-highlight ">
        <a class=" btn btn-secondary" v-on:click="Filter(date)" >Novedades </a>
      </li>
      <div class="d-flex bd-highlight p-1 flex-grow-1 bd-highlight dropdown">
       <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           Categorias
        </a>

      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <div v-for="(value, key) in category">
           <a v-on:click="Filter(value.id)" class="dropdown-item" >{{value.name}}</a>
        </div>
      </div>
</div>
    </ul>
    <form @submit.prevent="searchMovie()" class="form-inline my-2 my-lg-0">
      <input v-model="search" class="form-control mr-sm-2" type="search" placeholder="Search title" aria-label="Search">
      <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search </button>
    </form>
  </div>
</nav>
</template>
<script>
 import moment from 'moment'

export default {
    props: {
   category: Array
 },
  data(){
    return{
      date :moment().subtract(21, 'days').format('YYYY-MM-DD'),
      search:''
    }
  },
   methods:{
     Filter(data){
      this.$emit('GetFilter',data);
     },
     searchMovie(){
        this.Filter(this.search);
     }
   }
}
</script>
