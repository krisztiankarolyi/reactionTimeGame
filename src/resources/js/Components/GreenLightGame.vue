<template>  
<form v-bind:action="actionUrl" method="POST">
		
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