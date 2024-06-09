<template>  
<form v-bind:action="actionUrl" method="POST">
  <h2 class="text-white">Játssz velünk, ingyen!</h2> 
  <div class="form-group">
      <input type="hidden" name="_token" :value="csrf_token">
    <label for="name" class="text-light" >Felhasználónév</label>
    <input type="text" required="required" class="form-control" id="name" name="name" placeholder="pl. admin">
  </div>
  <div class="form-group">
    <label for="name" class="text-light">Email-cím</label>
    <input type="email" required="required" class="form-control" id="email" name="email" placeholder="pl. admin@admin.com">
  </div>
  <div class="form-group">
    <label for="password" class="text-light">Jelszó</label>
    <input type="password" minlength="8" required="required" class="form-control" name="password" id="password" placeholder="Jelszavad">
    <label for="password2" class="text-light">Jelszó megerősítése</label>
    <input type="password" minlength="8" required="required" class="form-control" id="password2" name="password2"  placeholder="Figyelj rá, hogy megegyezzen a két beírt jelszó!">
     <label for="gender" class="text-light">Nem</label>
     <select id="gender" name="gender" class="form-control">
       <option selected="selected" value="férfi">Férfi</option>
       <option value="nő">Nő</option>      
     </select>
     <label for="birthday" class="text-light">Születésnap</label>
  <input onkeydown="return false" type="date" id="birthday" name="birthday" class="form-control" required="required">
  </div>
  <div class="form-check">
  </div>
  <div class="text-center">
  <input type="submit" class="btn btn-danger" value="Regisztráció"></input>
 <p class="text-danger" v-for="error in errors">{{error}}</p>

</div>
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