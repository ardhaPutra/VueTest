<template>
  <div class="login-box">
    <div class="login-logo">
      <a href="/"><b>{{ $store.state.app.name }}</b>BIZ</a>
    </div>

    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Silakan Login untuk memulai sesi</p>
        <form action="/login" method="post" @submit.prevent="loginSubmit()">
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input
              type="password"
              class="form-control"
              placeholder="Password"
            />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember" class="mr-2" />
                <label for="remember"> Remember Me </label>
              </div>
            </div>

            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">
                Sign In
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    beforeMount() {
        $('body').removeClass('sidebar-mini').addClass('login-page');
        $('title').html(`Login | ${this.$store.state.app.name}`);
    },
    methods: {
        loginSubmit(){
            window.location.href = '/';
        }
    }
}
</script>