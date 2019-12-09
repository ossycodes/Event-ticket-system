<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header"></div>
          <div class="card-body">
            <form role="form" @submit.prevent="login">
              <div class="form-group row">
                <label for="email" class="col-sm-4 col-form-label text-md-right">Email</label>

                <div class="col-md-6">
                  <input type="email" class="form-control" id="email" name="email" v-model="email">
                  <span style="color:red" v-if="errors.email">{{ errors.email[0] }}</span>
                </div>
              </div>

              <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                <div class="col-md-6">
                  <input
                    type="password"
                    class="form-control"
                    id="pwd"
                    name="password"
                    v-model="password"
                  >
                  <span style="color:red" v-if="errors.password">{{ errors.password[0] }}</span>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="remember" v-model="remember"> Remember me
                    </label>
                  </div>
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button
                    type="submit"
                    class="btn btn-warning"
                    style="color:white;"
                    :disabled="!isValidLoginForm"
                  >Login</button>
                  <a class="btn btn-warning" style="color:white;" href>Forgot password</a>
                </div>
              </div>
            </form>
          </div>
          <div class="panel-footer">
            <a :href="facebookURL" class="btn btn-social btn-facebook">
              <i class="fa fa-facebook"></i>
              Login with Facebook
            </a>
            <a :href="googleURL" class="btn btn-social btn-facebook">
              <i class="fa fa-google"></i>
              Login with Google
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      email: null,
      password: null,
      remember: false,
      facebookURL: "/login/facebook",
      googleURL: "/login/google",
      errors: {}
    };
  },
  computed: {
    isValidLoginForm() {
        return this.emailIsValid() && this.password;
    }
  },
  methods: {
    emailIsValid() {
      if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email)) {
        return true;
      } else {
        return false;
      }
    },
    login() {
      axios
        .post("/login", {
          email: this.email,
          password: this.password
        })
        .then(res => {
          location.href='/home';
        })
        .catch(error => {
          this.errors = error.response.data.errors;
        });
    }
  }
};
</script>

<style>
</style>
