<template>
  <form class='login-form' @submit.prevent>
    <div class='input-container'>
      <input class='fancy username' name='username' required='required' type='email' v-model="login_form.email">
      <label class='placeholder'>
        <i class='fa fa-user'></i>
        <span>Username</span>
      </label>
      <div class='line'></div>
      </div>
      <div class='input-container'>
      <input class='fancy password' name='password' required='required' type='password' v-model="login_form.password">
      <label class='placeholder'>
        <i class='fa fa-lock'></i>
        <span>Password</span>
      </label>
      <div class='line'></div>
    </div>
    <p>
      <button class='button blue button-login' @click="login">Login</button>
      <a class='button forgot-password' @click="forget_password">忘記密碼</a>
    </p>
  </form>
</template>

<style>
  html {
    box-sizing: border-box;
    font-family: Ubuntu,'Open Sans',Roboto;
  }

  *,
  *:before,
  *:after {
    box-sizing: inherit;
  }

  body {
    background: #e0e0e0;
  }

  .login-form {
    background: #fff;
    border-radius: 2px;
    box-shadow: 0 0 2px rgba(0, 0, 0, 0.12), 0 2px 4px rgba(0, 0, 0, 0.24);
    position: absolute;
    top: 50%;
    left: 50%;
    width: 300px;
    height: 250px;
    margin-top: -125px;
    margin-left: -150px;
    text-align: center;
  }

  .input-container {
    text-align: center;
    position: relative;
    display: inline-block;
  }

  .placeholder {
    position: absolute;
    bottom: 7px;
    left: 2px;
    color: #bbb;
    transition: transform .2s ease, color .2s ease;
    transform-origin: 0;
    z-index: 0;
  }
  .placeholder i {
    width: 13px;
  }

  .line {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 1px;
    z-index: 3;
  }
  .line:before, .line:after {
    content: '';
    position: absolute;
    bottom: 2px;
    width: 0;
    height: 2px;
    transition: all .2s ease;
    box-shadow: 0 2px 0 #428bca;
    width: 50%;
    transform: scale(0, 1);
  }
  .line:before {
    left: 50%;
    transform-origin: 0;
  }
  .line:after {
    right: 50%;
    transform-origin: 100%;
  }

  input.fancy {
    margin: 0;
    margin-top: 50px;
    border: none;
    border-bottom: 1px solid #bbb;
    position: relative;
    background: transparent;
    padding: 3px;
    width: 230px;
    z-index: 1;
  }
  input.fancy:focus, input.fancy.used, input.fancy:valid {
    outline: 0;
  }
  input.fancy:focus ~ .line:before, input.fancy:focus ~ .line:after, input.fancy.used ~ .line:before, input.fancy.used ~ .line:after, input.fancy:valid ~ .line:before, input.fancy:valid ~ .line:after {
    transform: scale(1, 1);
  }
  input.fancy:focus ~ .placeholder, input.fancy.used ~ .placeholder, input.fancy:valid ~ .placeholder {
    transform: translateY(-1em) scale(0.8);
  }

  .button {
    display: block;
    border-radius: 3px;
    padding: 10px;
    color: #646464;
    cursor: pointer;
    transition: all .2s ease;
    border: 1px solid transparent;
  }
  .button:hover {
    border-color: #bbb;
  }
  .button.blue {
    color: #428bca;
  }

  .button-login {
    background: transparent;
    font-weight: bold;
    width: 230px;
    margin: 5px auto;
  }
  .button-login:focus {
    outline: none;
  }

  .forgot-password {
    font-size: .8em;
    width: 230px;
    margin: 0 auto;
    text-decoration: none;
  }
  .forgot-password:visited, .forgot-password:hover {
    color: #646464;
    text-decoration: none;
  }
</style>

<script>

  import JWTToken from './../../helpers/jwt'
  export default {
        data(){
            return{
                email: '',
                password: ''
            }
        },
        methods:{
            register(){
                let formData ={
                    client_id:'2',
                    client_secret:'xxxxxxxxxxxxxxxxxx',
                    grant_type: 'password',
                    scope : '',
                    username: this.email,
                    password: this.password
                }  
                axios.post('/oauth/token',formData).then(response => {
                    JWTToken.setToken(response.data.access_token)
                })
            }
        }
    }
</script>