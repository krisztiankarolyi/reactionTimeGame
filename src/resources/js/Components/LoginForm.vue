<template>  
<form v-bind:action="actionUrl" method="POST">
		<h2 class="text-white">Lépj be!</h2> 
  <div class="form-group">
  	<input type="hidden" name="_token" :value="csrf_token">
    <label for="name">Email-cím</label>
    <input type="email" required="required" class="form-control" id="email" name="email" placeholder="pl. admin@totalcar.hu">
   
  </div>
  <div class="form-group">
    <label for="password">Jelszó</label>
    <input type="password" required="required" class="form-control" name="password" id="password" placeholder="Jelszavad">
  </div>
  <div class="form-check">
    <input type="checkbox" class="form-check-input" name="remember" id="remember">
    <label class="form-check-label" for="exampleCheck1">Jegyezz meg</label>
  </div>
  <div class="text-center">
  <input type="submit" class="btn btn-primary" value="Belépés"></input>
</div>
<p class="text-danger" v-for="error in errors">{{error}}</p>
</form>
</template>

<script>
export default{
beforeMount()
{    
      this.actionUrl = this._url;
      this.csrf_token = this._csrf;
      this.errors = JSON.parse(this._errors);
      console.log(this.errors);
      },
      props:["_url", "_csrf", "_errors"],
      data: function(){
        return {
          actionUrl: '',
          csrfToken: '',
          errors: []
        }                                                                    
      }
}
</script>