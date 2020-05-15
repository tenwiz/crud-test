<template>
  <div id="app">
    <div class="heading">
      <h1>User Cruds Example</h1>
    </div>
    <user-component
      v-for="user in users"
      v-bind="user"
      :key="user.id"
      @update="updateUser"
      @delete="deleteUser"
    ></user-component>
    <div>
        <button @click="createUser">Add New User</button>
    </div>
  </div>
</template>

<script>
  function User({ id, name, email, password}) {
    this.id = id;
    this.name = name;
    this.email = email;
    this.password = password;
  }

  import UserComponent from './components/User.vue';

  export default {
    data() {
      return {
        users: [],
        mute: false
      }
    },
    methods: {
      async getUsers() {
        this.mute = true;
        const { data } = await window.axios.get('/api/users');
        data.forEach(user => this.users.push(new User(user)));
        this.mute = false;
      },
      async createUser() {
        this.mute = true;
        const { data } = await window.axios.get('/api/users/create');
        this.users.push(new User(data));
        this.mute = false;
      },
      async updateUser(id, email) {
        this.mute = true;
        await window.axios.put(`/api/users/${id}`, { email });
        this.users.find(user => user.id === id).email = email;
        this.mute = false;
      },
      async deleteUser(id) {
        this.mute = true;
        await window.axios.delete(`/api/users/${id}`);
        let index = this.users.findIndex(user => user.id === id);
        this.users.splice(index, 1);
        this.mute = false;
      }
    },
    watch: {
      mute(val) {
        document.getElementById('mute').className = val ? "on" : "";
      }
    },
    components: {
      UserComponent
    },
    async created() {
      await this.getUsers();
    }
  }
</script>
<style>
    #app {
        margin-left: 1em;
    }

    .heading h1 {
        margin-bottom: 0;
    }
</style>
